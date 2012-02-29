<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 小杨的开发之路
 * @author bzhao
 * @copyright 2012
 */


/*
 * bootstrap URL:yang/dashboard
 * 
 * a.邮件
 * URL:yang/email
 * 
 * b.图表
 * URL:yang/chart
 * 
 * c.ajax
 * URL:yang/warehouse
 */
class Yang extends MY_Controller
{
	/**
	 * Email模板
	 * @var FILE
	 */
	protected $email_template;
		
	public function __construct()
	{
		parent::__construct();
		
		/*Config Email Param*/
        $config_email = array(
		'protocol'	=>	'smtp',
		'smtp_host'	=>  'smtp.163.com',
		'smtp_port'	=>	25,
		'smtp_user'	=>	'best_mrzhao@163.com',
		'smtp_pass'	=>	'hello1234'
		);
		
		$this->email_template = $this->config->item('email_template');
		
		$this->load->library('email',$config_email);  
	}
	
	/**
	 * 你的控制台,亲 
	 */
	public function dashboard()
	{
		$this->template['content'] = $this->load->view('dashboard','',TRUE);
    	$this->load->view('template',$this->template);	
	}
	
	/**
	 * Email 
	 */
	public function email()
	{
		return TRUE;		
	}
	
	/**
	 * 异步发送请求
	 * 发送邮件 
	 */
	public function ajaxMail()
	{
		if (isset($_POST)
			&& isset($_POST['send_mail']))
		{
			if ( ! isset($_POST['send_to']) OR ! valid_email($_POST['send_to']))
			{
				die(json_encode(array(
            		'retCode' => 'F',
            		'retMsg'  => '地址无效,青年'))); 
			}
			try 
			{
				/*处理下URL*/
				$this->email_template = str_replace("{url}",
													current_url(), 
													$this->email_template);
				
				if ( ! $this->_sendMail($_POST['send_to']))
				{
					die(json_encode(array(
            			'retCode' => 'F',
            			'retMsg'  => '参数对了，仍然报错'))); 
				}
				
				Message::set('邮件已经发出去了,查收下');
				die(json_encode(array(
            		'retCode' => 'S',
            		'retMsg'  => 'Send Mail Success'))); 
			}
			catch (Exception $e)
			{
				die(json_encode(array(
            		'retCode' => 'F',
            		'retMsg'  => $e->getMessage()))); 				
			}
		}
		
        die(json_encode(array(
            		'retCode' => 'F',
            		'retMsg'  => 'Invalid Form Data')));   
		
	}
	
	/**
	 * 发送吧 
	 */
	private function _sendMail($sendto = '')
	{
		@set_time_limit(60);
		$this->email->set_newline("\r\n");
		$this->email->from('best_mrzhao@163.com', 'bzhao');
		$this->email->to($sendto); 
		$this->email->subject($this->config->item('email_subject'));
		$this->email->message($this->email_template);
			
		return $this->email->send();
	}
	
	public function chart()
	{
		return TRUE;
	}
	
	
	private function _geneData()
	{
		
	}
	
	
}

/* End of file yang.php */
/* Location: ./application/controllers/yang.php */