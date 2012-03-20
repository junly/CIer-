<?php echo $this->load->view('common/header');?>
<div class="page-header">
    <h1>HOmE <small>感受Ci从此时开始...Coding</small></h1>
</div>   
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
亲爱的小杨同学，本人表达不好，大概从几个方面帮你提高
<br/>
<a rel="popover" data-content="根据CI中国的CI手册按照章节进行代码演示" class="btn" data-original-title="CI框架">CI框架</a>
<?php echo nbs(10);?>
<a rel="popover" data-content="REST模式客户端和服务器端的设计,案例中将实际开发一套测试API Demo" class="btn" data-original-title="API设计">API设计</a>
<?php echo nbs(10);?>
<a rel="popover" data-content="提供一套根据REST模式,效仿Wepay的Call API处理" class="btn" data-original-title="开发工具">开发工具</a>
<?php echo nbs(10);?>
<a rel="popover" data-content="实际的PHP代码学习" class="btn" data-original-title="PHP应用">PHP应用</a>
<?php echo nbs(10);?>
<a rel="popover" data-content="系统工程，慢慢来吧" class="btn" data-original-title="Linux深渊">Linux深渊</a>
<hr/>
其间遇到任何问题直接发我邮箱 <?php echo safe_mailto('b.zhao1@gmail.com','亲，问题');?>
</p>
</div>
    
    <div class="row rowmargin">
        <div class="span4">
            <input type='button' class='btn-danger' value='开发应用&raquo;'/>
        </div>
        <div class="span4">
            <input type='button' class='btn-danger' value='示例&raquo;'/>
        </div>
        <div class="span4">
            <input type='button' class='btn-danger' value='Debug Tools&raquo;'/>
        </div>
   </div>
<p>##接下来的故事流程##</p>
<pre>
a.4个代码块处理 (PHP应用中)
b.4个api应用(APP模块中)
20天
周末处理
#第一阶段核心功能#
数据库设计，接口设计，API调用方法
平台数据开放接口，结合数据库，把CIer小站整个站点数据推出去，提供CIER_SDK(采用命令行模式)，接口调用逻辑，以及数据回显逻辑同API模块。

第一期结束后，对CI入门目录进行文字录入和信息扩展
1月

第2期以代码PK和通用模型为主（代码交互性比较高）
代码PK，以实际的问题需求，进行代码比赛(精确度和时间) 月为单位，定期执行 (脚本库  php_cli)
通用模型，介绍一些常用算法的实现，比如加班算法，天梯系统，加密解密算法，等等未知领域的研究

1月
第3期重点将围绕linux学习展开
服务器等相关知识点进行扩展学习

6月份左右做成一个成熟的技术站点，下半年平台将以全新的技术面貌解决来分析和解决问题
</pre>
