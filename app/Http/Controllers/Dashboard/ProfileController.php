<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Auth\Events\PasswordReset;

class ProfileController extends Controller
{
    public function editProfile()
    {
        $admin = Admin::find( auth('admin') -> user() -> id);
        return view('dashboard.profile.edit',compact('admin'));
    }

    public function updateProfile(Request $request , Admin $admin)
    {
        try{
            $admin = Admin::find(auth('admin') -> user() -> id);
            $admin -> update($request ->only(['name','mobile']));
            return redirect()-> back()->with(['success' => __('admin\dashboard.success')]);
        }catch(\Exception $ex){
            return redirect()-> back()->with(['error' => __('admin\dashboard.error')]);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        try{
            Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return redirect()-> back()->with(['success' => __('admin\dashboard.success')]);
        }catch(\Exception $ex){
            return redirect()-> back()->with(['error' => __('admin\dashboard.error')]);

        }
       }
    }

