   	 		<h4>什么是控制器？</h4>
   	 		<hr/>
		   	<p>简而言之，一个控制器就是一个类文件，是以一种能够和 URI 关联在一起的方式来命名的。</p>
   			<pre>example.com/index.php/blog/</pre>			
			<p>在上面的例子中，CodeIgniter 将尝试寻找并装载一个名为 <code>blog.php</code> 的控制器。</p>		   
			<p><strong>当控制器的名字匹配 URI 的第一段时，它将被装载。</strong></p>
		   	<div class="alert alert-warrning">
        	<strong>友情提醒：</strong>CI的控制器只能匹配到二级目录
			</div>
			
			<h4>如何将控制器放入子文件夹中</h4>
			<hr/>
			<p>如果你在建立一个大型的应用程序，你会发现 CodeIgniter 可以很方便的将控制器放到一些子文件夹中。</p>
			<p>只要在 <code>application/controllers</code> 目录下创建文件夹并放入你的控制器就可以了。</p>			

			<h4>构造函数</h4>
			<hr/>		
<p>如果要在你的任意控制器中使用构造函数的话，那么<strong>必须</strong>在里面加入下面这行代码：</p>
<pre>parent::__construct();</pre>	
<p>这行代码的必要性在于，你此处的构造函数会覆盖掉这个父控制器类中的构造函数，所以我们要手动调用它。</p>
<pre>
class Blog extends CI_Controller 
{
       public function __construct()
       {
            parent::__construct();
       }
}</pre>


	   	<div class="alert alert-info">
        	<strong>扩展：</strong>对构造函数的一点改造
			</div>
<pre>
/**
 * 判断当前目录是否有效，实际应用于当前的 URL ，chrome浏览器直接按F6后，在分析代码
 */
public function __construct()
{
	parent::__construct();
	/*Catch URL 读取当前 URL的信息*/
    	$this->template['url'] = $this->router->fetch_method();
    	$this->template['class'] = $this->router->fetch_class();		
	/*hack 可以屏蔽到未加载的章节*/
	if ( ! in_array($this->router->fetch_method(),$this->available_manual))
	{
		Message::set('亲..'.$this->router->fetch_method().'章节正在撰写','info');
		redirect('/doc/start');
	}
	/*消息提示*/
	Message::set('亲..，CI学习，就此拉开帷幕','info');
}
</pre>