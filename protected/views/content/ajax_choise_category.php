<div class="dialog-header">Select Category</div>
<form id="menu-types-form" action="/201207_sweeto.com/menutypes/adminadd" method="post">
	<div class="dialog-content">
		<div id="ajax-message"></div>	
		<fieldset>				
			<div>
				<label for="MenuTypes_group_type">Select Category</label>
				<div class="desc">
					<span id="MenuTypes_group_type">
						<?php
						if($model != null) {
							foreach($model as $val) {
						?>
							<input id="" value="back_office" type="radio" name="MenuTypes[group_type]" onclick="document.location.href='<?php echo Yii::app()->createUrl('content/adminadd', array('cid' => $val->id))?>'"/> 	
							<label for=""><?php echo $val->title; ?></label><br/>
						<?php }
						} ?>				
					</span>			
				</div>
				<div class="clear"></div>
			</div>
			<div class="dialog-submit">
				<input id="closed" name="yt1" type="button" value="Closed" />
			</div>
		</fieldset>
	</div>
</form>