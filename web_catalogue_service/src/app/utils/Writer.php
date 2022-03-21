<?php

namespace lbs\auth\app\utils;

Class Writer{
    static function json_error($rs,$code,$message){
        $rs = $rs->withStatus($code)->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
      
        
        
        $data =[
            'type'=>'error',
            'error'=>$code,
            'message'=>$message
        
        
        ];
        $rs->getBody()->write(json_encode($data));
        return $rs;

    }   
    static function json_output($rs,$code,$data){
        $rs = $rs->withStatus($code)->withHeader( 'Content-Type', 'application/json;charset=utf-8' ) ;
  
        $rs->getBody()->write(json_encode($data));
        return $rs;

    }   
}

