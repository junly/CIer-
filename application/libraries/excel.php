<?php
class Excel
{

	
    /**
     * Header of excel document (prepended to the rows)
     * 
     * Copied from the excel xml-specs.
     * 
     * @access private
     * @var string
     */
    private $header = "<?xml version=\"1.0\" encoding=\"UTF-8\"?\>
 <Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
 xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
 xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
 xmlns:html=\"http://www.w3.org/TR/REC-html40\">";

    /**
     * Footer of excel document (appended to the rows)
     * 
     * Copied from the excel xml-specs.
     * 
     * @access private
     * @var string
     */
	 private $style  = '
    <Styles>
    <Style ss:ID="Default" ss:Name="Normal">
    <Alignment ss:Vertical="Center"/>
    <Borders/>
    <Font ss:FontName="Times New Roman" x:CharSet="134" ss:Size="12"/>
    <Interior/>
    <NumberFormat/>
    <Protection/>
	</Style>
	<Style ss:ID="s21">
		<Font ss:FontName="Times New Roman" x:CharSet="134" ss:Size="18" ss:Bold="1"/>
	</Style>
	<Style ss:ID="s20">
	<Font ss:FontName="Times New Roman" x:CharSet="134" ss:Size="12" ss:Bold="1"/>
   	<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
	<Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   	</Borders>
	</Style>
	<Style ss:ID="s29">
	<Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   	</Borders>
  	</Style>
  	<Style ss:ID="s35">
   	<Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   	<Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   	</Borders>
   	<NumberFormat ss:Format="@"/>
  	</Style>
 	</Styles>';
	
	
    private $footer = "</Workbook>";

    /**
     * Document lines (rows in an array)
     * 
     * @access private
     * @var array
     */
    private $lines = array ();

    /**
     * Worksheet title
     *
     * Contains the title of a single worksheet
     *
     * @access private 
     * @var string
     */
    public $worksheet_title = "";

    
    public $excelhead = " ";
    
    function __construct($param = array())
    {
		if ( ! isset($param['action']))
		{
			$param['action'] = 'GetUserDomains';
		}
		
		switch ($param['action']) 
		{
			//配置header
			case 'chart':
					$_Header = array('ID','TITLE','PERCENT','DESC');
					break;
			default:
					$_Header = array('ID','TITLE','PERCENT','DESC');
					break;
		}
		
		//添加表头
		$this->excelhead = "<Row/>\n<Row>\n"; 
		foreach($_Header as $row)
		{
			$this->excelhead .= "<Cell ss:StyleID=\"s20\"><Data ss:Type=\"String\">".$row."</Data></Cell>\n";
		}
		$this->excelhead .= "</Row>\n";
    	
    }
    /**
     * Add a single row to the $document string
     * 
     * @access private
     * @param array 1-dimensional array
     * @todo Row-creation should be done by $this->addArray
     */
    private function addRow ($array)
    {

        // initialize all cells for this row
        $cells = "";

        // foreach key -> write value into cells
        foreach ($array as $k => $v)
        {
           	if(is_numeric($v))
			{
				$cells .= "<Cell ss:StyleID=\"s29\"><Data ss:Type=\"Number\">" . $v . "</Data></Cell>\n"; 
			}
			else
			{
				$cells .= "<Cell ss:StyleID=\"s29\"><Data ss:Type=\"String\">" . $v . "</Data></Cell>\n"; 
			}
        }
        // transform $cells content into one row
        $this->lines[] = "<Row>\n" . $cells . "</Row>\n";

    }

    /**
     * Add an array to the document
     * 
     * This should be the only method needed to generate an excel
     * document.
     * 
     * @access public
     * @param array 2-dimensional array
     * @todo Can be transfered to __construct() later on
     */
    public function addArray ($array)
    {

        // run through the array and add them into rows
        foreach ($array as $k => $v):
            $this->addRow ($v);
        endforeach;

    }

    /**
     * Set the worksheet title
     * 
     * Checks the string for not allowed characters (:\/?*),
     * cuts it to maximum 31 characters and set the title. Damn
     * why are not-allowed chars nowhere to be found? Windows
     * help's no help...
     *
     * @access public
     * @param string $title Designed title
     */
    public function setWorksheetTitle ($title)
    {

        // strip out special chars first
        $title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);

        // now cut it to the allowed length
        $title = substr ($title, 0, 31);

        // set title
        $this->worksheet_title = $title;

    }

    /**
     * Generate the excel file
     * 
     * Finally generates the excel file and uses the header() function
     * to deliver it to the browser.
     * 
     * @access public
     * @param string $filename Name of excel file to generate (...xls)
     */
    function generateXML($filename)
    {

        // deliver header (as recommended in php manual)
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        //Enom sdsa Domain Record
        header("Content-Disposition: inline; filename=\"".date("Y-m-d") . $filename ."\"");

        // print out document to the browser
        // need to use stripslashes for the damn ">"
        echo stripslashes ($this->header);
		echo stripslashes($this->style);
		echo "\n<Worksheet ss:Name=\"" . $this->worksheet_title . "\">\n<Table ss:DefaultColumnWidth=\"90\" ss:DefaultRowHeight=\"17.25\">\n";
		
       // echo "\n<Worksheet ss:Name=\"" . $this->worksheet_title . "\">\n<Table>\n";
       // echo "<Column ss:Index=\"1\" ss:AutoFitWidth=\"0\" ss:Width=\"110\"/>\n";
	   
	   //域名
		echo '
		<Column ss:AutoFitWidth="0" ss:Width="100"/>
		<Column ss:AutoFitWidth="0" ss:Width="100"/>
		<Column ss:AutoFitWidth="0" ss:Width="100"/>
		';
		
        echo  "<Row ss:Height=\"30.5\"><Cell/><Cell/><Cell ss:StyleID=\"s21\"><Data ss:Type=\"String\">".$this->worksheet_title . "</Data></Cell></Row>\n";

		echo stripslashes($this->excelhead);
		
        echo implode ("\n", $this->lines);
        echo "</Table>\n</Worksheet>\n";
        echo $this->footer;
    }
    
    /*
     * Demo
     * $_testDownExcel = new Excel('statistic');
     * $_testDownExcel->worksheet_title("Statistic Report");
     * $_testDownExcel->addArray($array);
     * $_testDownExcel->generateXML("Statistic Report");
     */

}

