<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */
class doc extends MY_Controller
{
	protected $ajax_method = array(
	'/yang/ajaxMail');
		
	public function __construct()
	{
		parent::__construct();
		
		/*hack*/
		if (in_array($this->router->fetch_method(),array('model','code')))
		{
			Message::set('亲..'.$this->router->fetch_method().'导航正在设计...','info');
			redirect('/doc/home');
		}		
	}
	
	public function home()
	{
		$this->template['content'] = $this->load->view('home',$this->template,TRUE);
		$this->load->view('template',$this->template);
	}
	
	public function start()
	{
		$this->template['content'] = $this->load->view('start',$this->template,TRUE);
		$this->load->view('template',$this->template);
	}
	
	public function api()
	{
		$this->template['content'] = $this->load->view('api',$this->template,TRUE);
		$this->load->view('template',$this->template);
	}	
	
	public function app()
	{
		$this->template['content'] = $this->load->view('app',$this->template,TRUE);
		$this->load->view('template',$this->template);
	}	
	
	public function tool()
	{
		$this->template['ajax_method'] = json_encode($this->ajax_method);
		$this->template['content'] = $this->load->view('tool',$this->template,TRUE);
		$this->load->view('template',$this->template);
	}	

	public function linux()
	{
		$this->template['content'] = $this->load->view('linux',$this->template,TRUE);
		$this->load->view('template',$this->template);
	}	
	
	public function resource()
	{
		$this->template['content'] = $this->load->view('resource',$this->template,TRUE);
		$this->load->view('template',$this->template);
	}	
	
	public function bzhao()
	{
		$this->template['content'] = $this->load->view('bzhao',$this->template,TRUE);
		$this->template['GA'] = TRUE;/*调用GA代码*/
		$this->load->view('template',$this->template);
	}

	/**
	 * 通用模型
	 */
	public function model()
	{
		$this->template['content'] = $this->load->view('model',$this->template,TRUE);
		$this->load->view('template',$this->template);		
	}
	
	/**
	 * 代码PK 
	 */
	public function code()
	{
		$this->template['content'] = $this->load->view('code',$this->template,TRUE);
		$this->load->view('template',$this->template);			
	}
	
}

/* End of file doc.php */
/* Location: ./application/controllers/doc.php */