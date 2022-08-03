<?php
return [
    'profile' => [
        'success' => 'Get profile successfully!',
        'fail' => 'Get profile unsuccessfully!',
        'update' => [
            'success' => 'Update profile successfully!',
            'fail' => 'Update profile unsuccessfully!',
        ]
    ],
    'login' => [
        'success' => 'Logged in successfully!',
        'fail' => 'Email or password is incorrect!',
    ],
    'signup' => [
        'success' => 'Signed up successfully!',
        'fail' => 'Cannot create user!',
    ],
    'logout' => [
        'success' => 'Logged out successfully!',
        'fail' => 'Cannot log out!',
    ],
    'user' => [
        'not_found' => 'User not found!',
        'existed' => 'This email or username has already been used!',
        'inactive' => 'You have not verified your account yet!',
        'active' => 'This account was verified!',
        'blocked' => 'This account has been blocked by admin!',
        'username' => [
            'white_space' => 'Username cannot contain whitespace!'
        ],
        'unauthorized' => 'You are not authorized!',
        'update' => 'Update profile successfully',
        'user_blocked' => 'This user has been blocked',
        'verified_or_blocked' => 'User not exist or User has not verified',
 
    ],
    'verify_code' => [
        'success' => 'Verified successfully!',
        'incorrect' => 'Code number is incorrect!',
        'wrong_type' => 'Invalid type!',
        'fail' => 'Verified unsuccessfully ',
        'resend_code' => [
            'success' => 'Resent code successfully!',
            'fail' => 'Resent code unsuccessfully!',
        ]
    ],
    'forgot_password' => [
        'success' => 'Code number was sent on your email!',
        'fail' => 'Cannot send Reset password link  to your email!',
    ],
    'subject_verify_email' => [
        'name' => 'Verify account email!',
    ],
    'subject_forgot_password_email' => [
        'name' => 'Forgot password email!',
    ],
    'subject_resend_code_email' => [
        'name' => 'Resend code email!',
    ],
    'reset_password' => [
        'success' => 'Reset password successfully!',
        'fail' => 'Reset password unsuccessfully!',
        'wrong_type' => 'Invalid type!',
    ],
    'change_password' => [
        'success' => 'Change password successfully!',
        'fail' => 'Change password unsuccessfully!',
        'current_fail' => 'Current password is incorrect!'
    ],
    'destination' => [
        'index_success' => 'Destination retrieved successfully!'
    ],
    'type_tour' => [
        'index_success' => 'Type of tour retrieved successfully!'
    ]
];
