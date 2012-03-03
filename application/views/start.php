<?php echo $this->load->view('common/header');?>
<div class="page-header">
    <h1>Get Start <small>More Code , More Achievement</small></h1>
</div>

<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
多写，多练，仅此而已,千里之行，始于足下
</p>
</div>

<h3>本站约定</h3>
<p>代码块</p>
<pre class="prettyprint">
$this->chart_data = $this->_geneData();
$this->_geneImg();
print_r($this->chart_response);
</pre>
<p>提示</p>
<div class="alert alert-warnning">
        <a class="close" data-dismiss="alert">×</a>
        <strong>提示!</strong> 章节中的重要提示
      </div>
<div class="alert alert-error">
        <a class="close" data-dismiss="alert">×</a>
        <strong>注意!</strong> 章节中的注意点
      </div>
<div class="alert alert-info">
        <a class="close" data-dismiss="alert">×</a>
        <strong>拓展!</strong> 对当前章节的拓展.
</div>      
<div class="page-header">
<p>CodeIgniter入门的教程将会根据手册内容+实际代码进行操练</p>
</div>
    <div class="row rowmargin">
        <div class="span3">
        	<?php echo anchor('/docs/start/basic','常规主题',array('class' => 'btn btn-info'));?>
        </div>
        <div class="span3">
        	<?php echo anchor('/docs/start/library','类库参考',array('class' => 'btn btn-info'));?>
        </div>
        <div class="span3">
        	<?php echo anchor('/docs/start/database','数据库',array('class' => 'btn btn-info'));?>
        </div>
        <div class="span3">
        	<?php echo anchor('/docs/start/helper','辅助函数参考',array('class' => 'btn btn-info'));?>
        </div>        
   </div>
