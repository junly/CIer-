<?php echo $this->load->view('common/header');?>
<h2>PHP应用</h2>

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
                	CI_Model + FusionCharts
                    <span class="label label-important">参</span>
                </div>
            </div>
        </div> 
         <div class="span12">
            <div class="row">
                <div class="span5 labelMargin1">
                	<?php echo anchor('/docs/app/ajax','Yang.AjaxPage')?>
                </div>
                <div class="span5">
                	CI_Model + CI分页库
                    <span class="label label-important">参</span>
                </div>
            </div>
        </div>
    </div>

