<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Libraries\Ultilities;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const VERIFY_ACCOUNT_TYPE = 0;
    const FORGOT_PASSWORD_TYPE = 1;
    const RESEND_CODE_TYPE = 2;

    protected $fillable = [
        'name',
        'email',
        'password',
        'code'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerRules()
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email',
            'password' => 'required|min:8|max:32'
        ];    
    }

    public function loginRules()
    {
        return [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8|max:32'
        ]; 
    }

    public function verifyRules()
    {
        return [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'code' => 'required|numeric|digits:6',
            'type' => 'required|numeric',
        ];
    }

    public function forgotPasswordRules()
    {
        return [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        ];
    }

    public function resetPasswordRules()
    {
        return [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|confirmed|min:8|max:32',
            'password_confirmation' => 'required'
        ];
    }

    public function changePasswordRules()
    {
        return [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'current_password' => 'required|min:8|max:32',
            'password' => 'required|confirmed|min:8|max:32',
            'password_confirmation' => 'required'
        ];
    }

    public function resendRules()
    {
        return [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email'
        ];
    }

    public function updateProfileRules()
    {
        return [
            'name' => 'required|max:100'
        ];
    }

    public function createUser($request)
    {
        $input['name'] = Ultilities::clearXSS($request->name);
        $input['email'] = Ultilities::clearXSS($request->email);
        $input['password'] = bcrypt($request->password);
        $input['code'] = $request->code;

        $user = $this->create($input);
        return $user;
    }

    public function updateUser($request)
    {
        $this->update($request->only('name'));
    }
    
    public function updatePassword($password)
    {
        $this->password = $password;
        $this->save();
    }

    public function updateCode($code)
    {
        $this->code = $code;
        $this->save();
    }

    public function issueToken($user)
    {
        return  $user->createToken('Personal Access Token');
    }

    public function isVerifiedEmail($email)
    {
        $user = $this->where('email', $email)->first();
        if(!empty($user->email_verified_at)) {
            return true;
        }
        return false;
    }

    public function verifiedEmail($id)
    {
        $user = $this->find($id);
        $user->email_verified_at = now();
        $user->save();
    }

    public function isExistEmail($email)
    {
        $count = $this->where('email', $email)->count();
        if($count > 0) {
            return true;
        }
        return false;
    }

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

}
