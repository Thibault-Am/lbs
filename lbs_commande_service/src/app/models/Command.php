<?php
namespace lbs\command\app\models;

class Command extends \Illuminate\Database\Eloquent\Model {
    protected $table      = 'commande';
    protected $primaryKey = 'id';
    protected $fillable= ['id','livraison','nom','mail','montant','token','status'];
    protected $hidden = ['created_at','updated_at'];
    public    $incrementing = false;
    public    $keyType='string';

    public function getItem(){
        return $this->hasMany('lbs\command\app\models\Items','command_id');
    }
}
