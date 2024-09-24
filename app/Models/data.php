<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama', 'tgl', 'suhu', 'ph', 'o2', 'salinitas', 'hasil', 'saran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
