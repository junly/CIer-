<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test_model extends DAO
{
    protected $table_name = 'captcha';
    protected $primary_key = 'captcha_id';
    
    /**
     * 加载数据
     * @param array $query_struct 查询体
     * @param array $select select字段
     * @param string $key 返回主键
     */
	public function getDataTree($query_struct = array(),$select = array(),$key = NULL)
	{
		return $this->db_find_all(
				$select,
				$query_struct,
				$key);
	}    
	
	public function getDataCount($query_struct = array())
	{
		return $this->count($query_struct);
	}
	
	public function getOptionIp($currentIp , $filed = 'ip_address')
	{
		return $this->count_by_fval($filed, $currentIp);
	}
	
	public function dropItem($query_struct = array())
	{
		return $this->delete($query_struct);
	}
}

/* End of file test_model.php */
/* Location: ./application/model/test_model.php*/