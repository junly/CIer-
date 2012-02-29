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
    }
}


/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php*/