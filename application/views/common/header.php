<ul id="tab" class="nav nav-tabs">
<li <?php if($url=='home'):?>class="active"<?php endif;?>><?php echo anchor('/doc/home','Home',array('data-toggle'=>'dropdown','data-target'=>'/doc/home')); ?></li>
<li <?php if($url=='start' || $class=='start'):?>class="active"<?php endif;?>><?php echo anchor('/doc/start','Get Start',array('data-toggle'=>'dropdown','data-target'=>'/doc/start')); ?></li>
<li <?php if($url=='api' || $class=='api'):?>class="active"<?php endif;?>><?php echo anchor('/doc/api','API设计<span class="label label-info">5</span>',array('data-toggle'=>'dropdown','data-target'=>'/doc/api')); ?></li>
<li <?php if($url=='tool' || $class=='tool'):?>class="active"<?php endif;?>><?php echo anchor('/doc/tool','工具<span class="label label-important">2</span>',array('data-toggle'=>'dropdown','data-target'=>'/doc/tool')); ?></li>
<li <?php if($url=='app' || $class=='app'):?>class="active"<?php endif;?>><?php echo anchor('/doc/app','PHP应用<span class="label label-success">8</span>',array('data-toggle'=>'dropdown','data-target'=>'/doc/model')); ?></li>
<li <?php if($url=='model' || $class=='model'):?>class="active"<?php endif;?>><?php echo anchor('/doc/model','通用模型<span class="label label-inverse">1</span>',array('data-toggle'=>'dropdown','data-target'=>'/doc/code')); ?></li>
<li <?php if($url=='code' || $class=='code'):?>class="active"<?php endif;?>><?php echo anchor('/doc/code','代码PK<span class="label">1</span>',array('data-toggle'=>'dropdown','data-target'=>'/doc/app')); ?></li>
<li <?php if($url=='linux' || $class=='linux'):?>class="active"<?php endif;?>><?php echo anchor('/doc/linux','深渊',array('data-toggle'=>'dropdown','data-target'=>'/doc/linux')); ?></li>
<li <?php if($url=='resource' || $class=='resource'):?>class="active"<?php endif;?>><?php echo anchor('/doc/resource','资源',array('data-toggle'=>'dropdown','data-target'=>'/doc/resource')); ?></li>
<li <?php if($url=='bzhao'):?>class="active"<?php endif;?>><?php echo anchor('/doc/bzhao','关于本站',array('data-toggle'=>'dropdown','data-target'=>'/doc/bzhao')); ?></li>
</ul>