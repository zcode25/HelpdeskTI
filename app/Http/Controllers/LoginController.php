<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'employeeId'     => 'required',
            'password'         => 'required',
        ]);
       
 
        if (Auth::attempt(['employeeId' =>  $credentials['employeeId'], 'password' => $credentials['password'], 'role' => 'Client'])) {
            $request->session()->regenerate();
 
            return redirect()->intended('/client/ticket');
        }

        if (Auth::attempt(['employeeId' =>  $credentials['employeeId'], 'password' => $credentials['password'], 'role' => 'Admin'])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/admin/dashboard');
        }

        if (Auth::attempt(['employeeId' =>  $credentials['employeeId'], 'password' => $credentials['password'], 'role' => 'Technician'])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/technician/ticket');
        }

        if (Auth::attempt(['employeeId' =>  $credentials['employeeId'], 'password' => $credentials['password'], 'role' => 'Manager'])) {
            $request->session()->regenerate();
            
            return redirect()->intended('/manager/dashboard');
        }

        return back()->with([
            'loginError' => 'Login field!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
