<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupcakes extends Model
{
    use HasFactory;
    protected $table = "cupcakes";
    protected $primary_key = "id";
}
