<?php

namespace App\Http\Controllers\Users;

use App\User;
use App\Mail\UserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;

class UsersVerifyController extends ApiController
{
    public function verify($token)
    {
    	$user = User::where('verification_token', $token)->firstOrFail();
    	$user->verified = true;
    	$user->verification_token = null;

    	$user->save();

    	return $this->showMessage('The account has been successfully verified');
    }

    public function resend(User $user)
    {
    	if ($user->isVerified()) {
    		return $this->errorResponse('This user is already verified');
    	}

    	retry(5, function() use ($user) {
                Mail::to($user)->send(new UserCreated($user));
            }, 100);

    	return $this->showMessage('The verification email has been resend');
    }
}
