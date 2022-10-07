<?php

namespace App\Models;

use App\DTO\UserDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class, "auto_id");
    }

    public function toDto(): UserDto
    {
        return new UserDto($this->id, $this->name, $this->auto?->toDto());
    }
}
