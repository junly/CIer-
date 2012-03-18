<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Google 接口调用请求
 */
define('ga_email','best_mrzhao@163.com');
define('ga_password','hellogoogle');
define('ga_profile_id','56953218');

require APPPATH.'libraries/api/gapi.class.php';
/*GA API 路径 http://code.google.com/intl/zh-CN/apis/analytics/docs/gdata/home.html*/
class google extends MY_Controller
{
	protected $ga_service;
	
	protected $ga_path = array(
	'account','report','filter');
	/**
	 * 请求接口数据时候需要 Email,PWD
	 */
	public function __construct($email = NULL , $pwd = NULL)
	{
		parent::__construct();
		
		$this->ga_service = new gapi(ga_email,ga_password); 
		
		/*判断当前接口*/
		if ( ! in_array($this->router->fetch_method(),$this->ga_path))
		{
			die(Format::factory(
				array('error' => '请求路径['.$this->router->fetch_method().']时服务异常'))->to_json());
		}
		
		/*口令认证*/
		if ( ! $this->auth_token())
		{
			die(Format::factory(
				array('error' => '请求认证失败，没得权限。'))->to_json());
		}
	}

	/**
	 *  简单的算法认证
	 *  请求参数+过滤条件的md5匹配吧
	 */
	protected function auth_token()
	{
		return TRUE;
	}
	
	/**
	 * 得到当前google账号的信息 
	 */
	public function account()
	{
//            [accountId] => 30022847
//            [accountName] => CIer GA 数据
//            [profileId] => 57418090
//            [webPropertyId] => UA-30022847-1
//            [currency] => USD
//            [timezone] => America/Los_Angeles
//            [title] => CIer GA 数据
//            [updated] => 2012-03-13T23:48:38.108-07:00	
		$this->ga_service->requestAccountData();

		$account = array();
		
		foreach($this->ga_service->getResults() as $result)
		{		
			array_push($account,$result->getProperties());
		}
		
		echo Format::factory($account)->to_json();
	}
	
	/**
	 * GA数据分析 
	 * 57418090
	 */
	public function report()
	{
/*Feed Data https://www.google.com/analytics/feeds/data
?ids=ga:12345
&dimensions=ga:source,ga:medium
&metrics=ga:visits,ga:bounces
&sort=-ga:visits
&filters=ga:medium%3D%3Dreferral
&segment=gaid::10 OR dynamic::ga:medium%3D%3Dreferral
&start-date=2008-10-01
&end-date=2008-10-31
&start-index=10
&max-results=100
&v=2
&prettyprint=true*/	
		try
		{
			$this->ga_service->requestReportData(ga_profile_id,array('browser','browserVersion','country'),array('pageviews','visits','totalValue'));
			
			echo Format::factory($this->_geneReport($this->ga_service))->to_json();
		}
		catch (Exception $e)
		{
			die(Format::factory(
				array('error' => $e->getMessage()))->to_json());
		}
		

	}
	
	/**
	 * 返回Report数据
	 * @param gapi $gapi_service
	 */
	protected function _geneReport(gapi $gapi_service)
	{
		$report = array();
		/*report_aggregate_metrics主指标*/		
		$report['主指标'] = $gapi_service->getMetrics();
		/*report_root_parameters主参数*/
		$report['数据来源的摘要信息'] = $gapi_service->getParams();
		
		$report['result'] = array();

		foreach ($gapi_service->getResults() as $result)
		{
			array_push($report['result'],array(
				'维度'	=>	$result->getDimesions(),
				'指标'	=>	$result->getMetrics()
			));
		}
		
		return $report;
	
	}
}