<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $timestamps = false;
    protected $fillable = ['tm_name','tm_slug','tm_dealer_id','tm_user_id','tm_created','tm_updated'];
}
