<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'team_id',
        'position_x', 
        'position_y'  
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
