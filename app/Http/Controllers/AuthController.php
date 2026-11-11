<?php
namespace App\Http\Controllers;
use App\Models\User; use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth; use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
 public function showLogin(){return view('auth.login');}
 public function showRegister(){return view('auth.register');}
 public function login(Request $r){$data=$r->validate(['email'=>'required|email','password'=>'required']); if(Auth::attempt($data)){$r->session()->regenerate();return redirect()->intended(route('dashboard'));} return back()->withErrors(['email'=>'Email atau password tidak sesuai.'])->onlyInput('email');}
 public function register(Request $r){$data=$r->validate(['name'=>'required|string|max:100','email'=>'required|email|unique:users','nis'=>'nullable|string|max:30','class_name'=>'nullable|string|max:50','password'=>'required|min:8|confirmed']);$data['password']=Hash::make($data['password']);$data['role']='siswa';$u=User::create($data);Auth::login($u);return redirect()->route('dashboard')->with('success','Akun berhasil dibuat.');}
 public function logout(Request $r){Auth::logout();$r->session()->invalidate();$r->session()->regenerateToken();return redirect()->route('login');}
}
