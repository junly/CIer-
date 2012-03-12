<?php echo $this->load->view('common/header');?>
<p>Yang.Email</p>
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
Yang.Email简述: 通过CI Email库和SMTP发送邮件,API调用中需要提供收件人的email地址 & 发送状态
</p>
<hr/>
<a href="https://raw.github.com/ftwbzhao/CIer-/master/application/controllers/yang.php" target="_blank" class="btn">ViewSource</a>

</div>
<div class="row rowmargin">
        <div class="span12 navlabel">
            Yang.Email
            <span class="label label-important">参</span>
        </div>
        <div class="labelMargin1">
                     发送邮件
        </div>
</div>

    
<div class="row rowmargin">
        <div class="span12 navlabel">
            URL
        </div>
        <div class="labelMargin1">
        <?php echo anchor('/yang/ajaxMail',site_url('/yang/ajaxMail'));?>
        <span class="label label-success">OK</span>
        </div>      
</div>

<div class="row rowmargin">
        <div class="span12 navlabel">
          	支持格式
        </div>
        <div class="labelMargin1">
		JSON
        </div>      
</div>
      
<div class="row rowmargin">
        <div class="span12 navlabel">
          	HTTP请求方式
        </div>
        <div class="labelMargin1">
		POST
        </div>      
</div>

<div class="row rowmargin">
        <div class="span12 navlabel">
         	接口认证
        </div>
        <div class="labelMargin1">
		不需认证
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
                    <td>send_mail</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            Bool
                        </span>
                    </td>
                    <td>邮件发送开关</td>
                </tr>
                <tr>
                    <td>send_to</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            String
                        </span>
                    </td>
                    <td>收件人邮箱</td>
                </tr> 
                <tr>
                    <td>mail_subject</td>
                    <td>
                        <span>FALSE</span>
                    </td>
                    <td>
                        <span>
                            String(20)
                        </span>
                    </td>
                    <td>邮件主题(选填)</td>
                </tr>  
                <tr>
                    <td>mail_content</td>
                    <td>
                        <span>FALSE</span>
                    </td>
                    <td>
                        <span>
                            String(200)
                        </span>
                    </td>
                    <td>邮件内容(选填)</td>
                </tr>                 
            </tbody></table>
        </div>
</div>


<div class="row rowmargin">
        <div class="span12 navlabel">
          	返回结果
        </div>
		<div class="labelMargin1">
		    <a rel="popover" data-content="class ReturnMegType<br/>{</br>public $retCode;<br/>public $retMsg;<br/>} " class="btn" data-original-title="返回类型">ReturnMegType</a>
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
                        <span>ReturnMegType</span>
                    </td>
                    <td>
                        <span>
                        </span>
                    </td>
                    <td><a rel="popover" data-content='{"retCode":"S","retMsg":"Send Mail Success"}' class="btn" data-original-title="JSON Result">JSON</a></td>
                </tr>
                <tr>
                    <td>失败</td>
                    <td>
                        <span>ReturnMegType</span>
                    </td>
                    <td>
                        <span>
                            	错误响应
                        </span>
                    </td>
                    <td>json:
                        <pre class="prettyprint linenums">{"retCode":"F","retMsg":"Invalid Form Data"}</pre>
                    </td>
                </tr>                
            </tbody></table>
        </div>
</div>

    
          <!-- PHPDemo S -->
          <div id="emailModel" class="modal hide fade">
            <div class="modal-header">
              <a class="close" data-dismiss="modal" >&times;</a>
              <h3>亲，发邮件吧</h3>
            </div>
            <div class="modal-body well input-prepend">
        	<label>收件人</label>
        	<span class="add-on"><i class="icon-envelope"></i></span><input type="text" id="send-email-addr" placeholder="收件人地址" data-provide="typeahead" data-items="4" data-source='<?php echo $ajax_mail;?>'><span class="help-inline">输入'b',有神奇的效果，后台会验证你的!</span>
       		<label>邮件主题(选填, &le;20)</label>
        	<input type="text" id="send-email-subject" placeholder="学习贴" data-provide="typeahead" data-items="4" data-source='<?php echo $ajax_subject;?>'><span class="help-inline">输入'亲',有奇迹的时刻，后台会过滤你的!</span>
   			<label>邮件内容(选填，&le;200)</label>
        	<textarea id="send-email-content"  class="input-xlarge span5" rows=4 placeholder="亲，邮件内容自定义"></textarea><span class="help-inline">后台会过滤你的!</span>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btn-send-email">Push Email</button>
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
$("#btn-send-email")
.click(function()
{
	data = {
		send_mail : true,
		send_to   : $('#send-email-addr').val(),
		mail_content : $('#send-email-content').val(),
		mail_subject : $('#send-email-subject').val()
	}
	
	CI.run.EMAIL('<?php echo site_url('/yang/ajaxMail/');?>',data);
}
);
</script>