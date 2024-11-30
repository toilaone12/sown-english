<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeQuestion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'type_question';
    protected $primaryKey = 'id';
    protected $fillable = ['name','number'];
    protected $dates = ['deleted_at'];
    public $timestamp = true;
}
