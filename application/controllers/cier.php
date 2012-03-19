<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cier小站数据接口 ,前端控制层
 * 结合数据库，把CIer小站整个站点数据推出去，提供CIER_SDK(采用命令行模式)
 * 数据回调返回 (接口数据，接口SDK代码)
 * @copyright 2012 
 */
class Cier extends MY_Controller
{
	/**
	 * 调用示例
	 * $this->cier_service->getCierCodeByOption('linux','chapter01','json')
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * 应用流程
	 * 
	 * 参数认证 (错误处理)
	 * |
	 * 数据抓取
	 * |
	 * 数据返回
	 * 采用左右处理
	 * span4,span6
	 */
}

/* End of file cier.php */
/* Location: ./application/controllers/cier.php */