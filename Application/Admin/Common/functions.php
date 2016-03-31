<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/17/2016
 * Time: 6:16 PM
 */
  function dataShow($code,$message = '',$data = array(),$type = 'json'){
    if(!is_numeric($code)){
        return '';
    }
    $type = isset($_GET['format'])?$_GET['format']:'json';
    $result = array(
        'code' => $code,
        'message' => $message,
        'data' => $data
    );

    if($type == 'json'){
        json($code,$message,$data);
        exit;
    }elseif($type == 'array'){
        var_dump($result);
    }elseif($type == 'xml'){
        xml($code,$message,$data);
        exit;
    }else{
        //TODO
    }

}
    /*
     * 按json方式输出数据
     * @param integer code 状态码
     * @param string message 提示信息
     * @param array data 数据
     * return string
     */
 function json($code,$message = '',$data = array()){
    if(!is_numeric($code)){
        return '';
    }
    $result = array(
        'code' => $code,
        'message' => $message,
        'data' => $data
    );
    echo json_encode($result);
    exit;
}
    /*
    * 按xml方式输出数据
    * @param integer code 状态码
    * @param string message 提示信息
    * @param array data 数据
    * return string
    */
   function xml($code,$message = '',$data = array()){
    if(!is_numeric($code)){
        return '';
    }

    $result = array(
        'code' => $code,
        'message' => $message,
        'data' => $data
    );
    header("Content-Type:text/html");
    $xml = "<?xml version = '1.0' encoding = 'UTF-8'?>";
    $xml.="<root>\n";
    $xml.=xmlToEncode($result);
    $xml.="</root>\n";

    echo $xml;
}
 function xmlToEncode($data){
    $xml = $attr='';
    foreach($data as $key => $value){
        if(is_numeric($key)){
            $attr = "id='{$key}'";
            $key = "item" ;
        }
        $xml.= "<{$key} {$attr}>";
        $xml.= is_array($value)?xmlToEncode($value):$value;
        $xml.= "</{$key}>\n";
    }
    return $xml;
}
/*
 * 获取客户端ip
 */
function  clientIP(){
    $cIP  =  getenv ( 'REMOTE_ADDR' );
    $cIP1  =  getenv ( 'HTTP_X_FORWARDED_FOR' );
    $cIP2  =  getenv ( 'HTTP_CLIENT_IP' );
    $cIP1  ?  $cIP  =  $cIP1  : null;
    $cIP2  ?  $cIP  =  $cIP2  : null;
    return   $cIP ;
}