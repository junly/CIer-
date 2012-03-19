<?php echo $this->load->view('common/header');?>
<p>Google分析数据Data Export API</p>

<p>具体样式具体分析，分别显示每种接口的调用，或者集成一个工具进行对应接口的测试</p>
<p>简单描述具体接口的功能</p>
<p>通过工具调用，实际代码要慢慢的敲，</p>

<p>
gmail的账号,密码
给大家几个指标
在给几个维度，只加载10个数据,亲别怕只是接口而已。
亲，勇敢的输入你的gmail账号和密码
</p>
<div class="row rowmargin">
        <div class="span12 navlabel">
            Google Analysis Account
        </div>
        <div class="labelMargin1">
        <?php echo anchor('/api/google/account',site_url('/api/google/account'));?>
        <span class="label label-success">OK</span>
        </div>      
</div>

<div class="row rowmargin">
        <div class="span12 navlabel">
            Google Analysis Report
        </div>
        <div class="labelMargin1">
        <?php echo anchor('/api/google/report',site_url('/api/google/report'));?>
        <span class="label label-success">OK</span>
        </div>      
</div>

<div class="row rowmargin">
        <div class="span12 navlabel">
            资源
        </div>
        <div class="labelMargin1">
        <a href="<?php echo base_url().'static/download/gapi.class.rar';?>" class="btn btn-success">PHP SDK</a>
        </div>      
</div>