<?php echo $this->load->view('common/header');?>
<p>Yang.Chart</p>
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
Yang.Chart简述: 使用pieChart 和 FusionCharts 生成图表
</p>
<hr/>
<a href="https://raw.github.com/ftwbzhao/CIer-/master/application/controllers/yang.php" target="_blank" class="btn">ViewSource</a>
</div>
<div class="row rowmargin">
        <div class="span12 navlabel">
            Yang.Chart
            <span class="label label-important">参</span>
        </div>
        <div class="labelMargin1">
                     图表应用
        </div>
</div>

    
<div class="row rowmargin">
        <div class="span12 navlabel">
            URL
        </div>
        <div class="labelMargin1">
        <?php echo anchor('/yang/ajaxChart',site_url('/yang/ajaxChart'));?>
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
                    <td>option</td>
                    <td>
                        <span>TRUE</span>
                    </td>
                    <td>
                        <span>
                            ENUM
                        </span>
                    </td>
                    <td>图表类型1.pchart图表,2.FusionCharts图表3.趋势图</td>
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
                    <td>图表请求开关</td>
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
                    <td><a rel="popover" data-content='{"retCode":"S","retMsg":"图表已加载完成"}' class="btn" data-original-title="JSON Result">JSON</a></td>
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
                        <pre class="prettyprint linenums">{"retCode":"F","retMsg":"提交的参数不正确"}</pre>
                    </td>
                </tr>                
            </tbody></table>
        </div>
</div>

    
          <!-- PHPDemo S -->
          <div id="emailModel" class="modal hide fade">
            <div class="modal-header">
              <a class="close" data-dismiss="modal" >&times;</a>
              <h3>图表应用</h3>
            </div>
            <div class="modal-body well">
            <!-- 图表  option-->
			<div class="form-horizontal">
          	<div class="control-group">
            <label class="control-label">图表类型(Img,Flash)</label>
            <div class="controls docs-input-sizes">
			<select id="select-chart-option" class="span2">
				<option value="">图表类型</option>
                <option value="Img">Img</option>
                <option value="Flash">Flash</option>
                <option value="Trend">Trend</option>
              </select>
            </div>
          </div>
      		</div>
      		<!-- 图表  option-->
			<div id="select-chart-rst" class="well">
			</div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="btn-run-chart">加载图表</button>
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
$("#btn-run-chart")
.click(function()
{
	data = {
		flag : true,
		option   : $('#select-chart-option').val()
	}
	
	CI.run.CHART('<?php echo site_url('/yang/ajaxChart/');?>',data);
}
);
</script>