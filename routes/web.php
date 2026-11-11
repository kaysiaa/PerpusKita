<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

Route::get('/', fn()=> auth()->check() ? redirect()->route('dashboard') : redirect()->route('login'));
Route::middleware('guest')->group(function(){
 Route::get('/login',[AuthController::class,'showLogin'])->name('login');
 Route::post('/login',[AuthController::class,'login'])->name('login.post');
 Route::get('/register',[AuthController::class,'showRegister'])->name('register');
 Route::post('/register',[AuthController::class,'register'])->name('register.post');
});
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function(){
 Route::get('/dashboard', function(){
   $stats=['books'=>\App\Models\Book::count(),'members'=>\App\Models\User::where('role','siswa')->count(),'active'=>\App\Models\Loan::where('status','dipinjam')->count(),'overdue'=>\App\Models\Loan::where('status','dipinjam')->whereDate('due_date','<',today())->count()];
   $loans=\App\Models\Loan::with(['book','user'])->latest()->take(6)->get();
   return view('dashboard',compact('stats','loans'));
 })->name('dashboard');
 Route::get('/buku',[BookController::class,'index'])->name('books.index');
 Route::middleware('admin')->group(function(){
   Route::get('/buku/tambah',[BookController::class,'create'])->name('books.create');
   Route::post('/buku',[BookController::class,'store'])->name('books.store');
   Route::get('/buku/{book}/edit',[BookController::class,'edit'])->name('books.edit');
   Route::put('/buku/{book}',[BookController::class,'update'])->name('books.update');
   Route::delete('/buku/{book}',[BookController::class,'destroy'])->name('books.destroy');
   Route::resource('/anggota',MemberController::class)->except(['show'])->names('members');
 });
 Route::get('/transaksi',[LoanController::class,'index'])->name('loans.index');
 Route::post('/transaksi/pinjam',[LoanController::class,'borrow'])->name('loans.borrow');
 Route::post('/transaksi/{loan}/kembali',[LoanController::class,'returnBook'])->name('loans.return');
});
