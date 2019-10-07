<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class AdminProductsController extends Controller {
    
    /** 
     * Display all products
    */
    public function index(){
        $products = Product::paginate(3);

        return view("admin.displayProducts",['products'=>$products]);
    }

    /**
     * Dispalay edit product image form
     */
   public function editProductImageForm($id){
       
        $product = Product::find($id);

        return view("admin.editProductImageForm",['product'=>$product]);
   }

   /**
    * Update Product image
    */
   public function updateProductImage(Request $request, $id){

        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();

        if($request->hasFile("image")){
            $product = Product::find($id);
            $isImageExists = Storage::disk('local')->exists("public/products/".$product->image);

            //delete old image
            if($isImageExists){
                //delete image from server
                Storage::delete('public/products/'.$product->image);
            }    
            //upload new image
            $ext = $request->file('image')->getClientOriginalExtension(); //jpg
            $fileName = $request->file('image')->getClientOriginalName(); //imagename.jpg
            $request->image->storeAs("public/products/",$product->image);
            
            //Update image name in DB
            $arrayToUpdate = array('image'=>$product->image);
            DB::table('products')->where('id',$id)->update($arrayToUpdate);

            return redirect()->route("adminDisplayProducts");            

        }else{
            $error =  "No Image Was Selected";
            return $error;
        }

   }

   /**
     * Dispalay edit product form
     */
    public function editProductForm($id){

        $product = Product::find($id);
    
        return view("admin.editProductForm",['product'=>$product]);
    }

   /**
    * Update product
    */
   public function updateProduct(Request $request, $id){

        $arrayToUpdate = array(
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'type'=>$request->input('type'),
            'price'=> (float)str_replace("$","",$request->input('price'))
        );

        DB::table('products')->where('id',$id)->update($arrayToUpdate);

        return redirect()->route("adminDisplayProducts");
   }

   /**
    * Dispalay Create product form
    */
   public function createProductForm(){
        return view("admin.createProductForm");
   }

   /**
    * Store new product to database
    */
   public function sendCreateProductForm(Request $request) {   
        
        
        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();

        $ext = $request->file('image')->getClientOriginalExtension(); //jpg
        $stringImageReformat = str_replace(" ", "", $request->input('name'));
        $imageName = $stringImageReformat.".".$ext;

        $newProductArray = array(
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'image'=>$imageName, 
            'type'=>$request->input('type'),
            'price'=> (float)str_replace("$","",$request->input('price'))
        );

        $imageEncoded = File::get($request->image);
        Storage::disk('local')->put('public/products/'.$imageName, $imageEncoded);  

        $created = DB::table('products')->insert($newProductArray); 

        if($created){
            return redirect()->route("adminDisplayProducts");
        } else {
            return "Product was not created.";
        }

   }

   /**
    *  Delete Product
    */
   public function deleteProduct($id) {
        
        $product = Product::find($id);

        //delete image from server
        $isImageExists = Storage::disk('local')->exists("public/products/".$product->image);
        if($isImageExists){            
            Storage::delete('public/products/'.$product->image);
        } 

        //delete record from database
        Product::destroy($id);

        return redirect()->route("adminDisplayProducts");

   }

}

