   	 		<h4>什么是CLI？</h4>
   	 		<hr/>
		   	<p>命令行接口是一种基于文本的和计算机交互的方式。</p>
		   	<br/>
			
			<h4>为什么使用命令行？</h4>
			<hr/>
			<p>如果你需要自动的去请求一些脚本，例如结合Shell进行处理PHP请求，你会发现命令行模式的魅力</p>
<br/>
			<h4>使用Demo</h4>
			<hr/>		
<p>创建一个简单的控制器 <code>tools.php</code>，代码如下：</p>
<pre>
class Tools extends CI_Controller {

  public function message($to = 'World')
  {
    echo "Hello {$to}!".PHP_EOL;
  }
}
</pre>
<p>你访问当前URL的时候需要输入：</p>
<pre>
example.com/index.php/tools/message/to
</pre>
<p>如果你用CLI方式运行值只需要输入：</p>
<pre>
$ php index.php tools message "John Smith"
</pre>


	   	<div class="alert alert-info">
        	<strong>扩展：</strong>个人对CLI的理解和使用案例
			</div>
<pre>
/*直接代码了，省的敲样式*/
/*首先 CI中提供方法判断当前请求是否CLI*/

if ($this->input->is_cli_request()) { echo "CLI请求";}

/*项目中对CLI的实际Crontab使用*/
#PHP请求，没有使用CI的CLI
0 0 * * * /usr/bin/php /var/www/html/www.host-inc.com/api/request.php 2>&1 > /dev/null
#web请求
30 0 * * * /usr/bin/curl http://www.host-inc.com/api/request.php 2>&1 > /dev/null
    
/*现在对该接口进行优化*/
/**
* 自动RequestAPI请求
* 采取方法比较保守,通过API调用CURL请求
* Shell CLI方式
* $php /var/www/html/www.host-inc.com/index.php api runRequestGetDomains
* $php /var/www/html/www.host-inc.com/index.php api runRequestGetHosts
*/
public function autoRequest()
{
   /*判断是否是CLI 请求*/   
    $this->input->is_cli_request() OR die(set_status_header(403,'只支持命令行'));
    	
    $nvpStr =  urlencode('s').'='.urlencode(1);
    	
    $API_GET_DOMAIN_URL ="http://www.host-inc.com/api/runRequestGetDomains/";
    get_web_page($API_GET_DOMAIN_URL,$nvpStr);
        
    $API_GET_HOST_URL ="http://www.host-inc.com/api/runRequestGetHosts/";
    get_web_page($API_GET_HOST_URL,$nvpStr);
}
/*优化过的Crontab如下*/
#用单一CLI请求
10 0 * * * /usr/bin/php /var/www/html/www.host-inc.com/index.php api autoRequest 2>&1 > /dev/null
#直接用CLI跑两个更新请求
20 0 * * * /usr/bin/php /var/www/html/www.host-inc.com/index.php api runRequestGetDomains
30 0 * * * /usr/bin/php /var/www/html/www.host-inc.com/index.php api runRequestGetHosts
</pre>