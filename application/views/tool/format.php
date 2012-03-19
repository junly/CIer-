<?php echo $this->load->view('common/header');?>
   <p>调用示例，先用format数据模拟了，目前的页面比较混乱没整理了。</p>
<div class="row rowmargin">
        <div class="span4">
    
<form class="well form-horizontal">
    API测试工具
        <label><a class="tooltip-test" title="口令认证,md5('cier')">rest token</a></label>
        <input type="text" id="rest_token" name="rest_token" class="span3" placeholder="7043bd34363b3a7925e82bcd8dec20a3" value="7043bd34363b3a7925e82bcd8dec20a3">
        
        <label><a class="tooltip-test" title="请求数据源(php,linux,database)">rest path</a></label>
        <select class="span2" id="rest_path" name="rest_path" >
                <option value="total">total</option>
                <option value="php">php</option>
                <option value="linux">linux</option>
                <option value="database">database</option>
        </select>
      	
      	<label><a class="tooltip-test" title="数据返回格式(xml,json)">rest type</a></label>
        <select class="span2" id="rest_type" name="rest_type" >
                <option value="json">json</option>
                <option value="xml">xml</option>
        </select>    
        <div class="form-actions">
   			<button class="btn btn-primary" id="btn-run-format-api" type="button">提交测试</button>
         </div>
      </form>
        </div>
       <div class="span8">
             <form class="well">
             <label>提交参数：</label>
        	<textarea id="run-format-api-param"  class="input-xlarge span7" rows=5 placeholder=''></textarea>
			<label>返回结果：</label>
        	<textarea id="run-format-api-response"  class="input-xlarge span7" rows=8></textarea>
        	<label>SDK 调用示例代码：</label>
        	<pre id="run-format-api-code">$this->ga_service = new gapi(ga_email,ga_password); 
        	</pre> 
   		</form>
        </div>
</div>
<script type="text/javascript">
/*请求流程ajax处理*/
$("#btn-run-format-api")
.click(function()
{
	data = {
			rest_token  : $('#rest_token').val(),
			rest_path   : $('#rest_path').val(),
			rest_type   : $('#rest_type').val(),
			api			: true,
	}
	
	CI.run.API('<?php echo site_url('/zhao/rest/');?>',data);
}
);
</script>