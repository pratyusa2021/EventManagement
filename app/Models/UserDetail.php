<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    protected $fillable = ['user_id','date_of_birth', 'address','phone','department_id'];

    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
}
