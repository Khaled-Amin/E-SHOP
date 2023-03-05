<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }

    public function Dashboard(){
        return view('admin.rtl');
    }

    public function Login(Request $request){
        // dd($request->all());
        $check =  $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'] , 'password'=>$check['password']])){
            return redirect()->route('admin.dashboard')->with('error' , 'Admin Login Successfully');
        }else{
            return back()->with('error' , 'Invalid Email Or Password');
        }
    }
    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error' , 'Admin Logout Successfully');
    }
    public function AdminRegister(){

        return view('admin.admin_register');
    }

    public function AdminRegisterCreate(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name'      => ['required', 'string', 'max:255'],
        //     'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password'  => ['required', 'confirmed']
        // ]);
        Admin::insert([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('login_form')->with('error' , 'Admin Created Successfully');
    }
}
