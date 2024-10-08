<?php

// app/Models/ProductDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception; // Import Exception class

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', // Foreign key
        'description',
        'color',
        'size',
        'weight',
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    //add a product

    public function createproductDetails($request)
    {
        try {
           return  self::create([
                'product_id' => $request->input('product_id'),
                'description' => $request->input('description'),
                'color' => $request->input('color'),
                'size' => $request->input('size'),
                'weight' => $request->input('weight')
            ]);
          
        } catch (Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
