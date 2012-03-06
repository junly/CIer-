<?php echo $this->load->view('common/header');?>
		   	<div class="alert alert alert-error">
        	<strong>提醒：</strong>本目录下大量文案摘自<?php echo anchor('http://codeigniter.org.cn/user_guide',' CodeIgniter 用户指南');?>，章节扩展部分文案出自本人观点。
			</div>
        <div class="progress">
  <div class="bar"
       style="width: 10%;">正在整理..</div>
</div>   			
<div class="row-fluid">
        <div class="span3">
          <div class=" sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">常规主题</li>
              <li <?php if($chapter=='chapter01'):?>class="active"<?php endif;?>><?php echo anchor('/docs/start/basic/chapter01','CodeIgniter URL')?></li>
              <li <?php if($chapter=='chapter02'):?>class="active"<?php endif;?>><?php echo anchor('/docs/start/basic/chapter02','控制器')?></li>
              <li <?php if($chapter=='chapter03'):?>class="active"<?php endif;?>><?php echo anchor('/docs/start/basic/chapter03','视图')?></li>
              <li <?php if($chapter=='chapter04'):?>class="active"<?php endif;?>><?php echo anchor('/docs/start/basic/chapter04','模型')?></li>
            </ul>
          </div>
        </div><!--/span-->
        
        <div class="span9">
          <div class="row-fluid">
          <?php echo $this->load->view('start/basic/'.$chapter);?>
          </div><!--/row-->
        </div><!--/span-->
      </div>