<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $products = Product::all();
        return view('welcome', compact('category', 'products'));
    }
    public function createOrder(Request $request){
        try {
            DB::Transaction(function () use ($request) {
                $existingPendingOrder = Order::where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->latest()
                    ->first();
                    if ($existingPendingOrder) {
                        $order = $existingPendingOrder;
                        $order = Order::create([
                            'user_id' => Auth::id(),
                            'total_harga' => 0,
                            'status' => 'pending',
                        ]);
                    }else {
                        $order = $existingPendingOrder;
                    }
                    $totalHarga = 0;
                    if ($existingPendingOrder) {
                        $totalHarga = $existingPendingOrder->total_harga;
                    }
                    foreach ($request->item as $item) {
                        $product =Product::findOrfail($item['product_id']);
                        $subTotal = $product->harga * $item['quantity'];

                        $existingPendingOrder = OrderProduct::where('order_id', $order->id)
                            ->where('product_id', $product->id)
                            ->first();
                        if ($existingPendingOrder) {
                            $newQuantity = $existingPendingOrder->quantity + $item['quantity'];
                            $newSubTotal = $product->harga * $newQuantity;

                            $existingPendingOrder->quantity = $newQuantity;
                            $existingPendingOrder->subtotal = $newSubTotal;
                            $existingPendingOrder->save();

                            $totalHarga = $totalHarga - $existingPendingOrder->subtotal + $newSubTotal;
                        }else {
                            OrderProduct::create([
                                'order_id' => $order->id, //le mineral 5 = 20,kopi 6 = 30,baygon 8 = 80,1 pack = 40
                                'product_id' => $product->id,
                                'quantity' => $item['quantity'],
                                'subtotal' => $subTotal,
                            ]);
                            $totalHarga += $subTotal;
                        }
                    }
                    $order->total_harga = $totalHarga;
                    $order->save();
            });
            $productName = Product::findOrFail($request->item[0]['product_id'])->nama;
            $quantity = $request->item[0]['quantity'];
            return redirect()->route('home')->with('success', "$quantity x $productName Berhasil ditambahkan ke keranjang belanja.");
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('home')->with('error', 'Error: ' . $e->getMessage());
            } catch (\Throwable $e) {
                return redirect()->route('home')->with('error','Error' . $e->getMessage());
            }
    }
    public function myOrders(Request $request){

    }
    public function orderDetail(Request $request, $id){

    }
    public function updateQuantity(Request $request, $id){
        
    }
    public function removeItem(Request $request, $id){

    }
    public function checkOut(Request $request){

    }
}
