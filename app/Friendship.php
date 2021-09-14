<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Friendship extends Model
{

    protected $fillable = ['requester','user_requested','status'];

}
