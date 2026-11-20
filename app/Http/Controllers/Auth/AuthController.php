<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request with throttling
     */
    public function login(LoginRequest $request)
    {
        $this->ensureIsNotRateLimited($request);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request));

            return redirect()->intended(route('account.index'));
        }

        RateLimiter::hit($this->throttleKey($request), 60);

        throw ValidationException::withMessages([
            'email' => __('ایمیل یا رمز عبور اشتباه است.'),
        ]);
    }

    /**
     * Display registration form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('account.index')->with('success', 'ثبت‌نام با موفقیت انجام شد. خوش آمدید!');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'با موفقیت خارج شدید.');
    }

    /**
     * Ensure the login request is not rate limited
     */
    protected function ensureIsNotRateLimited(Request $request)
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => __('تلاش‌های زیادی انجام شده است. لطفاً :seconds ثانیه دیگر تلاش کنید.', [
                'seconds' => $seconds,
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }
}
