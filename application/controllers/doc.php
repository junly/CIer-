<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 引用流程接入口 
 */
class doc extends MY_Controller
{
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
		$this->load->view('template',$this->template);
	}		
}

/* End of file doc.php */
/* Location: ./application/controllers/doc.php */