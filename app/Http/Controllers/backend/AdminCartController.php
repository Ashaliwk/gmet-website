<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Carts;
use App\Models\backend\Products;
use Illuminate\Http\Request;

class AdminCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.cart');
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        $image = $request->input('image');

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => 'Product added to cart successfully.']);
    }
}
