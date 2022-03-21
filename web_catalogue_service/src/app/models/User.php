<?php
namespace lbs\auth\app\models;

class User extends \Illuminate\Database\Eloquent\Model {
    protected $table      = 'user';
    protected $primaryKey = 'id';
    protected $fillable= ['id','email','username','passwd','refresh_token','level'];
    protected $hidden = ['created_at','updated_at'];
    public    $incrementing = false;
    public    $keyType='int';

    
}
