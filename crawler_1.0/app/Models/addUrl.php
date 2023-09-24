<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addUrl extends Model
{
    protected $table = 'crawler';
    protected $primaryKey = 'id';
    protected $fillable = ['url', 'dep0', 'dep1'];
}
