<?php echo $this->load->view('common/header');?>
<div class="page-header">
    <h1>Tool<small>工欲善其事必先利其器</small></h1>
</div>
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
好的工具很神奇,将会给你介绍几种类型的工具<br/>
<a rel="popover" data-content="Git,SVN创建和基本的使用方法" class="btn" data-original-title="代码部署">代码部署</a>
<?php echo nbs(10);?>
<a rel="popover" data-content="REST API调试工具" class="btn" data-original-title="API测试">API&JSON</a>
<?php echo nbs(10);?>
<a rel="popover" data-content="随缘吧。" class="btn" data-original-title="IDE">IDE</a>
<?php echo nbs(10);?>
<a rel="popover" data-content="数据格式转换" class="btn" data-original-title="数据转换">FORMAT</a>
<?php echo nbs(10);?>
</p>
</div>

          <!-- PHPDemo S -->
          <div id="emailModel" class="modal hide fade">
            <div class="modal-header">
              <a class="close" data-dismiss="modal" >&times;</a>
              <h3>Make API Calls</h3>
            </div>
            <div class="modal-body well">
        	<label>请求路径：</label>
        	<input type="text" id="run-json-path" placeholder="/yang/ajaxMail" data-provide="typeahead" data-items="4" data-source='<?php echo $ajax_method;?>'><span class="help-inline">输入’y'，有场景，请求路径</span>
      		<label>请求参数：</label>
        	<textarea id="run-json-param"  class="input-xlarge span5" rows=4 placeholder='{"send_to":"best_mrzhao@163.com", "send_mail":"true"}'>{"send_to":"best_mrzhao@163.com", "send_mail":"true"}</textarea><span class="help-inline">请求参数</span>
			<label>返回数据：</label>
        	<textarea id="run-json-response"  class="input-xlarge span5" rows=6 ></textarea><span class="help-inline">返回数据</span>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btn-run-json">Run Request</button>
              <button class="btn" data-dismiss="modal" >Close</button>
            </div>
          </div>
           <!-- PHPDemo E -->   
           
          <!-- PHPDemo S -->
          <div id="formatModel" class="modal hide fade">
            <div class="modal-header">
              <a class="close" data-dismiss="modal" >&times;</a>
              <h3>格式转换工具</h3>
            </div>
            <div class="modal-body well">
        	<label>请求路径：</label>
        	<input type="text" id="run-json-path" placeholder="/yang/ajaxMail"><span class="help-inline">请求路径</span>
      		<label>请求参数：</label>
        	<textarea id="run-json-param"  class="input-xlarge span5" rows=4 placeholder='{"send_to":"best_mrzhao@163.com", "send_mail":"true"}'></textarea><span class="help-inline">请求参数</span>
			<label>返回数据：</label>
        	<textarea id="run-json-response"  class="input-xlarge span5" rows=6 ></textarea><span class="help-inline">返回数据</span>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btn-run-json">Run Request</button>
              <button class="btn" data-dismiss="modal" >Close</button>
            </div>
          </div>
           <!-- PHPDemo E -->    

<div class="alert alert-success">
        <strong>工具示例!</strong> 目前已经完成API测试工具。格式转化工具正在开发中，代码阅读时，请打开XHR辅助
</div>                       
<div class="row labelMargin1">
        <a data-toggle="modal" href="#emailModel" class="btn btn-primary btn-success">Launch JSON Tool</a>
        <a " href="<?php echo site_url('docs/tool/format');?>" class="btn btn-primary btn-success">Launch FORMAT Tool</a>
    </div>
<script type="text/javascript">
/*JSON这样处理*/
$("#btn-run-json")
.click(function()
{
	data = {
		path 	: $('#run-json-path').val(),
		param   : $('#run-json-param').val()
	}

    $.ajax({
        "url": '<?php echo site_url('/docs/tool/json/');?>', 
        "type": "POST", 
        "data": data, 
        "success": function (data) {
            $('#run-json-response').val(data);
        }
    });	
	
}
);
</script>    