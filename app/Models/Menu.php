<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'menu_id';

    protected $fillable = ['nama', 'deskripsi'];

    public $timestamps = true;
}
