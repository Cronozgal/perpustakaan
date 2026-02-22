<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $activeBorrows = Transaction::where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->count();
        $totalBorrows = Transaction::where('user_id', Auth::id())->count();

        return view('siswa.dashboard', compact('activeBorrows', 'totalBorrows'));
    }

    public function peminjaman()
    {
        $books = Book::latest()->get();
        return view('siswa.peminjaman', compact('books'));
    }

    public function storePinjam(Book $book)
    {
        // Cek apakah stok tersedia
        if ($book->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku "' . $book->judul_buku . '" sudah habis.');
        }

        $existing = Transaction::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->first();
        if ($existing) {
            return back()->with('error', 'Anda sedang meminjam buku ini.');
        }

        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => now()->toDateString(),
            'status' => 'dipinjam',
        ]);

        // Kurangi stok
        $book->decrement('stok');

        return redirect()->route('siswa.peminjaman')->with('success', 'Buku berhasil dipinjam.');
    }

    public function pengembalian()
    {
        $transactions = Transaction::with('book')
            ->where('user_id', Auth::id())
            ->latest()->get();
        return view('siswa.pengembalian', compact('transactions'));
    }

    public function storeKembali(Transaction $transaction)
    {
        if ($transaction->user_id != Auth::id()) {
            abort(403);
        }

        $transaction->update([
            'tanggal_kembali' => now()->toDateString(),
            'status' => 'dikembalikan'
        ]);

        // Tambah stok kembali
        if ($transaction->book) {
            $transaction->book->increment('stok');
        }

        return redirect()->route('siswa.pengembalian')->with('success', 'Buku berhasil dikembalikan.');
    }
}
