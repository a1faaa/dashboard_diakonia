<?php

namespace App\Http\Controllers;

use App\Helpers\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function index(){

    }

    public function login(){
        $data = [];
        $data['title'] = 'Login';
        return view('general.login', $data);
    }

    public function aksi_login(Request $request){
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 1) {
                return redirect()->route('user.index');
            } else if (auth()->user()->role == 9) {
                return redirect()->route('staff.index');
            }
        } else {
            Flasher::warning('Username atau password salah');
            return redirect()->route('general.login');
        }
    }

    public function aksi_logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
