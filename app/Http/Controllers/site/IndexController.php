<?php

namespace App\Http\Controllers\site;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function homePage() {
        $products = Product::all();
        return view('site.index', compact('products'));
    }

    public function productDetail() {
        return view('site.product-detail');
    }

    public function cartView() {
        return view('site.cart');
    }

    public function checkoutView() {
        return view('site.checkout');
    }

    public function addProductToCart(Request $request) {
        
        $productId = $request->productId;
        
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'error' => 'No Product Found',
            ], 404);
        }

        $cart = session()->get('cart');
        $cartProductId = $product->id;

        // session()->flush();

        if(!$cart) {
            $cart = [
                    $cartProductId => [
                        'name' => $product->name,
                        'quantity' => 1,
                        'price' => $product->price,
                        'image' => $product->gallery->image ? $product->gallery->image : '' 
                    ]
            ];

            session()->put('cart', $cart);

        }

        if(isset($cart[$cartProductId])) {
            $cart[$cartProductId]['quantity']++;

            session()->put('cart', $cart);
        }else {
            $cart[$cartProductId] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->gallery->image ? $product->gallery->image : '' 
            ];

            session()->put('cart', $cart);
        }

        // dd($totalCartProducts);
        return response()->json([
            'products' => $cart,
            
        ], 201);
    } 

    public function calculateCartProducts() {

        $cart = session()->get('cart');

        $totalCartProducts = count($cart);

        return response()->json([
            'cart_total_products' => $totalCartProducts
        ], 201);
    }
}
