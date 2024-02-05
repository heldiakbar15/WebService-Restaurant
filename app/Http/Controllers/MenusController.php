<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenusController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return response()->json(['data' => $menus], Response::HTTP_OK);
    }

    public function show($id)
    {
        $menu = Menu::find($id);

        if ($menu) {
            return response()->json(['data' => $menu], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Menu tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(Request $request)
    {
        $validator = app('validator')->make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $menu = Menu::create($request->all());

        return response()->json(['message' => 'Menu berhasil dibuat', 'data' => $menu], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
        $validator = app('validator')->make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $menu->update($request->all());

            return response()->json(['message' => 'Menu berhasil diperbarui', 'data' => $menu], Response::HTTP_OK);
        }

    public function destroy($id)
    {
        $menu = Menu::find($id);

        if ($menu) {
            $menu->delete();
            return response()->json(['message' => 'Menu berhasil dihapus'], Response::HTTP_NO_CONTENT);
        } else {
            return response()->json(['message' => 'Menu tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }
    }
}
