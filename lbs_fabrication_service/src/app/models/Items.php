<?php
namespace lbs\fab\app\models;

class Items extends \Illuminate\Database\Eloquent\Model {
    protected $table      = 'item';
    protected $primaryKey = 'id';
    protected $fillable= ['id','uri','libelle','tarif','quantite','command_id'];
    //protected $hidden = ['created_at','updated_at'];
    public    $incrementing = true;
    public    $keyType="integer";
    public $timestamps = false;
}
