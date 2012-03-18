<?php 
class Curl 
{
    //Curl Get数据
    public static function get($url) {      
        $ch = curl_init();    
        curl_setopt($ch, CURLOPT_URL,$url);     
        curl_setopt($ch, CURLOPT_HEADER, 0);    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     
        $data = curl_exec($ch);        
        curl_close($ch);      
        if ($data)   
            return $data;     
        else
            return false;     
    }     

    //Curl Post数据
    public static function post($url, $vars) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        $data = curl_exec($ch);
        curl_close($ch);
        if ($data)
            return $data;
        else
            return false;
    }

} // End help 
