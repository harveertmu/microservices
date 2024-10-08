<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ValidateProductRequest; // Import your custom request
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{
    protected $productObj;
    // GET method to retrieve all Products

    public function __construct()
    {
        // Instantiate the Product model
        $this->productObj = new Product();
    }
    public function index()
    {
        try {
            $products =  $this->productObj->getAllProduct();
            return response()->json([
                'data' => $products,
                'message' => 'All Product List',
            ], 201);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    // for add the product
    public function store(ValidateProductRequest  $request)
    {
        DB::beginTransaction(); // Start the transaction

        try {
            // Create a new product
            $product = $this->productObj->createproduct($request);
            DB::commit();
            return response()->json([
                'message' => 'New Product Create Successfully',
                'data' => $product, // Optional
            ], 201);
        } catch (QueryException $e) {
            // Handle database-related exceptions
            return response()->json([
                'error' => 'Database error: ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            // Handle general exceptions
            DB::rollBack();
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {

            $product=   $this->productObj->getProductById($id);
            return response()->json([
                'message' => 'Product Details',
                'data' => $product, // Optional
            ], 201);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    // PUT method to update the entire Product resource
    public function update(Request $request, $id)
    {
   
        try {
            $product = $this->productObj->getProductById($id);
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->save();
            return response()->json([
                'message' => 'Product Update Successfully',
                'data' => $product, // Optional
            ], 201);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // PATCH method to update partial Product data
    public function patchUpdate(ValidateProductRequest $request, $id)
    {

        try {
            $product =  $this->productObj->getProductById($id);

            if ($request->has('name')) {
                $product->name = $request->input('name');
            }
            if ($request->has('price')) {
                $product->price = $request->input('price');
            }

            $product->save();

            return response()->json([
                'message' => 'Product Update Successfully',
                'data' => $product, // Optional
            ], 201);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // DELETE method to delete a product
    public function destroy($id)
    {
        try {


            $product =  $this->productObj->getProductById($id);
            $product->delete();

            return response()->json([
                'message' => 'Product Delete Successfully',
            ], 201);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                'error' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
