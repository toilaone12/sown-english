<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'question';
    protected $primaryKey = 'id';
    protected $fillable = ['type_id','name','answer','correct'];
    protected $dates = ['deleted_at'];
    public $timestamp = true;
}
