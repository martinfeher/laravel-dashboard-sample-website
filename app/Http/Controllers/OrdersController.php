<?php

namespace App\Http\Controllers;

use App\Models\Laravel_test_admin_website\Order;
use App\Models\Laravel_test_admin_website\Product;
use App\Models\Laravel_test_admin_website\ProductOrderPivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller
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
        $products = Product::select('id', 'title')->get();
        return view('orders')
            ->with('products', $products);
    }

    /**
     * Orders table return data
     * Ajax request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData(Request $request)
    {
        if (Auth::user()->isAdministrator()) {
            $orders = Order::select('id', 'title', 'description', 'user_id', 'document_name')->get();
        } else {
            $orders = Order::select('id', 'title', 'description', 'document_name')
                ->where('user_id', Auth::user()->id)
                ->get();
        }

        $orders = $orders->load('products');

        foreach($orders as $key => $item) {

            $item->radio_btn = "<input type=\"radio\" id=\"tbl_radio_btn_{$item->id}\" class=\"orders_table_radio\" name=\"orders_table_radio\" value=\"{$item->id}\" >";
            $item->added_products = $item->products()->pluck('products_id')->implode(',');
            $item->document_name = $item->document_name === null ? '' : $item->document_name;
            $item->delete = "<button type=\"button\" data-id=\"{$item->id}\" data-title=\"{$item->title}\" class=\"btn-sm btn-danger delete_btn\">Delete</button>";
        }

        $output = [];
        $output['data'] = $orders;
        return response()->json($output);
    }

    /**
     * Orders page, add data,
     * Ajax call
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createEntry(Request $request)
    {

        $validation_rules = [
            'title' => 'required|max:250',
            'description' => 'max:5000|',
            'document_upload' => 'mimes:jpg|JPG',
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $orders = new Order;
        $orders->title = $request->title;
        $orders->description = $request->description;

        $document_name = '';
        if ($request->hasfile('document_upload')) {
            $filenameWithExt = $request->file('document_upload')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('document_upload')->getClientOriginalExtension();
            $document_name = $filename . '_' . time() . '.' . $extension;
            $document_path = $request->file('document_upload')->storeAs('public/uploads', $document_name);
            $orders->document_name = $document_name;
            $orders->document_path = $document_path;
        }

        $orders->save();
        $id = $orders->id;

        $products_orders_pivot = ProductOrderPivot::firstOrCreate([
            'products_id' => $request->products,
            'orders_id' => $id
        ]);

        return Response()->json([
            'status' => 'success',
            'id' => $id,
            'document_name' => $document_name,
        ], 200);
    }


    /**
     * Orders page, return data to update entry
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataToUpdateEntry(Request $request)
    {

        if (!$request->has('id')) {
            exit('not valid request');
        }

        $order = Order::find($request->id);
        $order = $order->load('products');
        $order->added_products = $order->products()->pluck('products_id')->implode(',');

        return response()->json($order);
    }


    /**
     * Orders page edit entry
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
            'document_upload' => 'mimes:jpg',
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $order = Order::find($request->id);
        $order->title = $request->title;
        $order->description = $request->description;

        $document_name = '';
        if ($request->hasfile('document_upload')) {
            $filenameWithExt = $request->file('document_upload')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('document_upload')->getClientOriginalExtension();
            $document_name = $filename . '_' . time() . '.' . $extension;
            $document_path = $request->file('document_upload')->storeAs('public/uploads', $document_name);
            $order->document_name = $document_name;
            $order->document_path = $document_path;
        }

        $order->save();

        $products_orders_pivot = ProductOrderPivot::firstOrCreate([
                'products_id' => $request->products,
                'orders_id' => $request->id
            ]);

        return Response()->json([
            'status' => 'success',
        ], 200);

    }

    /**
     * Orders page table delete entry
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
        $order = Order::find($request->id);
        $order->delete();

        return Response()->json([
            'status' => 'success',
        ], 200);

    }

}
