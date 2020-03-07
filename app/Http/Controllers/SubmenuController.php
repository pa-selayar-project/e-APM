<?php

namespace App\Http\Controllers;

use App\Submenu;
use App\Menu;
use Illuminate\Http\Request;
use Redirect, Response;

class SubmenuController extends Controller
{
    public function index()
    {
        $parent = Menu::all();

        $data = Submenu::paginate(10);
        return view('submenu.index', ['data' => $data, 'parent' => $parent]);
    }

    public function store(Request $request)
    {
        $messages = ['required' => 'kolom :attribute wajib diisi!'];
        $request->validate([
            'nama_submenu' => 'required|unique:submenus',
            'link' => 'required',
            'menu_id' => 'required'
        ], $messages);
        $insert = Submenu::create($request->all());
        Response::json($insert);
        return redirect('submenu')->with('message', 'Data Berhasil ditambahkan');
    }

    public function update(Request $request, Submenu $submenu)
    {
        $messages = ['required' => 'kolom :attribute wajib diisi!'];
        $request->validate([
            'nama_submenu' => 'required',
            'link' => 'required',
            'menu_id' => 'required'
        ], $messages);

        $update = Submenu::where('id', $submenu->id)
            ->update([
                'nama_submenu' => $request->nama_submenu,
                'link' => $request->link,
                'menu_id' => $request->menu_id
            ]);
        Response::json($update);
        return redirect('submenu')->with('message', 'Data Berhasil diubah');
    }

    public function destroy(Submenu $submenu)
    {
        $delete = Submenu::destroy($submenu->id);
        Response::json($delete);
        return redirect('submenu')->with('message', 'Data Berhasil dihapus');
    }
}
