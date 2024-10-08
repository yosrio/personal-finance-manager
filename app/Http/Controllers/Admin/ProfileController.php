<?php

/**
 * ProfileController
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
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * ProfileController
 *
 * This controller handles profile.
 */
class ProfileController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        return view('admin.profile.index');
    }

    /**
     * Method save
     *
     * @param Request $request
     *
     * @return void
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
            return redirect(route('profile'))->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            if (!Hash::check($request->password, $user->password)) {
                return redirect(route('profile'))->withErrors(['password' => 'Password is incorrect'])->withInput();
            }
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if ($user->save()) {
                DB::commit();
                return redirect(route('profile'))->with('success', 'Successfuly update profile.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('exceptions')->error($e);
            return redirect(route('profile'))->with('error', 'Something went wrong.');
        }
        return;
    }

    /**
     * Method changePassword
     *
     * @param Request $request
     *
     * @return void
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => [
                'required',
                'min:8',
                'max:64',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,64}$/'
            ],
            'newPasswordConfirm' => 'required|same:newPassword'
        ]);

        if ($validator->fails()) {
            Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
            return redirect(route('profile'))->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            if (!Hash::check($request->oldPassword, $user->password)) {
                return redirect(route('profile'))->withErrors(['oldPassword' => 'Password is incorrect'])->withInput();
            }
            $user->password = Hash::make($request->newPassword);

            if ($user->save()) {
                DB::commit();
                return redirect(route('profile'))->with('success', 'Successfuly change password.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('exceptions')->error($e);
            return redirect(route('profile'))->with('error', 'Something went wrong.');
        }
        return;
    }
}
