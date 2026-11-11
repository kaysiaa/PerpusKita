<?php
namespace App\Http\Controllers;
use App\Models\User;use Illuminate\Http\Request;use Illuminate\Support\Facades\Hash;
class MemberController extends Controller {
 public function index(Request $r){$q=User::where('role','siswa');if($r->filled('search'))$q->where(fn($x)=>$x->where('name','like','%'.$r->search.'%')->orWhere('nis','like','%'.$r->search.'%'));$members=$q->latest()->paginate(10)->withQueryString();return view('members.index',compact('members'));}
 public function create(){return view('members.form',['member'=>new User]);}
 public function store(Request $r){$d=$r->validate(['name'=>'required','email'=>'required|email|unique:users','nis'=>'nullable','class_name'=>'nullable','password'=>'required|min:8']);$d['password']=Hash::make($d['password']);$d['role']='siswa';User::create($d);return redirect()->route('members.index')->with('success','Anggota ditambahkan.');}
 public function edit(User $anggota){return view('members.form',['member'=>$anggota]);}
 public function update(Request $r,User $anggota){$d=$r->validate(['name'=>'required','email'=>'required|email|unique:users,email,'.$anggota->id,'nis'=>'nullable','class_name'=>'nullable','password'=>'nullable|min:8']);if(empty($d['password']))unset($d['password']);else $d['password']=Hash::make($d['password']);$anggota->update($d);return redirect()->route('members.index')->with('success','Anggota diperbarui.');}
 public function destroy(User $anggota){if($anggota->loans()->where('status','dipinjam')->exists())return back()->with('error','Anggota masih memiliki pinjaman aktif.');$anggota->delete();return back()->with('success','Anggota dihapus.');}
}
