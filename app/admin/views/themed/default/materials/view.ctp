<style type="text/css">
 label{font-weight:normal;}
 .am-form-horizontal .am-radio{padding-top:0;margin-top:0.5rem;display:inline;position:relative;top:6px;}
 .am-radio input[type="radio"]{margin-left:0px;}
 .am-form-label{font-weight:bold;}
 
 .scrollspy-nav {
    top: 0;
    z-index: 100;
    background: #5eb95e;
    width: 100%;
    padding: 0 10px;
  }

  .scrollspy-nav ul {
    margin: 0;
    padding: 0;
  }

  .scrollspy-nav li {
    display: inline-block;
    list-style: none;
  }

  .scrollspy-nav a {
    color: #eee;
    padding: 10px 20px;
    display: inline-block;
  }

  .scrollspy-nav a.am-active {
    color: #fff;
    font-weight: bold;
  }
  
  .crumbs{
  	padding-left:0;
  	margin-bottom:22px;
  }
</style>
<div>
	<div class="scrollspy-nav" data-am-scrollspy-nav="{offsetTop: 45}" data-am-sticky="{top:'52px',animation:'slide-top'}" style="margin-bottom:8px;">
		<ul>
		    <li><a href="#basic_information"><?php echo $ld['basic_information']?></a></li>
		</ul>
	</div>
	<div class="am-panel-group admin-content am-detail-view" id="accordion"  style="width:100%;">
		<?php echo $form->create('Material',array('action'=>'view/'.(isset($Mater['Material']['id'])?$Mater['Material']['id']:""),'onsubmit'=>'return material_check();'));?>
		<div class="btnouter am-text-right" data-am-sticky="{top:'100px',animation:'slide-top'}" style="margin:0;">
		  	<button type="submit" class="am-btn am-btn-success am-btn-sm am-radius" value=""><?php echo $ld['d_submit'];?></button>
		 	<button type="reset" class="am-btn am-btn-default am-btn-sm am-radius" value="" ><?php echo $ld['d_reset']?></button>
		</div>
			<input type="hidden" name="data[Material][id]" value="<?php echo isset($Mater['Material']['id'])?$Mater['Material']['id']:'';?>" />
		    <?php if(isset($backend_locales) && sizeof($backend_locales)>0){foreach ($backend_locales as $k => $v){?>
				<input name="data[MaterialI18n][<?php echo $k;?>][locale]" type="hidden" value="<?php echo $v['Language']['locale'];?>">
			<?php }}?>
			<div id="basic_information" class="am-panel am-panel-default">
		  		<div class="am-panel-hd">
					<h4 class="am-panel-title">
						<?php echo $ld['basic_information'] ?>
					</h4>
			    </div>
			    <div class="am-panel-collapse am-collapse am-in">
		      		<div class="am-panel-bd am-form-detail am-form am-form-horizontal">	
			    		<div class="am-form-group">
			    			<label class="am-u-lg-2 am-u-md-2 am-u-sm-3 am-form-label am-text-left" style="padding-top:20px;"><?php echo $ld['code']?></label>
			    			<div class="am-u-lg-7 am-u-md-7 am-u-sm-7">
			    				<div class="am-u-lg-11 am-u-md-11 am-u-sm-11">
			    					<input type="text" name="data[Material][code]" value="<?php echo isset($Mater['Material']['code'])?$Mater['Material']['code']:''?>"/>
			    				</div>
			    			</div>
			    		</div>				
			    		<div class="am-form-group">
			    			<label class="am-u-lg-2 am-u-md-2 am-u-sm-3 am-form-label am-text-left" style="padding-top:20px;"><?php echo $ld['name']?></label>
			    			<div class="am-u-lg-7 am-u-md-7 am-u-sm-7">
			    				<?php if(isset($backend_locales)&&sizeof($backend_locales)>0){foreach ($backend_locales as $k => $v){?>
			    				<div class="am-u-lg-11 am-u-md-11 am-u-sm-11" style="margin-bottom:10px;">
			    					<input type="text" id="material_name_<?php echo $v['Language']['locale']?>" name="data[MaterialI18n][<?php echo $k;?>][name]" value="<?php echo isset($Mater['MaterialI18n'][$v['Language']['locale']])?$Mater['MaterialI18n'][$v['Language']['locale']]['name']:'';?>" />
			    				</div>
								<?php if(sizeof($backend_locales)>1){?>
									<label class="am-u-lg-1 am-u-md-1 am-u-sm-1"  style="padding-top:19px;"><?php echo $ld[$v['Language']['locale']]?><em style="color:red;">*</em></label>
								<?php }?>
			    				<?php }}?>
			    			</div>
			    		</div>				
			    		<div class="am-form-group">
			    			<label class="am-u-lg-2 am-u-md-2 am-u-sm-3 am-form-label am-text-left" style="padding-top:20px;"><?php echo $ld['quantity']?></label>
			    			<div class="am-u-lg-7 am-u-md-7 am-u-sm-7">
			    				<div class="am-u-lg-11 am-u-md-11 am-u-sm-11">
			    					<input type="text" id="Material_quantity" name="data[Material][quantity]" value="<?php echo isset($Mater['Material']['quantity'])?$Mater['Material']['quantity']:''?>"/>
			    				</div>
			    				<label class="am-u-lg-1 am-u-md-1 am-u-sm-1" style="padding-top:18px;"><em style="color:red;">*</em></label>
			    			</div>
			    		</div>				
			    		<div class="am-form-group" >
			    			<label class="am-u-lg-2 am-u-md-2 am-u-sm-3 am-form-label am-text-left"><?php echo $ld['description']?></label>
			    			<div class="am-u-lg-7 am-u-md-7 am-u-sm-7">
			    				<?php if(isset($backend_locales)&&sizeof($backend_locales)>0){foreach ($backend_locales as $k => $v){?>
			    				<div class="am-u-lg-11 am-u-md-11 am-u-sm-11" style="margin-bottom:10px;">
			    					<textarea cols="60" name="data[MaterialI18n][<?php echo $k;?>][description]" rows="10"  ><?php echo isset($Mater['MaterialI18n'][$v['Language']['locale']])?$Mater['MaterialI18n'][$v['Language']['locale']]['description']:''?></textarea>
			    				</div>
			    				<?php if(sizeof($backend_locales)>1){?>
									<label class="am-u-lg-1 am-u-md-1 am-u-sm-1" style="padding-top:100px;"><?php echo $ld[$v['Language']['locale']]?></label>
								<?php }?>
			    				<?php }}?>
			    			</div>
			    		</div>				
			    		<div class="am-form-group">
			    			<label class="am-u-lg-2 am-u-md-2 am-u-sm-3 am-form-label am-text-left" style="padding-top:20px;"><?php echo $ld['unit']?></label>
			    			<div class="am-u-lg-7 am-u-md-7 am-u-sm-7">
			    				<div class="am-u-lg-11 am-u-md-11 am-u-sm-11">
			    					<input type="text" id="Material_unit" name="data[Material][unit]" value="<?php echo isset($Mater['Material']['unit'])?$Mater['Material']['unit']:''?>"/>
			    				</div>
                                <label class="am-u-lg-1 am-u-md-1 am-u-sm-1" style="padding-top:20px;"><em style="color:red;">*</em></label>
			    			</div>
			    		</div>				
			    		<div class="am-form-group">
			    			<label class="am-u-lg-2 am-u-md-2 am-u-sm-3 am-form-label am-text-left" style="padding-top:20px;"><?php echo $ld['orderby']?></label>
			    			<div class="am-u-lg-7 am-u-md-7 am-u-sm-7">
			    				<div class="am-u-lg-11 am-u-md-11 am-u-sm-11">
			    					<input type="text" id="material_orderby" name="data[Material][orderby]" value="<?php echo isset($Mater['Material']['orderby'])?$Mater['Material']['orderby']:'50'?>"  />		
			    				</div>
			    				  <div style="margin-top:5px;" class="am-u-lg-5 am-u-md-5 am-u-sm-5">
			    				<?php echo $ld['role_sort_default_num']?>
			    				  </div>
			    			</div>

			    		</div>
			    		<div class="am-form-group">
			    			<label class="am-u-lg-2 am-u-md-2 am-u-sm-3 am-form-label am-text-left" style="padding-top:20px;"><?php echo $ld['status']?></label>
			    			<div class="am-u-lg-7 am-u-md-7 am-u-sm-7">
			    				<div class="am-u-lg-12 am-u-md-12 am-u-sm-12">
			    					<label class="am-radio am-success" style="padding-top:2px;">
			    						<input type="radio" name="data[Material][status]" data-am-ucheck value="1" <?php echo !isset($Mater['Material']['status'])||(isset($Mater['Material']['status'])&&$Mater['Material']['status']==1)?"checked":""; ?> /><?php echo $ld['yes']?>
			    					</label>&nbsp;&nbsp;
									<label class="am-radio am-success" style="padding-top:2px;">
										<input type="radio" name="data[Material][status]"  data-am-ucheck  value="0" <?php echo isset($Mater['Material']['status'])&&$Mater['Material']['status']==0?"checked":""; ?> /><?php echo $ld['no']?>
									</label>
			    				</div>
			    			</div>
			    		</div>
			    		 
					</div>	
				</div>
			</div>
		<?php echo $form->end();?>
	</div>
</div>
<script>
function material_check(){
	var material_name_obj= document.getElementById("material_name_<?php echo $v['Language']['locale']?>");
	if(material_name_obj.value==""){
		alert("<?php echo $ld['enter_material_name']?>");
		return false;
	}
	var Material_quantity_obj=document.getElementById("Material_quantity");
	if(Material_quantity_obj.value==""){
		alert("<?php echo $ld['enter_material_quantity']?>");
		return false;
	}
    var Material_unit=document.getElementById("Material_unit");
    if(Material_unit.value==""){
		alert("<?php echo sprintf($ld['name_not_be_empty'],$ld['unit']); ?>");
		return false;
	}
    
}

</script>