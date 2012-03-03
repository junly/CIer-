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
		'basic');/*'basic','advance'*/
	
	
	protected $available_basic = array(
		'chapter01','chapter02');/*'basic','advance'*/	
	
	public function __construct()
	{
		parent::__construct();
		
		/*hack*/
		if ( ! in_array($this->router->fetch_method(),$this->available_manual))
		{
			Message::set('亲..'.$this->router->fetch_method().'章节正在撰写','info');
			redirect('/doc/start');
		}
		
		Message::set('亲..，CI学习，就此拉开帷幕','info');
	}
	
	public function basic($chapter = 'chapter01')
	{
		if ( ! in_array($chapter,$this->available_basic))
		{
			Message::set('亲..常规主题'.$chapter.'章节正在撰写','info');
			redirect('/doc/start');			
		}
		$this->template['chapter'] = $chapter;
		
		$this->template['content'] = $this->load->view('start/basic',$this->template,TRUE);
		
		
		$this->load->view('template',$this->template);		
	}
}
	