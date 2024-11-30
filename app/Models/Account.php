<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'account';
    protected $primaryKey = 'id';
    protected $fillable = ['fullname','username','birth','password'];
    protected $dates = ['deleted_at'];
    public $timestamp = true;
}
