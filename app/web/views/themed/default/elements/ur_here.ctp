<!-- Breadcrumbs -->
<style type="text/css">
	.am-color a{color:black}
</style>
		<ol class="am-breadcrumb am-hide-md-down am-color">
		  <?php if(!empty($ur_heres)){
			$count=count($ur_heres);
			foreach($ur_heres as $k=>$v){
			  if(!empty($v['url'])){
				//echo $v['url'];
				echo "<li>".$html->link($v['name'],$v['url'])."</li>";
			  }
			  else
				echo "<li class='am-active'>".$v['name']."</li>";
			}
		  }?>
		</ol>

<!-- Breadcrumbs END -->