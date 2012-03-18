<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PHP应用List
 */
class app extends MY_Controller
{
	protected $available_method = array(
		'email','chart','page','template','format');
	
	protected $ajax_mail = array(
		'b.zhao1@gmail.com',
		'best_mrzhao@163.com',
		'best_mrzhao@yahoo.com',
		'best_mrzhao@sohu.com');
	
	protected $ajax_subject = array(
		'亲，学习贴',
		'亲，我是Cier',
		'自动的',
		'全新的');	
	
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
		$this->template['ajax_mail'] = json_encode($this->ajax_mail);
		$this->template['ajax_subject'] = json_encode($this->ajax_subject);
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
	
	/**
	 * 数据类型转换 
	 */
	public function format()
	{
		$this->template['content'] = $this->load->view('app/format',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}	
	
	
	public function template()
	{
		$this->template['content'] = $this->load->view('app/template',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}		
}
	