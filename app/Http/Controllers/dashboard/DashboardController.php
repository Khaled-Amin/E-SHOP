<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users.Allusers' , compact('users'));
    }

    public function viewUsers($id)
    {
        $users= User::find($id);
        return view('admin.users.ViewUsers' , compact('users'));
    }
}
