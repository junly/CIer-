<?php echo $this->load->view('common/header');?>
<div class="page-header">
    <h1>关于本站<small>千里之行，始于足下</small></h1>
</div>
<p>简介</p>
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
本站已帮助程序员为初衷，分享学习CI框架的点滴，内容持续，更新依旧,<br/>
感谢杨同学,他的好学精神就是本站成立之因
</p>
</div>
<p>给我来信</p>
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
欢迎批评指导，您可以发邮件给我。<?php echo safe_mailto('b.zhao1@gmail.com','亲,问题');?>
</p>
</div>
<p><img src="/css/billzhao.jpg"></p>

最后补充一点，如果你喜欢本站，请推荐给你CIer的好友，谢谢！

<hr/>
<p>如果您在本站略有收获，如果您的CI略有提高，如果您忽获灵感，如果您渴望开源
<p>代码分享，点滴笃行。</p>
 <a href='http://me.alipay.com/cier'> <img src='<?php echo base_url().'/css/donate.png';?>' /> </a>
<hr/>
<div class="alert alert-info">
            <strong>感谢下面的亲们!</strong>
            时间短暂而仓促，没有风骚骚的感谢了，附打油诗一首.<br/>
           <?php echo nbs(10);?> CI孩子聚一堂，<br/>
           <?php echo nbs(10);?> 自学能力都挺强。<br/>
           <?php echo nbs(10);?> 算法神马最抽象，<br/>
           <?php echo nbs(10);?> 敏捷开发就这样。<br/>
          </div>
          <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th >亲(姓+*)</th>
                    <th >款Date</th>
                    <th >款Money</th>
                </tr>
                </thead>
                <tbody>
                 <?php echo cier_donate('杜爷','0.01','2012.03.10 12:46:55');?>
            	</tbody>
           </table>          
