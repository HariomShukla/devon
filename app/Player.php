<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $fillable = ['firstName', 'lastName', 'playerImageURI', 'team_id'];

    /**
     * Get the team that owns the player.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
