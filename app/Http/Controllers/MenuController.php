<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use Illuminate\Http\Request;
use Redirect, Response;

class MenuController extends Controller
{
    public function index()
    {
        $data = Menu::paginate(10);
        return view('admin/menu/index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $messages = ['required' => 'kolom :attribute wajib diisi!'];
        $request->validate([
            'nama_menu' => 'required|unique:menus',
            'icon' => 'required',
            'link' => 'required',
            'tipe' => 'required'
        ], $messages);
        $insert = Menu::create($request->all());
        Response::json($insert);
        return redirect('menu')->with('message', 'Data Berhasil ditambahkan');
    }

    public function update(Request $request, Menu $menu)
    {
        $messages = [
            'required' => 'kolom :attribute wajib diisi!',
            'unique' => 'kolom :attribute sudah ada!'
        ];
        $request->validate([
            'nama_menu' => 'required',
            'icon' => 'required',
            'link' => 'required',
            'tipe' => 'required'
        ], $messages);

        $update = Menu::where('id', $menu->id)
            ->update([
                'nama_menu' => $request->nama_menu,
                'icon' => $request->icon,
                'link' => $request->link,
                'tipe' => $request->tipe
            ]);
        Response::json($update);
        return Redirect::back()->with('message', 'Data Berhasil dirubah');
    }

    public function destroy(Menu $menu)
    {
        $delete = Menu::destroy($menu->id);
        Response::json($delete);
        return redirect('menu')->with('message', 'Data Berhasil dihapus');
    }
}
