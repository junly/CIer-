<?php echo $this->load->view('common/header');?>
<div class="page-header">
    <h1>PHP应用</h1>
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
                    <span class="label label-important">参</span>
                </div>
            </div>
        </div>
    </div>    
<div class="alert alert-info">
        <strong>亲!</strong>更多结合 CI特性的PHP应用程序会持续更新 ，欢迎提供您的程序构想：<?php echo safe_mailto('b.zhao1@gmail.com','亲，这样的CI程序你有没有');?>
</div>
