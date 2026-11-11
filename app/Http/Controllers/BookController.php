<?php
namespace App\Http\Controllers;
use App\Models\Book; use Illuminate\Http\Request;
class BookController extends Controller {
 public function index(Request $r){$q=Book::query();if($r->filled('search'))$q->where(fn($x)=>$x->where('title','like','%'.$r->search.'%')->orWhere('author','like','%'.$r->search.'%'));$books=$q->latest()->paginate(10)->withQueryString();return view('books.index',compact('books'));}
 public function create(){return view('books.form',['book'=>new Book]);}
 public function store(Request $r){Book::create($this->validated($r));return redirect()->route('books.index')->with('success','Buku berhasil ditambahkan.');}
 public function edit(Book $book){return view('books.form',compact('book'));}
 public function update(Request $r,Book $book){$book->update($this->validated($r));return redirect()->route('books.index')->with('success','Data buku diperbarui.');}
 public function destroy(Book $book){if($book->loans()->where('status','dipinjam')->exists())return back()->with('error','Buku masih dipinjam.');$book->delete();return back()->with('success','Buku dihapus.');}
 private function validated(Request $r){return $r->validate(['title'=>'required|string|max:200','author'=>'required|string|max:150','publisher'=>'required|string|max:150','year'=>'required|integer|min:1900|max:'.(date('Y')+1),'stock'=>'required|integer|min:0','description'=>'nullable|string']);}
}
