<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProviderLicence;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function users(){
        $users = User::where('type','user')->get();
        return view('dashboard.users.users',[
            'users' => $users,
        ]);
    }
    public function providers(){
        $providers = User::with('category.category')->where('type','provider')->where('status','1')->get();
        return view('dashboard.users.providers',[
            'providers' => $providers,
        ]);
    }
    public function request_provider(){
        $providers = User::where('type','provider')->where('status','0')->get();
        return view('dashboard.users.request-provider',[
            'providers' => $providers,
        ]);
    }
    public function accept_provider($provider_id){
        $provider = User::find($provider_id)->update(['status'=>1]);
        $licence = ProviderLicence::where('provider_id',$provider_id)->update(['active'=>1]);
        return redirect()->back();
    }
    public function block_provider($provider_id){
        $provider = User::find($provider_id)->update(['status'=> 2]);
        return redirect()->back();
    }

    public function deleteUser($user_id)
    {
        $user = User::find($user_id)->delete();
        return redirect()->back();
    }

}
