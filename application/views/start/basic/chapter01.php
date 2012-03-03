   	 		<h4>CodeIgniter URL</h4>
   	 		<hr/>
		   <p>默认情况下，CodeIgniter 中的 URL 被设计成对搜索引擎和人类友好。不同于使用标准“查询字符串”方法的是，CodeIgniter 使用<strong>基于段</strong>的方法：</p>
		   <pre>example.com/news/article/my_article</pre>
		   <div class="alert alert-error">
        	<strong>注意：</strong>查询字符串形式的 URL 是可选的，分述如下。
			</div>
			
			<h4>URI 段</h4>
			<hr/>
			<p>根据模型-视图-控制器模式，在此 URL 段一般以如下形式表示：</p>
			<pre>example.com/class/function/ID</pre>
			<ol>
    <li>第一段表示调用控制器<strong>类</strong>。</li>
    <li>第二段表示调用类中的<strong>函数</strong>或方法。</li>
    <li>第三及更多的段表示的是传递给控制器的参数，如 ID 或其它各种变量。</li>
</ol>
<p><?php echo anchor('/docs/start/library/chapter07','URI 类');?>和<?php echo anchor('/docs/start/helper/chapter07','URL 辅助函数');?>中的函数可以使你的 URI 更简单的工作。另外，使用 <?php echo anchor('/docs/start/basic/chapter07','URI 路由');?>特性可以将你的 URL 重定向，以获得更大的灵活性。</p>