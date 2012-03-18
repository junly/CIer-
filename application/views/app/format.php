<?php echo $this->load->view('common/header');?>
<p>Yang.Format</p>
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
Yang.Format简述: 通过CI Format类库，处理数据转换，应用中结合简易的REST API， 通过URL请求返回不同的数据类型给客户端
</p>
</div>
<div class="row rowmargin">
        <div class="span12 navlabel">
            Yang.Format
            <span class="label label-important">参</span>
        </div>
        <div class="labelMargin1">
                     数据转换
        </div>
</div>

    
<div class="row rowmargin">
        <div class="span12 navlabel">
            URL
        </div>
        <div class="labelMargin1">
        <?php echo anchor('/zhao/rest',site_url('/zhao/rest'));?>
        <span class="label label-success">OK</span>
        </div>      
</div>

<div class="row rowmargin">
        <div class="span12 navlabel">
          	支持格式
        </div>
        <div class="labelMargin1">
		JSON，XML
        </div>      
</div>
      
<div class="row rowmargin">
        <div class="span12 navlabel">
          	HTTP请求方式
        </div>
        <div class="labelMargin1">
		POST，GET
        </div>      
</div>

<div class="row rowmargin">
        <div class="span12 navlabel">
         	接口认证
        </div>
        <div class="labelMargin1">
		需认证,token为cier的md5值
        </div>      
</div>

<div class="row rowmargin">
        <div class="span12 navlabel">
          	接口参数
        </div>
		<div class="labelMargin1">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th style="width: 20%">参数</th>
                    <th style="width: 10%">必填</th>
                    <th style="width: 20%">类型</th>
                    <th>描述</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>rest_token</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            string
                        </span>
                    </td>
                    <td>口令认证,md5('cier')<span class="label label-success">PASS</span></td>
                </tr>                
                <tr>
                    <td>rest_path</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            string
                        </span>
                    </td>
                    <td>请求数据源(php,linux,database)</td>
                </tr>
                <tr>
                    <td>rest_type</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            String
                        </span>
                    </td>
                    <td>数据返回格式(xml,json)</td>
                </tr>                
            </tbody></table>
        </div>
</div>


<div class="row rowmargin">
        <div class="span12 navlabel">
          	返回结果
        </div>
		<div class="labelMargin1">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th style="width: 5%">结果</th>
                    <th style="width: 10%">类型</th>
                    <th style="width: 30%">描述</th>
                    <th>实例</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>成功</td>
                    <td>
                        <span></span>
                    </td>
                    <td>
                        <span>
                        </span>
                    </td>
                    <td>
                    <a rel="popover" data-content='{"php":{"CodeIgnite":1,"Kohana":1}}' class="btn" data-original-title="JSON Result">JSON</a>
                    </td>
                </tr>
                <tr>
                    <td>失败</td>
                    <td>
                        <span>restError</span>
                    </td>
                    <td>
                        <span>
    '100'   =>	'请求参数无效',<br/>
	'101'	=>	'Token认证失败',<br/>
	'102'	=>	'请求类型不存在',<br/>
	'103'	=>	'请求数据源不存在',<br/>
                        </span>
                    </td>
                    <td>json:
                        <pre class="prettyprint linenums">{
error: "Usage: http://cier.phpfogapp.com/index.php/zhao/rest?type=XX&path=XX"
}</pre>
                    </td>
                </tr>                
            </tbody></table>
        </div>
</div>

    
          <!-- PHPDemo S -->
          <div id="emailModel" class="modal hide fade">
            <div class="modal-header">
              <a class="close" data-dismiss="modal" >&times;</a>
              <h3>数据转换REST</h3>
            </div>
            <div class="modal-body well">
       		<label>请求参数：</label>
        	<textarea id="run-format-param"  class="input-xlarge span5" rows=4 placeholder='{"rest_token":"7043bd34363b3a7925e82bcd8dec20a3", "rest_path":"linux","rest_type":"json"}'>{"rest_token":"7043bd34363b3a7925e82bcd8dec20a3","rest_path":"linux","rest_type":"json"}</textarea><span class="help-inline">请求参数</span>
			<label>返回数据：</label>
        	<textarea id="run-format-response"  class="input-xlarge span5" rows=6 ></textarea><span class="help-inline">返回数据</span>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btn-send-request">Request</button>
              <button class="btn" data-dismiss="modal" >Close</button>
            </div>
          </div>
           <!-- PHPDemo E -->        
<div class="row rowmargin">
        <div class="span12 navlabel">
          	调用示例
        </div>
        <div class="labelMargin1">
        <a data-toggle="modal" href="#emailModel" class="btn btn-primary btn-success">Launch PHP Demo</a>
        </div>
    </div>

<script type="text/javascript">
/*请求流程ajax处理*/
$("#btn-send-request")
.click(function()
{
	data = {
			param   : $('#run-format-param').val()
	}
	
	CI.run.FORMAT('<?php echo site_url('/zhao/rest/');?>',data);
}
);
</script>