<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * API应用列表
 */
class api extends MY_Controller
{
	protected $available_api = array(
		'google_analytics');/*'denglu','enom','wepay'*/
	
	
	public function __construct()
	{
		parent::__construct();
		
		/*hack*/
		if ( ! in_array($this->router->fetch_method(),$this->available_api))
		{
			Message::set('亲..'.$this->router->fetch_method().'API调用模板正在开发...','info');
			redirect('/doc/api');
		}
	}
	
	/**
	 * 加载Google分析的数据源 
	 */
	public function google_analytics()
	{
		$this->template['content'] = $this->load->view('api/google_analytics',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}
	
}
	