
@extends('layouts.app')

@section('title','Transaksi')

@section('content')

<h1>Transaksi Peminjaman</h1>
<p class="muted">Catat peminjaman dan pengembalian buku.</p>

@if(auth()->user()->role==='siswa')
    <div class="card">
        <h2>Pinjam buku</h2>

        @if($books->count())
            <form method="POST" action="{{route('loans.borrow')}}">
                @csrf

                <div class="grid2">
                    <div class="field">
                        <label>Pilih buku</label>
                        <select name="book_id" required>
                            <option value="">-- Pilih buku --</option>

                            @foreach($books as $b)
                                <option value="{{$b->id}}">
                                    {{$b->title}} · stok {{$b->stock}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label>Batas pengembalian</label>
                        <input
                            type="date"
                            name="due_date"
                            min="{{today()->format('Y-m-d')}}"
                            value="{{today()->addDays(7)->format('Y-m-d')}}"
                            required
                        >
                    </div>
                </div>

                <button class="btn">Ajukan peminjaman</button>
            </form>
        @else
            <p class="muted">Belum ada buku dengan stok tersedia.</p>
        @endif
    </div>
@endif

<div class="card">
    <form class="search" method="GET">
        <input
            name="search"
            value="{{request('search')}}"
            placeholder="Cari judul buku"
        >
        <button class="btn">Cari</button>
    </form>

    <div class="tablewrap" style="margin-top:18px">
        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal pinjam</th>
                    <th>Batas kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($loans as $l)
                    <tr>
                        <td>{{optional($l->book)->title}}</td>
                        <td>{{optional($l->user)->name}}</td>
                        <td>{{$l->borrow_date->format('d/m/Y')}}</td>
                        <td>{{$l->due_date->format('d/m/Y')}}</td>
                        <td>
                            <span class="badge {{$l->status==='dikembalikan'?'':'red'}}">
                                {{$l->status}}
                            </span>
                        </td>
                        <td>
                            @if($l->status==='dipinjam'&&(auth()->user()->role==='admin'||$l->user_id===auth()->id()))
                                <form method="POST" action="{{route('loans.return',$l)}}" onsubmit="return confirm('Catat pengembalian buku?')">
                                    @csrf
                                    <button class="btn light">Kembalikan</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="muted">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{$loans->links()}}
    </div>
</div>

@endsection
