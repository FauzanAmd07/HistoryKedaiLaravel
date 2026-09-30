<?php

namespace App\Contracts;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

interface MenuRepositoryInterface
{
    public function getAllAvailable(): Collection;
    public function findById(int $id): ?Menu;
    public function create(array $data): Menu;
    public function update(int $id, array $data): bool;
    public function archive(int $id): bool;
}
