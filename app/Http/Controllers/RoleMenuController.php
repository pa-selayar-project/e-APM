<?php

namespace App\Http\Controllers;

use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect, Response;

class RoleMenuController extends Controller
{
    public function index()
    {
        $data = Role::paginate(10);
        return view('admin/role_menu/index', ['data'=> $data]);
    }

    public function store(Request $request)
    {
        $messages = ['required' => 'kolom :attribute wajib diisi!'];
        $request->validate(['role' => 'required|unique:roles'], $messages);
        $insert = Role::create($request->all());
        Response::json($insert);
        return Redirect::back()->with('message', 'Data Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $messages = ['required' => 'kolom :attribute wajib diisi!'];
        $request->validate(['role' => 'required'], $messages);
        $update = Role::where('id', $id)->update(['role'=>$request->role]);
        Response::json($update);
        return Redirect::back()->with('message', 'Data Berhasil diupdate');
    }

    public function destroy(Role $role)
    {
        //
    }
}
