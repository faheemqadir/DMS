<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;


class Item extends Model
{
    //
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'productId';
    public $timestamps = false;
}
