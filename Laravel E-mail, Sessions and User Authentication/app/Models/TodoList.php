<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','title','description','due_date','is_active','updated_at','created_at'];
}
