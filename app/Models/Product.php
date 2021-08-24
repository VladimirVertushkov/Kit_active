<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'salary', 'serial_number','inventory_number', 'storage_id', 'customer_id', 'created_at', 'updated-up'];

}
