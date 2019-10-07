<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Cart;

class ProductsController extends Controller
{
    
    public function index(){

        /*   $products = [0=> ["name"=>"Iphone","category"=>"smart phones","price"=>1000],
               1=> ["name"=>"Galaxy","category"=>"tablets","price"=>2000],
               2=> ["name"=>"Sony","category"=>"TV","price"=>3000]];*/
   
        $products = Product::paginate(3);

        return view("allproducts",compact("products"));
   
    }

    public function flushCartSession(Request $request) {
        $request->session()->forget('cart');
        $request->session()->flush();
        return redirect()->route('allProducts');
    }

    public function addProductToCart(Request $request, $id) {
        
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart, 'Hello');

        $product = Product::find($id);

        $cart->addItem($id,$product);

        $request->session()->put('cart', $cart);
        //dump($cart);

        return redirect()->route('allProducts');

    }

    public function showCart() {
        $cart = Session::get('cart');

        //cart is not empty
        if($cart){
            //dump($cart);
            return view('cartProducts',['cartItems'=> $cart]);
         //cart is empty
        }else{
            return redirect()->route("allProducts");
        }
    }

    public function deleteItemFromCart(Request $request, $id) {

        $cart = $request->session()->get('cart');

        if(array_key_exists($id,$cart->items)){ 
            unset($cart->items[$id]);
        }

        $prevCart = $request->session()->get('cart');
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriceAndQuantity();

        //update session data
        $request->session()->put('cart', $updatedCart);

        return redirect()->route('cartProducts');

    }
    
    public function checkoutProducts() {
        return view('checkoutproducts');
    }
    
    public function createNewOrder(Request $request) {
        $cart = Session::get('cart');
        
        //cart is not empty
        if($cart){
            $date = date('Y-m-d H:i:s');
            $newOrderArr = [
                'status' => 'on_hold',
                'date' => $date,
                'delivery_date' => $date,
                'price' => (int) str_replace("$","",$cart->totalPrice),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'country' => $request->input('country'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip')                
            ];
            
            $createdOrder = DB::table('orders')->insert($newOrderArr);
            $order_id = DB::getPdo()->lastInsertId();
            
            foreach ($cart->items as $cart_item){
                $newItemsInCurrentOrder = [
                    'item_id' => $cart_item['data']['id'],
                    'order_id' => $order_id,
                    'item_name' => $cart_item['data']['name'],
                    'item_price' => (int) str_replace("$","",$cart_item['data']['price'])
                ];
                $createdOrder = DB::table('order_items')->insert($newItemsInCurrentOrder);
            }
            
            //delete cart
            Session::forget('cart');
            Session::flush();
            
            $payment_info = $newOrderArr;
            $payment_info['order_id'] = $order_id;
            $request->session()->put('payment_info', $payment_info);
            
            return redirect()->route('ShowPaymentPage');
        } else {
            return redirect()->route('allProducts');
        }
    }
    
    public function createOrder() {
        $cart = Session::get('cart');
        
        //cart is not empty
        if($cart){
            $date = date('Y-m-d H:i:s');
            $newOrderArr = [
                'status' => 'on_hold',
                'date' => $date,
                'delivery_date' => $date,
                'price' => (int) str_replace("$","",$cart->totalPrice)
            ];
            $createdOrder = DB::table('orders')->insert($newOrderArr);
            $order_id = DB::getPdo()->lastInsertId();
            
            foreach ($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = (int) str_replace("$","",$cart_item['data']['price']);
                $newItemsInCurrentOrder = [
                    'item_id' => $item_id,
                    'order_id' => $order_id,
                    'item_name' => $item_name,
                    'item_price' => $item_price
                ];
                $createdOrder = DB::table('order_items')->insert($newItemsInCurrentOrder);
            }
            
            //delete cart
            Session::forget('cart');
            Session::flush();
            
            return redirect()->route('allProducts')->withsuccess('Thanks for the order');
        } else {
            return redirect()->route('allProducts');
        }
    }
    
    
    public function increaseSingleProduct(Request $request, $id) {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id,$product);
        $request->session()->put('cart', $cart);
        //dump($cart);

        return redirect()->route('cartProducts');
    }
   
    public function decreaseSingleProduct(Request $request, $id) {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        if($cart->items[$id]['quantity'] > 1){
            $product = Product::find($id);
            $price = (int) str_replace("$","",$product['price']);
            $cart->items[$id]['quantity'] = $cart->items[$id]['quantity']-1;
            $cart->items[$id]['totalSinglePrice'] = $cart->items[$id]['quantity'] * $price ;
            $cart->updatePriceAndQuantity();

            $request->session()->put('cart',$cart);

        }

        return redirect()->route("cartProducts");
    }
}
