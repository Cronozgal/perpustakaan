<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalMembers = User::where('role', 'siswa')->count();
        $activeBorrows = Transaction::where('status', 'dipinjam')->count();

        return view('admin.dashboard', compact('totalBooks', 'totalMembers', 'activeBorrows'));
    }
}
