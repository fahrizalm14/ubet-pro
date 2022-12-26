<?php

namespace App\Services\Interfaces;

interface ProjectService
{
    public function getAll(): array;
    public function findById(string $id);
    public function toJson();
}
