<?php

/**
 * AuthController
 *
 * PHP version 8.3
 *
 * @package  App\Http\Controllers\Admin
 * @category Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

/**
 * AuthController Class
 *
 * This controller handles login & logout feature.
 */
class AuthController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect(route('dashboard'));
        }

        return view('admin.auth.login');
    }

    /**
     * Method login
     *
     * @param Request $request
     *
     * @return string|null
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'))->withSuccess('Signed in');
        }

        return redirect(route("login"))->withError('Login details are not valid');
    }

    /**
     * Method logout
     *
     * @return string|null
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect(route('login'));
    }
}
