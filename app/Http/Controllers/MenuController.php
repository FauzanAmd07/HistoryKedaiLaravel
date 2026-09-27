<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('status_menu', 'Tersedia')
            ->with('kategori')
            ->orderByDesc('id_menu')
            ->get();

        return view('dashboard.menu.index', compact('menus'));
    }

    public function create()
    {
        $kategoris = Kategori::where('status_kategori', 'Tersedia')->get();
        return view('dashboard.menu.create', compact('kategoris'));
    }

    public function store(StoreMenuRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('gambar', 'public');
            $data['gambar'] = basename($path);
        }

        Menu::create($data);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        $kategoris = Kategori::where('status_kategori', 'Tersedia')->get();
        return view('dashboard.menu.edit', compact('menu', 'kategoris'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete('gambar/' . $menu->gambar);
            }
            $data['gambar'] = basename($request->file('gambar')->store('gambar', 'public'));
        }

        $menu->update($data);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        $menu->update(['status_menu' => 'Diarsipkan']);
        return redirect()->route('menu.index')->with('success', 'Menu berhasil diarsipkan!');
    }
}
