<?php

namespace App;

class Cart {

    public $items; // [ ['id' => ['quantity' => , 'price' => , 'data' =>],....]
    public $totalQuantity;
    public $totalPrice;

    /**
     * Cart constructor.
     */
    public function __construct($prevCart) {
        if($prevCart != null){
            $this->items = $prevCart->items;
            $this->totalQuantity = $prevCart->totalQuantity;
            $this->totalPrice = $prevCart->totalPrice;
        }else{
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
        }
    }

    /**
     * Add Item in cart
     * @param type $id
     * @param type $product
     */
    public function addItem($id,$product){

        $price = (int) str_replace("$","",$product->price);

         //the item already exists
         if(array_key_exists($id,$this->items)){ 
             $productToAdd = $this->items[$id];
             $productToAdd['quantity']++;
             $productToAdd['totalSinglePrice'] = $productToAdd['quantity'] *  $price;             
         }else{ //first time to add this product to cart 
             $productToAdd = ['quantity'=> 1, 'totalSinglePrice'=> $price, 'data'=>$product];
         } 
         
         $this->items[$id] = $productToAdd;
         $this->totalQuantity++;
         $this->totalPrice = $this->totalPrice + $price; 
    }
    
    /**
     * Remove Product from cart
     * @param type $id
     * @param type $product
     */
    public function removeItem($id,$product){

        
     }
     
    /**
     *  update product Price And Quantity
     */
     public function updatePriceAndQuantity() {

        $totalPrice = 0;
        $totalQuanity = 0;

        foreach($this->items as $item){
            $totalQuanity = $totalQuanity + $item['quantity'];
            $totalPrice = $totalPrice + $item['totalSinglePrice'];
        }

        $this->totalQuantity = $totalQuanity;
        $this->totalPrice =  $totalPrice;
     }

    
}
