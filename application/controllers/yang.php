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
	
	/**
	 * 分页数据源
	 * id title  percent desc
	 */
	protected $page_data = array(
		array(1,'Home',10,'Home首页'),
		array(2,'GetStart',10,'CodeIgniter框架入门'),
		array(3,'API设计',20,'API开发与应用'),
		array(4,'工具',10,'工具开发与应用'),
		array(5,'PHP应用',20,'PHP应用'),
		array(6,'深渊',40,'Linux学习与分享'),
		array(1,'Home',10,'Home首页'),
		array(2,'GetStart',10,'CodeIgniter框架入门'),
		array(3,'API设计',20,'API开发与应用'),
		array(4,'工具',10,'工具开发与应用'),
		array(5,'PHP应用',20,'PHP应用'),
		array(6,'深渊',40,'Linux学习与分享'),
		array(1,'Home',10,'Home首页'),
		array(2,'GetStart',10,'CodeIgniter框架入门'),
		array(3,'API设计',20,'API开发与应用'),
		array(4,'工具',10,'工具开发与应用'),
		array(5,'PHP应用',20,'PHP应用'),
		array(6,'深渊',40,'Linux学习与分享'),
	);
	
	/**
	 * 当前页码
	 * @var int 
	 */
	protected $current_page;
	
	/**
	 * 每页项目数量
	 * @var int
	 */
	protected $per_page;
	protected $page_response = array();
	protected $page_header = '<table class="table table-striped table-bordered table-condensed">';
	protected $page_thead = '<thead>
				<tr>
                    <th style="width: 10%">ID</th>
                    <th style="width: 30%">Title</th>
                    <th style="width: 10%">Percent</th>
                    <th>Desc</th>
                </tr>
                </thead>';
	
		
	public function __construct()
	{
		parent::__construct();
		
		/*Config Email Param*/
        $config_email = array(
		'protocol'	=>	'smtp',
		'smtp_host'	=>  'smtp.163.com',
		'smtp_port'	=>	25,
		'smtp_user'	=>	'best_mrzhao@163.com',
		'smtp_pass'	=>	'hello1234',
		'wordwrap'	=>	FALSE,/*取消自动换行*/
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
	
	/**
	 * ajax分页
	 */
	public function ajaxPage()
	{
		if (isset($_POST)
			&& isset($_POST['flag']))
		{
			/*分页码*/
			if ( ! isset($_POST['page']) || empty($_POST['page']))
			{
				$this->current_page = 1;
			}
			else
			{
				$this->current_page = intval($_POST['page']);
			}
			
			/*per_page*/
			if ( ! isset($_POST['limit']) || empty($_POST['limit']))
			{
				$this->per_page = 1;
			}
			else
			{
				$this->per_page = intval($_POST['limit']);
			}			
			
			
			/*处理数据*/
			try 
			{
				if (method_exists($this, '_genePage' ))
				{
					call_user_func(array($this, '_genePage'));
				}
				else
				{
					throw new Exception('没有生成数据源的方法');
				}
								
				list($data,$flag) = $this->page_response;
				
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
	 * 处理数据源
	 */
	private function _genePage()
	{
		try 
		{
			$html = '';
			/*分页*/			
			$this->load->library('pagination');
			$config['base_url'] = site_url('yang/ajaxPage');
			$config['total_rows'] = count($this->page_data);
			$config['per_page'] = $this->per_page; 
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = 2;
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';			
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = '→';
			$config['next_tag_close'] = '<li>';
			$config['next_tag_close'] = '</li>';	
			$config['prev_link'] = '←';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';	

			/*处理结果集*/
        	$total_pages = 0;
        	if ($config['total_rows'] > 0)
        	{
            	$total_pages = ceil($config['total_rows'] / $config['per_page']);
        	}
        	if ($this->current_page > $total_pages) $this->current_page = $total_pages;
       		$start = $config['per_page'] * $this->current_page - $config['per_page']; // do not put $limit*($page - 1)
        	if ($start < 0) $start = 0;		
        	
        	$data['ret'] = array_slice($this->page_data, $start,$config['per_page']);
			
			/*起作用了*/
			$config['cur_page'] = $this->current_page;
			$this->pagination->initialize($config);       

			if (is_array($data['ret']) && $data['ret'])
			{
				$html .= $this->page_header . $this->page_thead;
				foreach ($data['ret'] as $value) 
				{
					$html .= '<tr>';
					$html .= '<td>'.$value[0].'</td>';
					$html .= '<td>'.$value[1].'</td>';
					$html .= '<td>'.$value[2].'</td>';
					$html .= '<td>'.$value[3].'</td>';
					$html .= '</tr>';
				}
				$html .= '</table>';
			}
			
			$html .= $this->pagination->create_links();	
			
			$this->page_response = array($html,TRUE);
		}
		catch (Exception $e)
		{
			$this->page_response =  array($e->getMessage(),FALSE);
		}		
	}
	
	
	/**
	 * 数据格式转换 
	 */
	public function ajaxFormat()
	{
		
	}
	
	
}

/* End of file yang.php */
/* Location: ./application/controllers/yang.php */