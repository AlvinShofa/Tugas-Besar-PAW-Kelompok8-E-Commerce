<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->get(); // hanya user biasa
        return view('admin.index_user', compact('users'));
    }

    // Hapus satu pengguna
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }

    // Hapus banyak pengguna
    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('user_ids');
        if ($ids) {
            User::destroy($ids);
            return redirect()->back()->with('success', 'Beberapa pengguna berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Tidak ada pengguna yang dipilih.');
    }

}
