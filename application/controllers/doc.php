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
	 * Format实例 
	 */
	public function json()
	{
		$a = array('d');
		$format = Format::factory($a);
		echo $format->to_json();
	}
}

/* End of file doc.php */
/* Location: ./application/controllers/doc.php */