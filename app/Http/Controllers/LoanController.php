<?php
namespace App\Http\Controllers;
use App\Models\Loan;use App\Models\Book;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;
class LoanController extends Controller {
 public function index(Request $r){$q=Loan::with(['book','user']);if($r->user()->role!=='admin')$q->where('user_id',$r->user()->id);if($r->filled('search'))$q->whereHas('book',fn($b)=>$b->where('title','like','%'.$r->search.'%'));$loans=$q->latest()->paginate(12)->withQueryString();$books=Book::where('stock','>',0)->orderBy('title')->get();return view('loans.index',compact('loans','books'));}
 public function borrow(Request $r){$d=$r->validate(['book_id'=>'required|exists:books,id','due_date'=>'required|date|after_or_equal:today']);DB::transaction(function()use($r,$d){$b=Book::whereKey($d['book_id'])->lockForUpdate()->firstOrFail();if($b->stock<1)throw \Illuminate\Validation\ValidationException::withMessages(['book_id'=>'Stok buku habis.']);$b->decrement('stock');Loan::create(['user_id'=>$r->user()->id,'book_id'=>$b->id,'borrow_date'=>today(),'due_date'=>$d['due_date'],'status'=>'dipinjam']);});return back()->with('success','Permintaan peminjaman berhasil dicatat.');}
 public function returnBook(Request $r,Loan $loan){if($r->user()->role!=='admin'&&$loan->user_id!==$r->user()->id)abort(403);if($loan->status==='dikembalikan')return back()->with('error','Buku sudah dikembalikan.');DB::transaction(function()use($loan){$loan->update(['status'=>'dikembalikan','return_date'=>today()]);$loan->book()->increment('stock');});return back()->with('success','Pengembalian buku berhasil dicatat.');}
}
