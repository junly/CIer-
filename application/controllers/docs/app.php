<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PHP应用List
 */
class app extends MY_Controller
{
	protected $available_method = array(
		'email','chart','page');
	
	public function __construct()
	{
		parent::__construct();
		
		/*hack*/
		if ( ! in_array($this->router->fetch_method(),$this->available_method))
		{
			Message::set('亲..'.$this->router->fetch_method().'模块正在开发','info');
			redirect('/doc/app');
		}
	}
	
	public function email()
	{
		$this->template['content'] = $this->load->view('app/email',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}
	
	public function chart()
	{
		$this->template['content'] = $this->load->view('app/chart',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}	
	
	public function page()
	{
		$this->template['content'] = $this->load->view('app/page',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}		
}
	