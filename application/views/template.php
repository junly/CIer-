<!DOCTYPE html>
<html lang="en">
  <head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <title>CIer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="<?php echo base_url();?>">
    <link rel="shortcut icon" href="/css/favicon.ico">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body 
	  {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      footer p
      {
      	text-align: center;
	  }
	.rowmargin{
    	margin-bottom: 10px;
		}	  
.labelMargin1{
    margin-left: 40px;
}
.navlabel {
    padding: 1px 3px 2px;
    background-color: #F5F5F5;
    font-size: 9.75px;
    font-weight: bold;
    color: #4183CF;
    text-transform: uppercase;
    white-space: nowrap;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    margin-bottom: 5px;
    margin-top: 2px;
}		
footer {
    margin-top: 17px;
    padding-top: 17px;
    border-top: 1px solid #eee;
}
    </style>
    <script src="/js/jquery.js"></script>
    <script src="/js/ci.js"></script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15552146-7']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </head>
  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">CIer</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li <?php if($url=='dashboard'):?>class="active"<?php endif?>><?php echo anchor('/yang/dashboard', '控制台'); ?></li>
            </ul>
          
			<ul class="nav third-nav">
            <li class="dropdown">
            <?php echo anchor('/doc/home','体验中心 <b class="caret"></b>',array('class'=>'dropdown-toggle','data-toggle'=>'dropdown')); ?>
              <ul class="dropdown-menu">
                <li class="">
                <?php echo anchor('/doc/home','文档中心 ',array('data-toggle'=>'dropdown','data-target'=>'/doc/home')); ?>
				</li>
                <li class="divider"></li>
                <li class="">
                <?php echo anchor('/doc/start','Get Start ',array('data-toggle'=>'dropdown','data-target'=>'/doc/start')); ?>
				</li>
                <li class="">
                <?php echo anchor('/doc/api','API 设计 ',array('data-toggle'=>'dropdown','data-target'=>'/doc/api')); ?>
				</li>
                <li class="">
                <?php echo anchor('/doc/tool','工具',array('data-toggle'=>'dropdown','data-target'=>'/doc/tool')); ?>
				</li>
                <li class="">
                <?php echo anchor('/doc/app','PHP应用',array('data-toggle'=>'dropdown','data-target'=>'/doc/app')); ?>
				</li>
                <li class="">
                <?php echo anchor('/doc/linux','深渊',array('data-toggle'=>'dropdown','data-target'=>'/doc/linux')); ?>
				</li>	
                <li class="">
                <?php echo anchor('/doc/resource','资源',array('data-toggle'=>'dropdown','data-target'=>'/doc/resource')); ?>
				</li>	
                <li class="">
                <?php echo anchor('/doc/bzhao','关于本站',array('data-toggle'=>'dropdown','data-target'=>'/doc/bzhao')); ?>
				</li>																		
              </ul>
            </li>
    </ul>            
				<form class="navbar-search pull-left" action="">
           		 <input type="text" class="search-query span2" name="search" placeholder="搜索CI">
          	    </form>
          	<ul class="nav pull-right">
            <li><?php echo anchor('/doc/bzhao','关于小站 ',array('data-toggle'=>'dropdown','data-target'=>'/doc/bzhao')); ?></li>
          </ul>    
          
          <!-- DropDown -->         
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
		<?php /*处理消息提示*/echo $this->session->flashdata('message');?>
		
        <?php if ( isset ($content) && ! empty($content)): ?>
            <?php print $content; ?>
        <?php endif ?>


	 <footer>
        <p>&copy; Company 2012</p>
      </footer>
    </div> <!-- /container -->
    <script src="/js/bootstrap-transition.js"></script>
    <script src="/js/bootstrap-alert.js"></script>
    <script src="/js/bootstrap-modal.js"></script>
    <script src="/js/bootstrap-dropdown.js"></script>
    <script src="/js/bootstrap-scrollspy.js"></script>
    <script src="/js/bootstrap-tab.js"></script>
    <script src="/js/bootstrap-tooltip.js"></script>
    <script src="/js/bootstrap-popover.js"></script>
    <script src="/js/bootstrap-button.js"></script>
    <script src="/js/bootstrap-collapse.js"></script>
    <script src="/js/bootstrap-carousel.js"></script>
    <script src="/js/bootstrap-typeahead.js"></script>     
    <script src="/js/application.js"></script>       
    </body>
</html>
