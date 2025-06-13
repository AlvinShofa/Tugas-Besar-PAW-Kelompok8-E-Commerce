<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function checkout()
{
    $user = Auth::user();

    // Cek apakah status user aktif
    if (!$user->status) {
        return Redirect::back()->withErrors(['Akun Anda dinonaktifkan. Anda tidak dapat melakukan pembelian.']);
    }

    $user_id = $user->id;
    $carts = Cart::where('user_id', $user_id)->get();

    if ($carts->isEmpty()) {
        return Redirect::back()->withErrors(['Keranjang kosong.']);
    }

    $order = Order::create([
        'user_id' => $user_id
    ]);

    foreach ($carts as $cart) {
        $product = Product::find($cart->product_id);

        $product->update([
            'stock' => $product->stock - $cart->amount
        ]);

        Transaction::create([
            'amount' => $cart->amount,
            'order_id' => $order->id,
            'product_id' => $cart->product_id
        ]);

        $cart->delete();
    }

    return Redirect::route('show_order', $order);
    }


    public function index_order()
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
        if($is_admin)
        {
            $orders = Order::all();
        }
        else
        {
            $orders = Order::where('user_id', $user->id)->get();
        }
        return view('admin.index_order', compact('orders'));
    }

    public function show_order(Order $order)
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;

        if ($is_admin || $order->user_id == $user->id)
        {
            return view('show_order', compact('order'));
        }

        return Redirect::route('admin.index_order');
    }

    public function submit_payment_receipt(Order $order, Request $request)
    {
    // ✅ Validasi bahwa bukti transfer wajib diunggah
    $request->validate([
        'payment_receipt' => 'required|mimes:jpg,jpeg,png,pdf|max:2048'
    ], [
        'payment_receipt.required' => 'Bukti transfer wajib diunggah.',
        'payment_receipt.mimes' => 'Format bukti transfer hanya boleh JPG, JPEG, PNG, atau PDF.',
        'payment_receipt.max' => 'Ukuran maksimal bukti transfer adalah 2MB.'
    ]);

    // ✅ Jika validasi lolos, proses penyimpanan
    $file = $request->file('payment_receipt');
    $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();

    Storage::disk('local')->put('public/' . $path, file_get_contents($file));

    // ✅ Update database
    $order->update([
        'payment_receipt' => $path
    ]);

    // ✅ Redirect kembali dengan pesan sukses
    return Redirect::back()->with('success', 'Bukti transfer berhasil diunggah dan menunggu verifikasi.');
    }

    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true
        ]);

        return Redirect::back();
    }
}
