<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
class ProductController extends Controller
{
   //post
   public function ProductEnrollment(Request $request){
    $request->validate([
    "name"=>"required",
    "price"=>"required",
    "owner_email"=>"required|email|unique:products"
    
    ]);
    // craete course
    $product=new Product ();
    $product->name=$request->name;
    $product->price=$request->price;
    $product->owner_email=$request->owner_email;
    $product->save();
    
    // response
    return response()->json([
    'status'=>1,
    'message'=>'product enrolled successfully'
    ],200);
    
        }
        //get
        public function TotalProdcts(){
            $id=auth()->user()->id;
            $products=User::find($id)->Products;
            
            return response()->json([
            'status'=>1,
            'message'=>'total products enrolled',
            'data'=>$products
            ]);
        }
        //get
        public function DeleteProduct($owner_email){
    $owner_email="owner_email:products";
    if(Product::where([
        "owner_email"=>$owner_email
    ])->exists()){
        $product=Product::find($owner_email);
        $product->delete();
        return response()->json([
            'status'=>1,
            'message'=>'product deleted successfully'
        ]);
    }
    else{
        return response()->json([
    'status'=>0,
    'message'=>'product did not found'
        ]);
    
    }
        } 
}
