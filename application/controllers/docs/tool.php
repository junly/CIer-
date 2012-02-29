<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 工具List
 */
class tool extends MY_Controller
{
	protected $available_method = array(
		'json');
	
	public function __construct()
	{
		parent::__construct();
		
		/*hack*/
		if ( ! in_array($this->router->fetch_method(),$this->available_method))
		{
			Message::set('亲..'.$this->router->fetch_method().'工具正在开发','info');
			redirect('/doc/tool');
		}
	}
	
	/**
	 * 处理JSON 
	 * url
	 * send_to
	 * send_mail
	 */
	public function json()
	{
	    if ( isset($_POST['path'])  && $_POST['path'] 
	   		 && isset($_POST['param'])  && $_POST['param'])
        {
        	$url = site_url($this->input->post('path'));
        	
        	/*判断参数*/
        	if ( ! is_array(json_decode($this->input->post('param'),TRUE)))
        	{
        		die(urldecode(json_encode(array(
      			'retCode' => 'F',
      			'regMsg'  => urlencode('亲,参数有问题')))));
        	}
        	
        	$param = json_decode($this->input->post('param'),TRUE);
        	
			if ( ! isset($param['send_to']) OR ! $param['send_to']
				 OR ! isset($param['send_mail']) OR ! $param['send_mail'])
			{
        		die(urldecode(json_encode(array(
      			'retCode' => 'F',
      			'regMsg'  => urlencode('亲,参数的名字是send_mail,send_to')))));				 	
			}
			
            $qs = array(
                'send_to' 	=> $param['send_to'], 
                'send_mail' => $param['send_mail'], 
            );
            
        	if ( ! function_exists('curl_init') )
    		{
      			die(urldecode(json_encode(array(
      			'retCode' => 'F',
      			'regMsg'  => urlencode('Could not connect to Server though SSL - libcurl不支持')))));
    		}

            $ch = curl_init();
            
            curl_setopt_array($ch, array(
                CURLOPT_URL 			=> 	$url,
           		CURLOPT_POST            =>  1,           
            	CURLOPT_POSTFIELDS     	=>  http_build_query($qs),/*构造字符串*/               
                CURLOPT_RETURNTRANSFER 	=>  TRUE, 
            ));

            $response = curl_exec($ch);
            
            if (curl_errno($ch))
            {
            	$errno = curl_errno($ch);
    			$errstr = curl_error($ch);
    			
     			die(json_encode(array(
      			'retCode' => 'F',
      			'regMsg'  => "Could not connect to Server - Error($errno) $errstr")));
            }
            
            /*请求OK*/
            die(json_encode(array(
      			'retCode' => 'S',
      			'regMsg'  => $response)));
        }	
       
        die(urldecode(json_encode(array(
      			'retCode' => 'F',
      			'regMsg'  => urlencode('亲,路径和参数都有问题')))));
	}
}
	