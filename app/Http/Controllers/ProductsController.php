<?php

namespace App\Http\Controllers;

use App\Models\Laravel_test_admin_website\Order;
use App\Models\Laravel_test_admin_website\Product;
use App\Models\Laravel_test_admin_website\ProductOrderPivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductsController extends Controller
{
    /**
     * Display Logs Page
     *
     * @param Request $request
     * @return mixed
     *
     */
    public function index(Request $request)
    {
        return view('products');
    }

    /**
     * Products table vratit data,
     * Ajax request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData(Request $request)
    {

        $products = Product::select('id', 'title', 'description', 'price')->get();

        foreach($products as $key => $item) {
            $item->radio_btn = "<input type=\"radio\" id=\"tbl_radio_btn_{$item->id}\" class=\"products_table_radio\" name=\"products_table_radio\" value=\"{$item->id}\" >";
            $item->title = $item->title === null ? '' : $item->title;
            $item->description = $item->description === null ? '' : $item->description;
            $item->price = $item->price === null ? '' : $item->price;
            $item->create_order = "<button type=\"button\" data-id=\"{$item->id}\" data-title=\"{$item->title}\" class=\"btn-sm btn-success create_order_btn\">Create order</button>";
            $item->delete = "<button type=\"button\" data-id=\"{$item->id}\" class=\"btn-sm btn-danger delete_btn\">Delete</button>";
        }

        $output = [];
        $output['data'] = $products;
        return response()->json($output);

    }


    /**
     * Products page, add data,
     * Ajax call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {

        $validation_rules = [
            'title' => 'required|max:250',
            'description' => 'max:5000|',
            'price' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $products = new Product();
        $products->title = $request->title;
        $products->description = $request->description;
        $products->price = $request->price;

        $products->save();
        $id = $products->id;

        return Response()->json([
            'status' => 'success',
            'id' => $id,
        ], 200);
    }


    /**
     * Products page, return data for editing the entry
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataToUpdateEntry(Request $request)
    {

        if (!$request->has('id')) {
            exit('not valid request');
        }
        $product = Product::find($request->id);

        return response()->json($product);
    }


    /**
     * Products page table update line
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editEntry(Request $request)
    {

        if (!$request->has('id')) {
            exit('not valid request');
        }

        $validation_rules = [
            'title' => 'required|max:250',
            'description' => 'max:5000|',
            'price' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $product = Product::find($request->id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        return Response()->json([
            'status' => 'success',
        ], 200);

    }


    /**
     * Products page, create order
     * Ajax call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(Request $request)
    {

        $validation_rules = [
            'title_orders' => 'required|max:250',
            'description_orders' => 'max:5000|',
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $orders = new Order();
        $orders->title = $request->title_orders;
        $orders->description = $request->description_orders;

        $orders->save();


        $products_orders_pivot = ProductOrderPivot::firstOrCreate([
            'products_id' => $request->product_id,
            'orders_id' => $orders->id
        ]);

        return Response()->json([
            'status' => 'success'
        ], 200);

    }


    /**
     * Products page delete item
     * Ajax call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData(Request $request)
    {
        if (!$request->has('id')) {
            exit('not valid request');
        }
        $product = Product::find($request->id);
        $product->delete();

        return Response()->json([
            'status' => 'success',
        ], 200);

    }

}
