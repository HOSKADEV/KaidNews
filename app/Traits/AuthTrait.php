<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function checkGuard()
    {
        if (auth()->guard('admin')->check()) {
            return 'admin';
        } else if (auth()->guard('teacher')->check()) {
            return 'teacher';
        } else if (auth()->guard('student')->check()) {
            return 'student';
        } else {
            return null;
        }
    }
    public function redirectTo($guard)
    {
        switch ($guard) {
            case ('admin'):
                return redirect()->intended(RouteServiceProvider::ADMIN);
                break;
            case ('teacher'):
                return redirect()->intended(RouteServiceProvider::ADMIN);
                // return redirect()->intended(RouteServiceProvider::TEACHER);
                break;
            case ('student'):
                return redirect()->intended(RouteServiceProvider::STUDENT);
                break;
            default:
                return redirect()->intended(RouteServiceProvider::LOGIN)
                    ->with(['error' => trans('message.invalid_credentials')]);
        }
    }

    public function login($credentials)
    {
        if (auth('admin')->attempt($credentials)) {
            return $this->redirectTo('admin');
        } else if (auth('teacher')->attempt($credentials)) {
            return $this->redirectTo('teacher');
        } else if (auth('student')->attempt($credentials)) {
            return $this->redirectTo('student');
        } else {
            return $this->redirectTo(null);
        }
        // auth()->guard('student')->login($student);
    }

    public function logout($guard)
    {
        return auth()->guard($guard)->logout();
    }
}
