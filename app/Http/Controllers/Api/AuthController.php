<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Libraries\Ultilities;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Jobs\SendEmailApiJob;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class AuthController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->registerRules());

        if($validator->fails()) {
            $error = $validator->errors()->toArray();
            return $this->sendError(__('api.signup.fail'), $error, 400);
        }

        // generate code verify
        $code = rand(100000, 999999);
        $request->request->add(['code' => Hash::make($code)]);
       
        $newUser = $this->user->createUser($request);

        if($newUser) {
            dispatch(new SendEmailApiJob($newUser->email, $code, User::VERIFY_ACCOUNT_TYPE));
            return $this->sendResponse(new UserResource($newUser), __('api.signup.success'));
        }
        
        return $this->sendError(__('api.signup.fail'), [], 400);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->loginRules());
 
        if ($validator->fails()) {
            $error = $validator->errors()->toArray();
            return $this->sendError(__('api.login.fail'), $error, 400);
        }
        
        if(!$this->user->isExistEmail($request->email)) {
            return $this->sendError(__('api.user.not_found'), [], 400);
        }

        $userData = $this->user->getUserByEmail($request->email);

        if(!Hash::check($request->password, $userData->password)) {
            return $this->sendError(__('api.login.fail'), [], 400);
        }

        if(!$this->user->isVerifiedEmail($request->email)) {
            return $this->sendError(__('api.user.inactive'), [], 400);
        }

        $token = $this->user->issueToken($userData);
        $result = [
            'access_token' => config('constants.TOKEN_TYPE') . $token->accessToken,
            'user' => new UserResource($userData),
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ];

        return $this->sendResponse($result, __('api.login.success'), 200);
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->verifyRules());

        if ($validator->fails()) {
            $error = $validator->errors()->toArray();
            return $this->sendError(__('api.verify_code.fail'), $error, 400);
        }

        $userData = $this->user->getUserByEmail($request->email);
        
        if (empty($userData)) {
            return $this->sendError(__('api.user.not_found'));
        }

        if(Hash::check($request->code, $userData->code)) {
            if($request->type == User::VERIFY_ACCOUNT_TYPE) {
                $this->user->verifiedEmail($userData->id);
                $token = $this->user->issueToken($userData);
                $result = [
                    'access_token' => config('constants.TOKEN_TYPE') . $token->accessToken,
                    'user' => new UserResource($userData),
                    'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
                ];
                return $this->sendResponse($result, __('api.verify_code.success'), 200);
            }

            if($request->type == User::FORGOT_PASSWORD_TYPE) {
                return $this->sendResponse(new UserResource($userData), __('api.verify_code.success'), 200);
            }
        }

        return $this->sendError(__('api.verify_code.fail'), [], 400);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->forgotPasswordRules());
        if($validator->fails()) {
            $error = $validator->errors()->toArray();
            return $this->sendError(__('api.forgot_password.fail'), $error, 400);
        }

        if(!$this->user->isExistEmail($request->email)) {
            return $this->sendError(__('api.user.not_found'), [], 400);
        }

        $userData = $this->user->getUserByEmail($request->email);

        $code = rand(100000, 999999);
        $userData->updateCode(Hash::make($code));

        dispatch(new SendEmailApiJob($userData->email, $code, User::FORGOT_PASSWORD_TYPE));

        return $this->sendResponse(new UserResource($userData), __('api.forgot_password.success'), 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->resetPasswordRules());

        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->sendError(__('api.reset_password.fail'), $errors, 400);
        }

        if(!$this->user->isExistEmail($request->email)) {
            return $this->sendError(__('api.user.not_found'), [], 400);
        }

        $userData = $this->user->getUserByEmail($request->email);

        $newPassword = Hash::make(Ultilities::clearXSS($request->password));
        $userData->updatePassword($newPassword);
        
        return $this->sendResponse(new UserResource($userData), __('api.reset_password.success'), 200);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->changePasswordRules());

        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->sendError(__('api.change_password.fail'), $errors, 400);
        }

        if(!$this->user->isExistEmail($request->email)) {
            return $this->sendError(__('api.user.not_found'), [], 400);
        }

        $userData = $this->user->getUserByEmail($request->email);

        if(!Hash::check($request->current_password, $userData->password)) {
            return $this->sendError(__('api.change_password.current_fail'), [], 400);
        }

        $newPassword = Hash::make(Ultilities::clearXSS($request->password));
        $userData->updatePassword($newPassword);

        return $this->sendResponse(new UserResource($userData), __('api.change_password.success'), 200);
    }

    public function resendVerifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->resendRules());

        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->sendError(__('api.verify_code.resend_code.fail'), $errors, 400);
        }

        $code = rand(100000, 999999);
        $userData = $this->user->getUserByEmail($request->email);
        $userData->updateCode(Hash::make($code));

        dispatch(new SendEmailApiJob($userData->email, $code, User::RESEND_CODE_TYPE));
        return $this->sendResponse(new UserResource($userData), __('api.verify_code.resend_code.success'));
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendResponse('', 'Logout successful', 200);
    }
    
    public function profile(Request $request)
    {
        $profile = $request->user();
        return $this->sendResponse(new UserResource($profile), __('api.profile.success'), 200);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), $this->user->updateProfileRules());

        if($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->sendError(__('api.profile.update.fail'), $errors, 400);
        }

        $profile = $request->user();
        $profile->updateUser($request);
        return $this->sendResponse(new UserResource($profile), __('api.profile.update.success'), 201);
    }

}
