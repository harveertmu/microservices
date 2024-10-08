<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Requests\ValidateProductDetailsRequest; // Import your custom request
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class ProductDetailController extends Controller
{
    protected $productDetailsObj;

    public function __construct()
    {

        $this->productDetailsObj = new ProductDetail();
    }

    public function store(ValidateProductDetailsRequest $request)
    {



        try {
            // Create a new product
            $product = $this->productDetailsObj->createproductDetails($request);

            if ($product) {
                return response()->json([
                    'message' => 'New Product details Create Successfully',
                    'data' => $product, // Optional
                ], 201);
            } else {
                return response()->json([
                    'message' => 'New Product not details Create Successfully',
                    'data' => [] // Optional
                ], 201);
            }
        } catch (QueryException $e) {
            // Handle database-related exceptions
            return response()->json([
                'error' => 'Database error: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Handle general exceptions

            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
