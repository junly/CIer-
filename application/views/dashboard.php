      <div class="hero-unit">
        <h1>Hello, CodeIgniter!</h1>
        <p>亲们,准备学习CI.</p>
        <p><a href="<?php echo site_url('/doc/home');?>" class="btn btn-primary btn-large" id="learn-more">Learn more &raquo;</a></p>
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
