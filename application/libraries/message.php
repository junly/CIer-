<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message
{
	/**
	 * success,error,info,block
	 */
	public static function set($msg,$type = 'success')
	{
		$session = &load_class('Session');
		$msg_code = '<div class="alert alert-'.$type.'"><strong>'.$type.'!</strong>'.$msg.'<a class="close" data-dismiss="alert" href="#">&times;</a></div>';
		$session->set_flashdata('message',$msg_code);
	}
	
}