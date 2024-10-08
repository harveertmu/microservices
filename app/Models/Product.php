<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception; // Import Exception class

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price'
    ];

    // get the product by id
    public  function getProductById($id)
    {
        return self::find($id);
    }

    //add a product

    public function createproduct($request)
    {
        try {
            return  self::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
            ]);
        } catch (Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

        //product list

        public function getAllProduct()
        {
            try {
                return  self::with('product_details')->get();
            } catch (Exception $e) {
                // Handle the exception
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }

        public function product_details(){

            return $this->hasMany(ProductDetail::class);

        }
}
