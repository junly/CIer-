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
	const SUBJECT_MAX = 20;
	const CONTENT_MAX = 200;
	const IMGDIR = '../css/chart/';
	const IMGTYPE = '.png';
	const FLASH_HEADER = '';
	/**
	 * Email模板
	 * @var FILE
	 */
	protected $email_template;
	protected $email_subject;
	protected $chart_data;
	protected $chart_response = array();
	protected $chart_color = array('1D8BD1','F1683C','2AD62A','C69EC1','BFEFFF');
	protected $chart_available = array('Img','Flash','Trend');
		
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
		$this->email_subject  = $this->config->item('email_subject');
		
		$this->load->library('email',$config_email);  
	}
	
	/**
	 * 你的控制台,亲 
	 */
	public function dashboard()
	{
		Message::set('亲,无论你点击哪里，请君时刻保持激情','info');
		$this->template['content'] = $this->load->view('dashboard','',TRUE);
    	$this->load->view('template',$this->template);	
	}
	
	/**
	 * Email 
	 */
	public function email()
	{
		return TRUE;
		/*Example Code Launch Chart*/
		$this->chart_data = $this->_geneData();
		$this->_geneImg();
		print_r($this->chart_response);
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
		
				/*hack for 主题和内容*/		
				if ( isset($_POST['mail_subject']) && ! empty($_POST['mail_subject']))
				{
					$this->email_subject = strip_tags($_POST['mail_subject']);
					
					try 
					{
						if ( mb_strlen($this->email_subject) > self::SUBJECT_MAX)
						{
							throw new LengthException('亲，邮件主题长度过了'.self::SUBJECT_MAX);
						}
					}
					catch (LengthException $e)
					{
						die(json_encode(array(
							'retCode' 	=> 'F',
							'retMsg'	=> $e->getMessage())));
					}
				}													
				
				if ( isset($_POST['mail_content']) && ! empty($_POST['mail_content']))
				{
					$this->email_template = $_POST['mail_content'];
					
					try 
					{
						if ( mb_strlen($this->email_template) > self::CONTENT_MAX)
						{
							throw new LengthException('亲，邮件内容长度过了'.self::CONTENT_MAX);
						}
					}
					catch (LengthException $e)
					{
						die(json_encode(array(
							'retCode' 	=> 'F',
							'retMsg'	=> $e->getMessage())));
					}					
				}		
													
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
	 * @param string $send_to 收件人
	 */
	private function _sendMail($sendto = '')
	{
		@set_time_limit(60);
		$this->email->set_newline("\r\n");
		$this->email->from('best_mrzhao@163.com', 'bzhao');
		$this->email->to($sendto); 
		$this->email->subject($this->email_subject);
		$this->email->message($this->email_template);
			
		return $this->email->send();
	}
	
	public function ajaxChart()
	{
		/*判断$_POST,option*/
		if (isset($_POST)
			&& isset($_POST['flag']))
		{
			if ( ! isset($_POST['option']) OR ! in_array($_POST['option'],$this->chart_available))
			{
				die(json_encode(array(
            		'retCode' => 'F',
            		'retMsg'  => '亲，你选择的图表类型目前不支持'))); 
			}
			try 
			{
				
				$this->chart_data = $this->_geneData();
				
				if (method_exists($this, '_gene' . $_POST['option']))
				{
					call_user_func(array($this, '_gene' . $_POST['option']));
				}

				else
				{
					throw new Exception('Chart class does not support conversion from "' . $_POST['option'] . '".');
				}
				
				/*加载图表*/
				list($data,$flag) = $this->chart_response;
				
				if ($flag === FALSE)
				{
					die(json_encode(array(
            			'retCode' => 'F',
            			'retMsg'  => $data))); 						
				}
				
				die(json_encode(array(
            			'retCode' => 'S',
            			'retMsg'  => $data))); 	

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
	 * 处理数据做验证 
	 */
	private function _geneData()
	{
		return $this->config->item('chart_data');
	}
	
	
	/**
	 * 生成图片 
	 * @return 返回结果集 和操作符
	 */
	private function _geneImg()
	{
		try 
		{
			/*标签,百分比/
			$this->piechart->showLabel(true);
			$this->piechart->showPercent(true);
			$this->piechart->showParts(true);
			$this->piechart->setWidth(250);
			
			/*字体库 微软雅黑*/
			$this->piechart->setFont(BASEPATH.'fonts/MSYH.TTF',10);
			$this->piechart->setLegend('round');	
		
			/*设置数值和标签*/
			$this->piechart->setData(array_values($this->chart_data));
			$this->piechart->setLabels(array_keys($this->chart_data));
		
			/*生成图片*/
			$hash = md5("img-run");
		
			$this->piechart->Generate(BASEPATH.self::IMGDIR . $hash . self::IMGTYPE);
		
			$chart_img = '<img src='.base_url().'css/chart/'.$hash.self::IMGTYPE.'>';
		
			$this->chart_response = array($chart_img,TRUE);
		}
		catch (Exception $e)
		{
			$this->chart_response =  array($e->getMessage(),FALSE);
		}
			
	}
	
	/**
	 * Flash处理 
	 */
	private function _geneFlash()
	{
		try 
		{
			$_xml = '';
			
			foreach ($this->chart_data as $key => $value)
			{
				$_xml .= "<set name='{$key}' value='{$value}' />";
			}
			
			
			$_embed = "<EMBED src='".base_url()."css/pie3d.swf?chartWidth=400&chartHeight=200'" 
				." FlashVars=\"&dataXML=<graph caption='图表Pie'  outCnvBaseFontSize='13' baseFontSize='13' pieYScale='45'  pieBorderAlpha='40' pieFillAlpha='70' pieSliceDepth='15' pieRadius='100' bgAngle='460'>"
				." {$_xml}"
				."</graph>\" quality=high bgcolor=#FFFFFF WIDTH=400 HEIGHT=200 NAME=General ALIGN=middle  wmode=opaque TYPE=application/x-shockwave-flash PLUGINSPAGE=http://www.macromedia.com/go/getflashplayer></EMBED>";
		
			$this->chart_response = array($_embed,TRUE);
			
		}
		catch (Exception $e)
		{
			$this->chart_response =  array($e->getMessage(),FALSE);
		}
	}
	
	
	/**
	 * trend 趋势图
	 */
	private function _geneTrend()
	{
		try 
		{
			$_trendXml = '';
			$_trendXml = "<chart  lineThickness='3' showValues='0' formatNumberScale='2' anchorRadius='2' divLineAlpha='200' divLineColor='CC3300' divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridColor='CC3300' shadowAlpha='40' labelStep='6' numvdivlines='5' chartRightMargin='35' bgColor='FFFFFF,CC3300' bgAngle='270' bgAlpha='10,10' alternateHGridAlpha='5' legendPosition='RIGHT '>";
			$_trendXml.= "<categories>";
	
			//当月天数
			for ($i=1;$i<=date('t');$i++)
			{
				$time = date("{$i}");
				$_trendXml.= "<category label='$time'/>";
			}
	
			$_trendXml.= "</categories>";

			/*1D8BD1 F1683C 2AD62A C69EC1*/
			$_colorKey = 0;
			foreach ($this->chart_data as $key => $value)
			{
				if ( ! isset($this->chart_color[$_colorKey]))
					break;
					
				$_trendXml .= "<dataset seriesName='{$key}' color='".$this->chart_color[$_colorKey]."' anchorBorderColor='".$this->chart_color[$_colorKey]."' anchorBgColor='".$this->chart_color[$_colorKey]."'>";
				
				for ($i=1;$i<=date('t');$i++)
				{
					$value = rand(0, 100);
					$_trendXml .= "<set value='$value'/>";
				}
				$_trendXml .= "</dataset>";
				$_colorKey ++;
			}
		
		
			$_trendXml.="<styles><definition><style name='CaptionFont' type='font' size='16'/></definition><application><apply toObject='CAPTION' styles='CaptionFont'/><apply toObject='SUBCAPTION' styles='CaptionFont'/></application></styles>";
			$_trendXml.= "</chart>";

			$_embed ="<embed src='".base_url()."css/MSLine.swf?registerWithJS=1'"
						. "  FlashVars=\"&dataXML={$_trendXml}\" quality=high width=500 height=230 name=sampleChart allowScriptAccess=always type=application/x-shockwave-flash pluginspage=http://www.macromedia.com/go/getflashplayer />";
		
		
		 	$this->chart_response = array($_embed,TRUE);
			
		}
		catch (Exception $e)
		{
			$this->chart_response =  array($e->getMessage(),FALSE);
		}
	}
	
	
}

/* End of file yang.php */
/* Location: ./application/controllers/yang.php */