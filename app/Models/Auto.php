<?php

namespace App\Models;

use App\DTO\AutoDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    public function toDto(): AutoDto
    {
        return new AutoDto($this->id, $this->name);
    }
}
