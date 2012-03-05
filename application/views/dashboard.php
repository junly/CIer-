      <div class="hero-unit">
        <h1><img style="height: 50px;" src="<?php echo base_url().'css/ci_logo_flame.jpg';?>" />Hello, CodeIgniter!</h1>
        <p>亲们,准备学习CI.</p>
        <p><a href="<?php echo site_url('/doc/home');?>" class="btn btn-primary btn-large" id="learn-more">Learn more &raquo;</a></p>
      </div>
      <div class="row rowmargin">
            <div class="span4">
              <h2>CodeIgniter入门</h2>
              <p>根据CodeIgniter 用户指南，结合实际代码进行分析</p>
              <p><?php echo anchor('/doc/start','View details »',array('class' => 'btn'))?></p>
            </div><!--/span-->
            <div class="span4">
              <h2>API设计</h2>
              <p>从项目中的实际应用出发</p>
              <p><?php echo anchor('/doc/api','View details »',array('class' => 'btn'))?></p>
            </div><!--/span-->
            <div class="span4">
              <h2>工具</h2>
              <p>实际编写一些PHP应用中涉及到的工具</p>
              <p><?php echo anchor('/doc/tool','View details »',array('class' => 'btn'))?></p>
            </div><!--/span-->
          </div>
                <div class="row-fluid">
            <div class="span4">
              <h2>PHP应用</h2>
              <p>结合Codeigniter框架，实际开发几种类型的CI程序</p>
              <p><?php echo anchor('/doc/app','View details »',array('class' => 'btn'))?></p>
            </div><!--/span-->
            <div class="span4">
              <h2>Linux</h2>
              <p>Linux学习与分享</p>
              <p><?php echo anchor('/doc/linux','View details »',array('class' => 'btn'))?></p>
            </div><!--/span-->
            <div class="span4">
              <h2>资源</h2>
              <p>Stay Hungry. Stay Foolish.</p>
              <p><?php echo anchor('/doc/resource','View details »',array('class' => 'btn'))?></p>
            </div><!--/span-->
          </div>
      
<script type="text/javascript">
$("#learn-more")
.click(function()
{
	/*测试下发送邮件*/
	CI.run.LEARN_MORE();
}
);
</script>
