<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * bzhao的开发之路
 * 提供实际应用中的代码思路与学习心得，大量的源码阅读，实现Template的调用请求
 * @author bzhao
 * @copyright 2012
 */
class Zhao extends MY_Controller
{
	/**
	 * REST数据源
	 */
	protected $rest_data = array(
	'total'	=>	array(
				'item'	=>	5,
				'catalog'	=> 3),		
	'php'	=>	array(
				'CodeIgnite'	=>	1,
				'Kohana'		=>	1),
	'linux' =>  array(
				'Red Hat'	=> 	1,
				'Centos'	=>	1,),
	'database'  => array(
				'mysql'	=>	1)
	);
	
	protected $rest_params = array(
	'rest_token','rest_path','rest_type');
	
	/**
	 * URL参数
	 * @var array
	 */
	protected $rest_path = array(
	'total','php','linux','database');
	
	protected $rest_response_type = array(
	'xml','json','bug');
	
	protected $rest_error = array(
	'100'   =>	'参数无效',
	'101'	=>	'Token无效',
	'102'	=>	'请求数据源不存在',
	'103'	=>	'请求返回类型不存在',	
	);
	
	protected $rest_usage;
	protected $rest_query;
	protected $rest_response = array();
		
	protected $rest_auth_key = 'cier';
	 
	
	public function __construct()
	{
		parent::__construct();
		

		$this->rest_query = array(
		'rest_token' =>	md5('cier'),
		'rest_path'	 => 'linux',
		'rest_type'	 => 'json');
		
		$this->rest_usage = 'Usage : '.site_url('zhao/rest').'?'.http_build_query($this->rest_query);
	}
	
	/**
	 * Template调用请求 
	 */
	public function template()
	{
	}
	
	
	/**
	 * 实际用例的REST
	 * 验证流程
	 * 判断参数
	 * 判断Token是否有效
	 * 判断数据源
	 * 判断判断返回类型
	 * @throws Exception
	 */
	public function rest()
	{
		try 
		{
			/*对参数进行过滤*/
			if ( ! count($_POST) && ! count($_GET))
			{
				$this->throwRestError('100',$this->rest_usage);
			}

			/*切割接口中的参数*/
			if ( $this->input->is_ajax_request())
			{
				$this->packageAjaxParamsToValid($this->input->post('param'));
			}
			
			if (isset($_POST['param']))
			{
				unset($_POST['param']);
			}

			/*3个交集*/
			if ( count(array_intersect($this->rest_params,array_keys($this->input->get_post()))) < 3)
			{
				$this->throwRestError('100',$this->rest_usage);
			}

			/*token*/
			if (md5($this->rest_auth_key) !== $this->input->get_post('rest_token'))
			{
				$this->throwRestError('101','cier的md5值');
			}
			
			/*数据源*/
			if ( ! in_array($this->input->get_post('rest_path'),$this->rest_path))
			{
				$this->throwRestError('102');
			}
			
			switch($this->input->get_post('rest_path'))
			{
				case 'php':
				case 'linux':
				case 'database':
						$this->rest_response = $this->rest_data[$this->input->get_post('rest_path')];
						break;
				case 'total':
						$this->rest_response = $this->rest_data;
						break;
				default:
						$this->rest_response = $this->rest_data;
						break;
			}
			
			
			/*判断返回类型*/
			if ( ! in_array($this->input->get_post('rest_type'),$this->rest_response_type))
			{
				$this->throwRestError('103');
			}

			
			switch($this->input->get_post('rest_type'))
			{
				case 'json':
						die(Format::factory($this->rest_response)->to_json());
						break;
				case 'xml':
						header('Content-type: application/xhtml+xml');
						die(Format::factory($this->rest_response)->to_xml());
						break;
				default:
						$this->throwRestError('103','未知错误');
			}
			
		}
		catch(Exception $e)
		{
			die(urldecode(Format::factory(array('error' => $e->getMessage()))->to_json())); 
		}
		
		
	}
	
	
	/**
	 * 异常处理 
	 * @param string $errCode
	 * @throws Exception
	 * @todo 处理中文
	 */
	protected function throwRestError($errCode = '100',$extendErr = '')
	{
		
		throw new Exception($errCode.':'.urlencode(($this->rest_error[$errCode].$extendErr)));
	}
	
	/**
	 * 封装Ajax请求的参数
	 */
	protected function packageAjaxParamsToValid($params = '')
	{
        if ( ! is_array(json_decode($params,TRUE)))
        {
        	$this->throwRestError('100','提交的参数要为JSON格式');
        }
        
		$param = json_decode($params,TRUE);	
		
		if ( ! count($param))
		{
			$this->throwRestError('100',$this->rest_usage);
		}
		
		foreach ($param as $key => $value)
		{
			$_GET[$key] = $value;
		}
	}
	
	
}

/* End of file zhao.php */
/* Location: ./application/controllers/zhao.php */