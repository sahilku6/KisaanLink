<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Order;
use App\Models\UserDetail;

class OrderController extends Controller
{
    //

    function showCheckoutForm($product_id)
    {
        if (session('user') == null) {
            return redirect('/login')->with('error', 'Please login to continue');
        }
        if (session('user')->role != 'Purchaser') {
            return redirect('/dashboard')->with('error', 'You are not authorized to access this page');
        }

        // fetch the product details with seller details
        $product = ProductDetail::with('seller')->where('id', $product_id)->first();
        if (!$product) {
            return redirect('/dashboard')->with('error', 'Product not found');
        }

        return view('Buyer.CheckoutPage', ['product' => $product]);
    }


    function fetchdeiliveryaddress($id){

        // Fetch the delivery address of the user
        $user = UserDetail::find($id);
        if (!$user) {
            return null; // or handle the case when user is not found
        }

        return $user->address;


    }
    function handleCheckout(Request $request, $product_id)
    {

        // logic
        $order = new Order();
        $order->offer_price = $request->input(key: 'offer_price');
        $order->quantity = $request->input('quantity');
        $order->product_id = $product_id;
        $order->buyer_id = session('user')->id;
        $order->seller_id = $request->input('seller_id');
        $order->delivery_address= $this->fetchdeiliveryaddress(session('user')->id);

        $order->save();

        return redirect('/dashboard')->with('success', 'Order placed successfully');
    }

    

    
    
   
}
