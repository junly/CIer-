<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter入门教程和指南
 */
class start extends MY_Controller
{
	/**
	 * 支持的章节 
	 * @var array $available_manual
	 */
	protected $available_manual = array(
		'basic','advance');
	
	public function __construct()
	{
		parent::__construct();
		
		/*hack*/
		if ( ! in_array($this->router->fetch_method(),$this->available_method))
		{
			Message::set('亲..'.$this->router->fetch_method().'章节正在撰写','info');
			redirect('/doc/start');
		}
	}
	
	public function basic()
	{
		$this->template['content'] = $this->load->view('start/basic',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}
}
	