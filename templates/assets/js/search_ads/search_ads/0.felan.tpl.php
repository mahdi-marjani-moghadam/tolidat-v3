<script type="text/javascript">jQuery(function($){$('input[name=search1]').autoComplete({ajax: '<?php echo RELA_DIR?>product/ajax_search',postData: {	}});});
function sublit_search(a){  action=$("#search_ads_input").val(); address_search= $("#target").attr("action"); final_address='<?php echo RELA_DIR?>product/search'+'/'+action
   $("#target").attr("action", final_address);  document.getElementById("target").submit();}function keypress(event){ var chCode = ('charCode' in event) ? event.charCode : event.keyCode; 	if(event.keyCode == 13){ sublit_search();}} </script>
<? global $PARAM;?>
<div class="navbar">
	<div class="navbar-inner">
		<form action="<?php echo RELA_DIR?>product/search" method="post" class="navbar-form pull-right" id="target" onsubmit="return sublit_search()">
			<div class="input_container">
				<input name="search1" class="span10" id="search_ads_input" onkeypress="keypress(event);" value="<?php echo ($PARAM['1']=='search')? $PARAM['2']:'';?>" ype="text" placeholder=" به دنبال چه میگردید"/>
				<button type="submit" class="btn">جستجو</button>
			</div>
		</form>
	</div>
</div>
<? return ;?>
