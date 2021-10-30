<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = ['name', 'logoURI'];

    /**
     * Get the players for the teams.
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
