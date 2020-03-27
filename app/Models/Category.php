<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function __construct()
    {
        $this->middleware('auth:admin');   
    }
}
