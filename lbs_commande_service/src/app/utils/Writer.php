<?php

namespace lbs\command\app\utils;

Class Writer{
    static function json_error($rs,$code,$message){
        $rs->withStatus($code);
        $data =[
            'type'=>'error',
            'error'=>$code,
            'message'=>$message
        
        
        ];
        $rs->getBody()->write(json_encode($data));
        return $rs;

    }   
}

