<?php echo $this->load->view('common/header');?>
<div class="page-header">
    <h1>PHP应用<small>与其临渊羡鱼，不如退而结网。</small></h1>
</div>
<div class="row rowmargin">
<div class="span3 ">
<span class="label label-important">参</span>接口调用需要参数
</div>
<div class="span3 ">
<span class="label label-important">异</span>异步调用应用
</div>
</div>
<div class="row rowmargin">
<div class="span3 ">
<span class="label label-info">Dev</span>开发中
</div>
<div class="span3 ">
<span class="label label-info">Debug</span>调试
</div>
<div class="span3 ">
<span class="label label-info">UAT</span>验收测试
</div>
<div class="span3 ">
<span class="label label-info">PRO</span>生产环境
</div>
</div>
<div class="row rowmargin">
<div class="span3 ">
<span class="label label-success">应用</span>实际应用调用
</div>
<div class="span3 ">
<span class="label label-success">代码</span>功能块代码阅读
</div>
</div>
<div class="row rowmargin">
        <div class="span12 navlabel">
            <h4>小杨一期PHP应用入口</h4>
        </div>
        <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/email','Yang.Email')?>
                </div>
                <div class="span5">
                	CI Email库 + SMTP发送邮件
                    <span class="label label-important">参</span>
                    <span class="label label-important">异</span>
                    <span class="label label-info">PRO</span>
                    <span class="label label-success">应用</span>
                </div>
            </div>
        </div>
        <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/chart','Yang.Chart')?>
                </div>
                <div class="span5">
                	CodeIgniter + pieChart + FusionCharts
                    <span class="label label-important">参</span>
                    <span class="label label-important">异</span>
                    <span class="label label-info">PRO</span>
                    <span class="label label-success">应用</span>
                </div>
            </div>
        </div> 
         <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/page','Yang.AjaxPage')?>
                </div>
                <div class="span5">
                	CI_Model + CI 分页库
                    <span class="label label-important">参</span>
                    <span class="label label-important">异</span>
                    <span class="label label-info">PRO</span>
                    <span class="label label-success">应用</span>
                </div>
            </div>
        </div>
         <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/format','Yang.Format')?>
                </div>
                <div class="span5">
                	CI Format类库
                    <span class="label label-important">参</span>
                    <span class="label label-important">异</span>
                    <span class="label label-info">UAT</span>
                    <span class="label label-success">应用</span>
                </div>
            </div>
        </div>        
    </div>
<div class="row rowmargin">
        <div class="span12 navlabel">
            <h4>小赵一期PHP应用入口</h4>
        </div>
        <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/template','Zhao.Template')?>
                </div>
                <div class="span5">
                	CI SESSION库 + Template
                    <span class="label label-info">Dev</span>
                    <span class="label label-success">代码</span>
                </div>
            </div>
        </div>
        <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/pattern','Zhao.Pattern')?>
                </div>
                <div class="span5">
                	CodeIgniter框架 + 设计模式范例
                    <span class="label label-info">Dev</span>
                    <span class="label label-success">代码</span>
                </div>
            </div>
        </div>
       <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/model','Zhao.Model')?>
                </div>
                <div class="span5">
                	CI Model改造 实现ORM功能
                    <span class="label label-info">Dev</span>
                    <span class="label label-success">代码</span>
                </div>
            </div>
        </div>
       <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/route','Zhao.Route')?>
                </div>
                <div class="span5">
                	CI Hook机制改造  实现CI路由语义化
                    <span class="label label-info">Dev</span>
                    <span class="label label-success">代码</span>
                </div>
            </div>
        </div>        
    </div>    
<div class="alert alert-info">
        <strong>亲!</strong>更多结合 CI特性的PHP应用程序会持续更新 ，欢迎提供您的程序构想：<?php echo safe_mailto('b.zhao1@gmail.com','亲，这样的CI程序你有没有');?>
</div>
