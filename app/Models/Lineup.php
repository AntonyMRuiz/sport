<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lineup extends Model
{
    protected $fillable = ['team_id', 'name'];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'lineup_player')
            ->withPivot('position_x', 'position_y')
            ->withTimestamps();
    }
}
