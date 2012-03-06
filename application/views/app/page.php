<?php echo $this->load->view('common/header');?>
<p>Yang.AjaxPage</p>
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
Yang.AjaxPage简述: 通过CI_Model + CI 分页库实现实时的分页请求，API调用中需要提供页码，由于局限于CI的分页类，所以Demo效果略有不足
</p>
<hr/>
<a href="https://raw.github.com/ftwbzhao/CIer-/master/application/controllers/yang.php" target="_blank" class="btn">ViewSource</a>

</div>
<div class="row rowmargin">
        <div class="span12 navlabel">
            Yang.AjaxPage
            <span class="label label-important">参</span>
        </div>
        <div class="labelMargin1">
        Ajax分页
        </div>
</div>

    
<div class="row rowmargin">
        <div class="span12 navlabel">
            URL
        </div>
        <div class="labelMargin1">
        <?php echo anchor('/yang/ajaxMail',site_url('/yang/ajaxPage'));?>
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
                    <td>page</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            int
                        </span>
                    </td>
                    <td>当前页码</td>
                </tr>
                <tr>
                    <td>limit</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            int
                        </span>
                    </td>
                    <td>每页显示项目数量</td>
                </tr>                
                <tr>
                    <td>flag</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            BOOL
                        </span>
                    </td>
                    <td>分页请求开关</td>
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
                    <td><a rel="popover" data-content='{"retCode":"S","retMsg":"分页已加载完成"}' class="btn" data-original-title="JSON Result">JSON</a></td>
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
                        <pre class="prettyprint linenums">{"retCode":"F","retMsg":"数据源加载失败"}</pre>
                    </td>
                </tr>                
            </tbody></table>
        </div>
</div>

    
          <!-- PHPDemo S -->
          <div id="emailModel" class="modal hide fade">
            <div class="modal-header">
              <a class="close" data-dismiss="modal" >&times;</a>
              <h3>分页应用</h3>
            </div>
            <div class="modal-body">
			<form class="form-inline">
CurPage：<?php echo form_dropdown('page',range(0,16),1,"id ='page' class='span1'");?>
         <?php echo nbs(4);?>
PerPage：<?php echo form_dropdown('limit',range(0,16),1,"id ='limit' class='span1'");?>
         <?php echo nbs(4);?>
        <button type="button" class="btn btn-primary" id="btn-run-page">加载分页</button>
      </form>            
			<div id="div-table-rst">

			</div>
            <div class="modal-footer">           
              <button class="btn" data-dismiss="modal" >Close</button>
            </div>
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
$(function()
{
	data = {
			flag : true,
			page : $('#page').val(),
			limit : $('#limit').val()
		}
		
	CI.run.PAGE('<?php echo site_url('/yang/ajaxPage/');?>',data);
});


/*Button触发流程*/
$("#btn-run-page")
.click(function()
{
	data = {
		flag : true,
		page : $('#page').val(),
		limit : $('#limit').val()
	}
	
	CI.run.PAGE('<?php echo site_url('/yang/ajaxPage/');?>',data);
}
);


/*多余的设计*/
$("#page")
.change(function()
{
	data = {
			flag : true,
			page : $('#page').val(),
			limit : $('#limit').val()
		}
		
		CI.run.PAGE('<?php echo site_url('/yang/ajaxPage/');?>',data);
}
);

$("#limit")
.change(function()
{
	data = {
			flag : true,
			page : $('#page').val(),
			limit : $('#limit').val()
		}
		
		CI.run.PAGE('<?php echo site_url('/yang/ajaxPage/');?>',data);
}
);

</script>