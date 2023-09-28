<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AccountRequest;
use App\Models\User;
use Auth;
use Hash;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function logonIndex(){
        return view('admin.pages.user.logon');
    }

    public function registerIndex(){
        return view('admin.pages.user.register');
    } 

    public function register(AccountRequest $req){
        $req->merge(['password'=>Hash::make($req->password)]);
        User::create($req->all());

        return redirect()->route('logon.index');
    }

    public function logon(AccountRequest $req){
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            return redirect()->route('dashboard.index');
        }else{
            return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        alert()->success('Success', 'Logout success !');
        return redirect()->route('logon.index');
    }

    

    
}