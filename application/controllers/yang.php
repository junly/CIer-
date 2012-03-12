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
	protected $chart_available = array('Img','Flash','Trend','Line');
	
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
			
			
			$_embed = "<EMBED src='".base_url()."css/pie3d.swf?chartWidth=450&chartHeight=220'" 
				." FlashVars=\"&dataXML=<graph caption='图表Pie'  outCnvBaseFontSize='13' baseFontSize='13' pieYScale='45'  pieBorderAlpha='40' pieFillAlpha='70' pieSliceDepth='15' pieRadius='100' bgAngle='460'>"
				." {$_xml}"
				."</graph>\" quality=high bgcolor=#FFFFFF WIDTH=450 HEIGHT=220 NAME=General ALIGN=middle  wmode=opaque TYPE=application/x-shockwave-flash PLUGINSPAGE=http://www.macromedia.com/go/getflashplayer></EMBED>";
		
			$this->chart_response = array($_embed,TRUE);
			
		}
		catch (Exception $e)
		{
			$this->chart_response =  array($e->getMessage(),FALSE);
		}
	}
	
	/**
	 * 线性图 
	 */
	private function _geneLine()
	{
		try 
		{
			$_xml = '';
			
			foreach ($this->chart_data as $key => $value)
			{
				$_xml .= "<set name='{$key}' value='{$value}' />";
			}
			
			$_embed = "<EMBED src='".base_url()."css/column3d.swf?chartWidth=450&chartHeight=220'" 
				." FlashVars=\"&dataXML=<graph caption='LIne Chart'  oshownames='1' showvalues='1' decimalPrecision='0' yaxisminvalue='0' yaxismaxvalue='100' animation='1' outCnvBaseFontSize='12' baseFontSize='12' xaxisname='日期' yaxisname='需求量'>"
				." {$_xml}"
				."</graph>\" quality=high bgcolor=#FFFFFF WIDTH=450 HEIGHT=220 NAME=General ALIGN=middle  wmode=opaque TYPE=application/x-shockwave-flash PLUGINSPAGE=http://www.macromedia.com/go/getflashplayer></EMBED>";
		
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
	
	/**
	 * 打印Page信息 
	 */
	public function pageCSV()
	{
 		header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Page.csv"');
		
        $title="\"ID\",\"Title\",\"Percent\",\"Desc\"".PHP_EOL;
		echo $title;
		
		try
		{
			@set_time_limit(60);
	
			foreach ($this->page_data  as  $page)
			{   
				$printfline = '';
				$attrKey = 0;
		
 				while(TRUE)
 				{
					/*break*/
 					if ( ! isset($page[$attrKey]))
 						break;
 						
 					$printfline .= rtrim("\"{$page[$attrKey]}\"",',').',';
 					
 					$attrKey++;
 				}
 				
 				$printfline .= PHP_EOL;
 				
    			echo $printfline;
 			}
		}
		
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	/**
	 * Excel处理
	 */
	public function pageExcel()
	{
    	$this->load->library('excel',array('action' => 'chart'));
    	
    	$this->excel->addArray($this->page_data);
    	//Enom sdsa Domain Record
		$this->excel->worksheet_title = "Chart Page";
		//Enom sdsa Domain Record
		$this->excel->generateXML("Chart Page");		
	}
	
	/**
	 * 多表的Excel处理-PHP Excel的使用
	 */
	public function pageHighExcel()
	{		
		/*PHPExcel*/
		/*http://phpexcel.codeplex.com/*/
		@set_time_limit(100);
		require_once APPPATH.'libraries/PHPExcel.php';

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setCreator("Bzhao")
							 ->setLastModifiedBy("Bzhao")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '字符串内容')// 字符串内容  
			->setCellValue('A2', 26)          // 数值  
			->setCellValue('A3', true)         // 布尔值  
			->setCellValue('A4', '=SUM(A2:A2)'); // 公式  

		$objPHPExcel->getActiveSheet()->setTitle('简单样式');
		
		$objPHPExcel->getActiveSheet()->setCellValueExplicit('A5', '847475847857487584',   
                                   PHPExcel_Cell_DataType::TYPE_STRING);  
  
		$objPHPExcel->getActiveSheet()->mergeCells('B1:C22');  

		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);  
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);  
  
		$objStyleA5 = $objPHPExcel->getActiveSheet()->getStyle('A5');  
  
		$objStyleA5  
    		->getNumberFormat()  
   			->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);  
  
		$objFontA5 = $objStyleA5->getFont();  
		$objFontA5->setName('Courier New');  
		$objFontA5->setSize(10);  
		$objFontA5->setBold(true);  
		$objFontA5->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);  
		$objFontA5->getColor()->setARGB('FF999999');  
  
		$objAlignA5 = $objStyleA5->getAlignment();  
		$objAlignA5->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);  
		$objAlignA5->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  
  
		$objBorderA5 = $objStyleA5->getBorders();  
		$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		$objBorderA5->getTop()->getColor()->setARGB('FFFF0000'); // color  
		$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		$objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
		$objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  
  
		$objFillA5 = $objStyleA5->getFill();  
		$objFillA5->setFillType(PHPExcel_Style_Fill::FILL_SOLID);  
		$objFillA5->getStartColor()->setARGB('FFEEEEEE');  
  
		
		$objPHPExcel->getActiveSheet()->getComment('B1')->setAuthor('bzhao');
		$objCommentRichText = $objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun('批注:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun("\r\n");
		$objPHPExcel->getActiveSheet()->getComment('B1')->getText()->createTextRun('简单的批注信息');
		$objPHPExcel->getActiveSheet()->getComment('B1')->setWidth('100pt');
		$objPHPExcel->getActiveSheet()->getComment('B1')->setHeight('100pt');
		$objPHPExcel->getActiveSheet()->getComment('B1')->setMarginLeft('150pt');
		$objPHPExcel->getActiveSheet()->getComment('B1')->getFillColor()->setRGB('EEEEEE');		
		
		$objDrawing = new PHPExcel_Worksheet_Drawing();  
		$objDrawing->setName('BillZhao');  
		$objDrawing->setDescription('BillZhao');  
		$objDrawing->setPath(BASEPATH.'../css/billzhao.jpg');  
		$objDrawing->setHeight(80);  
		$objDrawing->setCoordinates('B1');  
		$objDrawing->setOffsetY(80); 
		$objDrawing->setOffsetX(30); 
		$objDrawing->setRotation(0);  
		$objDrawing->getShadow()->setVisible(true);  
		$objDrawing->getShadow()->setDirection(0);  
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  
  
  
		$objPHPExcel->createSheet();  
		$objPHPExcel->getSheet(1)->setCellValue('A1', '');
		$objPHPExcel->getSheet(1)->setCellValue('B1', '报表设计');
		$objPHPExcel->getSheet(1)->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel( gmmktime(0,0,0,date('m'),date('d'),date('Y')) ));
		$objPHPExcel->getSheet(1)->getStyle('D1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);
		$objPHPExcel->getSheet(1)->setCellValue('E1', '#订单号');

		$objPHPExcel->getSheet(1)->setCellValue('A3', '产品ID');
		$objPHPExcel->getSheet(1)->setCellValue('B3', '描述');
		$objPHPExcel->getSheet(1)->setCellValue('C3', '价格');
		$objPHPExcel->getSheet(1)->setCellValue('D3', 'Amount');
		$objPHPExcel->getSheet(1)->setCellValue('E3', 'Total');

		$objPHPExcel->getSheet(1)->setCellValue('A4', '1001');
		$objPHPExcel->getSheet(1)->setCellValue('B4', 'PHP for dummies');
		$objPHPExcel->getSheet(1)->setCellValue('C4', '20');
		$objPHPExcel->getSheet(1)->setCellValue('D4', '1');
		$objPHPExcel->getSheet(1)->setCellValue('E4', '=C4*D4');

		$objPHPExcel->getSheet(1)->setCellValue('A5', '1012');
		$objPHPExcel->getSheet(1)->setCellValue('B5', 'OpenXML for dummies');
		$objPHPExcel->getSheet(1)->setCellValue('C5', '22');
		$objPHPExcel->getSheet(1)->setCellValue('D5', '2');
		$objPHPExcel->getSheet(1)->setCellValue('E5', '=C5*D5');

		$objPHPExcel->getSheet(1)->setCellValue('E6', '=C6*D6');
		$objPHPExcel->getSheet(1)->setCellValue('E7', '=C7*D7');
		$objPHPExcel->getSheet(1)->setCellValue('E8', '=C8*D8');
		$objPHPExcel->getSheet(1)->setCellValue('E9', '=C9*D9');

		$objPHPExcel->getSheet(1)->setCellValue('D11', 'Total excl.:');
		$objPHPExcel->getSheet(1)->setCellValue('E11', '=SUM(E4:E9)');

		$objPHPExcel->getSheet(1)->setCellValue('D12', 'VAT:');
		$objPHPExcel->getSheet(1)->setCellValue('E12', '=E11*0.21');

		$objPHPExcel->getSheet(1)->setCellValue('D13', 'Total incl.:');
		$objPHPExcel->getSheet(1)->setCellValue('E13', '=E11+E12');


		$objPHPExcel->getSheet(1)->getComment('E11')->setAuthor('bzhao');
		$objCommentRichText = $objPHPExcel->getSheet(1)->getComment('E11')->getText()->createTextRun('提示:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getSheet(1)->getComment('E11')->getText()->createTextRun("\r\n");
		$objPHPExcel->getSheet(1)->getComment('E11')->getText()->createTextRun('这里计算金额');

		$objPHPExcel->getSheet(1)->getComment('E12')->setAuthor('PHPExcel');
		$objCommentRichText = $objPHPExcel->getSheet(1)->getComment('E12')->getText()->createTextRun('提示:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getSheet(1)->getComment('E12')->getText()->createTextRun("\r\n");
		$objPHPExcel->getSheet(1)->getComment('E12')->getText()->createTextRun('这里计算金额');

		$objPHPExcel->getSheet(1)->getComment('E13')->setAuthor('PHPExcel');
		$objCommentRichText = $objPHPExcel->getSheet(1)->getComment('E13')->getText()->createTextRun('提示:');
		$objCommentRichText->getFont()->setBold(true);
		$objPHPExcel->getSheet(1)->getComment('E13')->getText()->createTextRun("\r\n");
		$objPHPExcel->getSheet(1)->getComment('E13')->getText()->createTextRun('汇总');
		$objPHPExcel->getSheet(1)->getComment('E13')->setWidth('100pt');
		$objPHPExcel->getSheet(1)->getComment('E13')->setHeight('100pt');
		$objPHPExcel->getSheet(1)->getComment('E13')->setMarginLeft('150pt');
		$objPHPExcel->getSheet(1)->getComment('E13')->getFillColor()->setRGB('EEEEEE');


		$objRichText = new PHPExcel_RichText();
		$objRichText->createText('样式应用：');

		$objPayable = $objRichText->createTextRun('这里是绿色的');
		$objPayable->getFont()->setBold(true);
		$objPayable->getFont()->setItalic(true);
		$objPayable->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_DARKGREEN ) );
		$objPHPExcel->getSheet(1)->getCell('A18')->setValue($objRichText);


		$objPHPExcel->getSheet(1)->mergeCells('A18:E22');
		$objPHPExcel->getSheet(1)->mergeCells('A28:B28');		// Just to test...
		$objPHPExcel->getSheet(1)->unmergeCells('A28:B28');	// Just to test...

		$objPHPExcel->getSheet(1)->getProtection()->setSheet(true);	// Needs to be set to true in order to enable any worksheet protection!
		$objPHPExcel->getSheet(1)->protectCells('A3:E13', 'PHPExcel');/*PHPExcel为密码*/

		$objPHPExcel->getSheet(1)->getStyle('E4:E13')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

		$objPHPExcel->getSheet(1)->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getSheet(1)->getColumnDimension('D')->setWidth(12);
		$objPHPExcel->getSheet(1)->getColumnDimension('E')->setWidth(12);

		$objPHPExcel->getSheet(1)->getStyle('B1')->getFont()->setName('Candara');
		$objPHPExcel->getSheet(1)->getStyle('B1')->getFont()->setSize(20);
		$objPHPExcel->getSheet(1)->getStyle('B1')->getFont()->setBold(true);
		$objPHPExcel->getSheet(1)->getStyle('B1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getSheet(1)->getStyle('B1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		$objPHPExcel->getSheet(1)->getStyle('D1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$objPHPExcel->getSheet(1)->getStyle('E1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

		$objPHPExcel->getSheet(1)->getStyle('D13')->getFont()->setBold(true);
		$objPHPExcel->getSheet(1)->getStyle('E13')->getFont()->setBold(true);

		$objPHPExcel->getSheet(1)->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getSheet(1)->getStyle('D12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getSheet(1)->getStyle('D13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		$objPHPExcel->getSheet(1)->getStyle('A18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
		$objPHPExcel->getSheet(1)->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$objPHPExcel->getSheet(1)->getStyle('B5')->getAlignment()->setShrinkToFit(true);


		$styleThinBlackBorderOutline = array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('argb' => 'FF000000'),
			),
		),
		);
		$objPHPExcel->getSheet(1)->getStyle('A4:E10')->applyFromArray($styleThinBlackBorderOutline);


		$styleThickBrownBorderOutline = array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THICK,
				'color' => array('argb' => 'FF993300'),
			),
		),
		);
		$objPHPExcel->getSheet(1)->getStyle('D13:E13')->applyFromArray($styleThickBrownBorderOutline);

		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->getStartColor()->setARGB('FF808080');
		$objPHPExcel->getSheet(1)->getStyle('B1')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

		$objPHPExcel->getSheet(1)->setCellValue('D26', '外链');
		$objPHPExcel->getSheet(1)->setCellValue('E26', 'http://cier.phpfogapp.com');
		$objPHPExcel->getSheet(1)->getCell('E26')->getHyperlink()->setUrl('http://cier.phpfogapp.com');
		$objPHPExcel->getSheet(1)->getCell('E26')->getHyperlink()->setTooltip('CI学习站点');
		$objPHPExcel->getSheet(1)->getStyle('E26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getSheet(1)->setCellValue('D27', '内链');
		$objPHPExcel->getSheet(1)->setCellValue('E27', '资源分享');
		$objPHPExcel->getSheet(1)->getCell('E27')->getHyperlink()->setUrl("sheet://'资源分享'!A1");
		$objPHPExcel->getSheet(1)->getCell('E27')->getHyperlink()->setTooltip('资源分享');
		$objPHPExcel->getSheet(1)->getStyle('E27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


		$objPHPExcel->getSheet(1)->insertNewRowBefore(6, 10);
		$objPHPExcel->getSheet(1)->removeRow(6, 10);
		$objPHPExcel->getSheet(1)->insertNewColumnBefore('E', 5);
		$objPHPExcel->getSheet(1)->removeColumn('E', 5);


		$objPHPExcel->getSheet(1)->setTitle('表单设计');


		$objPHPExcel->createSheet();
		$objPHPExcel->getSheet(2)->setCellValue('A1', '亲，PHPExcel的报表很强很丰富。');
		$objPHPExcel->getSheet(2)->getTabColor()->setARGB('FF0094FF');;
		$objPHPExcel->getSheet(2)->getColumnDimension('A')->setWidth(80);
		$objPHPExcel->getSheet(2)->getStyle('A1')->getFont()->setName('Candara');
		$objPHPExcel->getSheet(2)->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getSheet(2)->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getSheet(2)->getStyle('A1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getSheet(2)->setTitle('资源分享');
		$objPHPExcel->setActiveSheetIndex(0);
		$filename = str_replace('.php', '.xlsx', __FILE__);

		self::outputExcel($filename, $objPHPExcel);
	}
	
	protected static function outputExcel($filename , PHPExcel $objPHPExcel)
	{
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		header("Content-Type: application/force-download");   
		header("Content-Type: application/octet-stream");   
		header("Content-Type: application/download");   
		header('Content-Disposition:inline;filename="'.$filename.'"');   
		header("Content-Transfer-Encoding: binary");   
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");   
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");   
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");   
		header("Pragma: no-cache");   
		$objWriter->save('php://output');  		
	}
		
	
	
}

/* End of file yang.php */
/* Location: ./application/controllers/yang.php */