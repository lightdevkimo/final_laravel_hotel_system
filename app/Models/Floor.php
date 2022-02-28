<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'created_by',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
