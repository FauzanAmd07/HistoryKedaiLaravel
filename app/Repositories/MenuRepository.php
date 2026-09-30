<?php

namespace App\Repositories;

use App\Contracts\MenuRepositoryInterface;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAllAvailable(): Collection
    {
        return Menu::where('status_menu', 'Tersedia')
            ->with('kategori')
            ->orderBy('nama_menu')
            ->get();
    }

    public function findById(int $id): ?Menu
    {
        return Menu::find($id);
    }

    public function create(array $data): Menu
    {
        return Menu::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $menu = $this->findById($id);
        return $menu ? $menu->update($data) : false;
    }

    public function archive(int $id): bool
    {
        $menu = $this->findById($id);
        return $menu ? $menu->update(['status_menu' => 'Diarsipkan']) : false;
    }
}
