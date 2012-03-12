<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 调用统一Template 
 */
class MY_Controller extends CI_Controller
{
	protected $template;
	
	public function __construct()
    {
        parent::__construct();
        
        /*Catch URL*/
        $this->template['url'] = $this->router->fetch_method();
        $this->template['class'] = $this->router->fetch_class();
        
		/*3小时*/
//		$this->output->cache(180);    
		/*取消Cache机制，感受自己的代码*/
    }
}


/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php*/