<?php echo $this->load->view('common/header');?>
<div class="page-header">
    <h1>API设计<small>从项目中的实际应用出发</small></h1>
</div>  
<div class="tooltip-demo well">
<p class="muted" style="margin-bottom: 0;">
从实际开发的API项目中出发
</p>
</div>
<div class="row rowmargin">
        <div class="span12">
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th style="width: 20%">API Launch</th> 
                    <th style="width: 58%">接口描述</th>
                    <th style="width: 10%">Demo状态</th>
                    <th>Source Code</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo anchor('/docs/api/denglu','Denglu API','class="btn btn-success"');?></td>
                    <td>灯鹭向希望使自己的网站更加社会化的站长或网站管理者们提供一个社会化登录与用户管理平台。平台的产品包括社会化登录、社会化分享、账号绑定、邀请好友等解决方案，以及网站社会化指标的统计分析报告服务</td>
         			<td><span class="label label-success">Success</span></td>
         			<td><a href="https://raw.github.com/ftwbzhao/Host-Manage/master/application/controllers/sns/auth.php" class="btn" target="_blank" >Source</a></td>
                </tr>
                <tr>
                    <td><?php echo anchor('/docs/api/google_analytics','Google Data Export API','class="btn btn-success"');?></td>
                    <td>通过 Google Analytics（分析）Data Export API，您可以开发相应的客户端应用程序，从授权用户的现有 Google Analytics（分析）配置文件中请求数据，并使用各种查询参数对请求结果进行筛选。目前，Data Export API 可支持对 Google Analytics（分析）数据进行只读访问</td>
         			<td><span class="label label-info">Development</span></td>
         			<td><a href="https://raw.github.com/ftwbzhao/Host-Manage/master/application/controllers/sns/auth.php" class="btn" target="_blank" >Source</a></td>
                </tr>
                <tr>
                    <td><?php echo anchor('/docs/api/enom','Enom Host API','class="btn btn-success"');?></td>
                    <td>eNom's API is an enterprise level solution that allows your organization, no matter its size, to easily integrate eNom’s products and services directly into your business. Our API is extensible, easy to implement, and reliable. It has power with access to over 300+ commands, while its simplified design makes implementation quick and easy.</td>
         			<td><span class="label label-success">Success</span></td>
         			<td><a href="https://raw.github.com/ftwbzhao/Host-Manage/master/application/controllers/api.php" class="btn " target="_blank" >Source</a></td>
                </tr>   
                <tr>
                    <td><?php echo anchor('/docs/api/wepay','Wepay API','class="btn btn-success"');?></td>
                    <td>WePay是一家由Y Combinator支持的初创公司，旨在解决群组支付中的问题，最新退出了一项新的票务功能，允许用户在线售票。WePay是一款超级简单的进行收集、管理和支付群组资金的服务。</td>
         			<td><span class="label label-important">Debug</span></td>
         			<td><a href="https://raw.github.com/ftwbzhao/Host-Manage/production/application/controllers/openqq/service.php" class="btn " target="_blank" >Source</a></td>
                </tr>   
            </tbody>
            </table>
        </div>
    </div>
<div class="alert alert-info">
        <strong>亲!</strong> API的代码持续整理中，会提供API调试工具进行展示分析，正在敲写调试工具的代码，敬请期待吧。。。
</div>