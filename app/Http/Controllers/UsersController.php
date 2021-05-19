<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
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
        return view('users');
    }

    /**
     * User table table data,
     * Ajax request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData(Request $request)
    {

        $users = User::select('id', 'name', 'email', 'role', 'created_at')->where('role', '!=', 'futureRole')->get();

        foreach($users as $key => $item) {
            $item->name = $item->name === null ? '' : $item->name;
            $item->email = $item->email === null ? '' : $item->email;
            $item->role = $item->role === null ? '' : $item->role;
            $item->created = $item->created;
            $item->delete = "<button type=\"button\" data-id=\"{$item->id}\" data-email=\"{$item->email}\" class=\"btn-sm btn-danger delete_btn\">Delete</button>";
        }

        $output = [];
        $output['data'] = $users;
        return response()->json($output);

    }

    /**
     * User stranka table Delete riadok,
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

        $user = User::find($request->id);
        $user->delete();

        return Response()->json([
            'status' => 'success',
        ], 200);

    }

}
