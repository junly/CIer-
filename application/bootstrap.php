<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Hook引导 
 */
class bootstrap 
{
        public function __construct()
        {
        	       
        }
        
        
        /**
         * 设置路由 
         */
        public function route()
        {
            /*添加路由*/
            $RTX = & load_class('Router', 'core');
            /*Route设置*/
            $RTX->set('zhao','doc/bzhao');
            $RTX->set('google','docs/api/google_analytics');
            $RTX->set('set/(:any)',"doc/$1");
        }
}
/* End of file bootstrap.php */
/* Location: ./application/bootstrap.php */ 