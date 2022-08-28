<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //const CREATED_AT = 'customer_added_on';
    //const UPDATED_AT = 'customer_updated_on';

   
   
   
}
