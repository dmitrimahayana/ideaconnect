<?php
	/* @var $this JobseekerController */
	/* @var $dataProvider CActiveDataProvider */
	$this->pageTitle = "Email Notifikasi";
	$this->breadcrumbs=array();
	
	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('form #subscribeCek').live('click', function(){
		if($(this).is(':not(:checked)')){
			$(this).parent('strong').parent('li').find('#input-form-subscribe').hide();
			$(this).parent('strong').parent('li').find('#is-enablesave').val(0);
		} else {
			$(this).parent('strong').parent('li').find('#input-form-subscribe').show();
			$(this).parent('strong').parent('li').find('#is-enablesave').val(1);
		}
	});
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js);
	
?>
	

<div class="boxed notifier">
	<h3 class="rockwell">
		Email Notifikasi
	</h3>
	<div class="box">
		<?php if(Yii::app()->user->hasFlash('success'))
			echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
		?>
		<div class="intro">Untuk mendapatkan semua informasi seputar CC PCR, lowonga, panggilan test dan lain-lain sekarang anda bisa menentukan sendiri type notifikasi email apa saja yang anda ingin dapatkan setiap harinya.</div>
		<p>Pilihlah dari type notifikasi dibawah ini yang anda ingin dapatkan.</p>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'subscribe',
			'enableAjaxValidation'=>false,
		)); ?>
		<?php if($model != null){?>
			<ul>
				<?php $i=1;
				foreach($model as $val){
					$checked = false;

					if($val->name == 'vacancy'){
						$checked = CcnEmployerVacancy::model()->isSubscribeEnabled($id, 'Jobseeker');
					}elseif($val->name == 'test'){
						$checked = CcnTestCall::model()->isSubscribeEnabled($id);
					}
					$arrPar = ComModules::model()->getParams($val->id, '#SUBSCRIBE#', '#END-SUBSCRIBE#');
					if(strpos($arrPar['model'], '(') !== false){
						$part = substr($arrPar['model'], 1,-1);
						$arr = explode('#', $part);
						$z = 0;
						foreach($arr as $row){
							$arrgrup = explode(':',$row);							
							$arrAuthItem[$arrgrup[0]] = $arrgrup[1];

						}
						foreach($arrAuthItem as $key=>$mod){
							$arrUsrGroup = explode('.', $key);
							foreach($arrUsrGroup as $auth) {
								$data[$auth] = $mod;
							}
							
						}

						if(array_key_exists(Yii::app()->user->id, $data)){
							$variabel = $data[Yii::app()->user->id];
						}
							
					}else{
						$variabel = $arrPar['model'];
					}

					
					$model = $variabel::model()->find(array('condition'=>'swt_users_id = '.Yii::app()->user->id_user.''));
					$arrData = array();
					
					//-------------------------------------
					if(strpos($arrPar['attr'], '(') !== false){
						$part = substr($arrPar['attr'], 1,-1);
						$arr = explode('#', $part);
						$z = 0;
						foreach($arr as $row){
							$arrgrup = explode(':',$row);							
							$arrAuthItem[$arrgrup[0]] = $arrgrup[1];

						}
						foreach($arrAuthItem as $key=>$mod){
							$arrUsrGroup = explode('.', $key);
							foreach($arrUsrGroup as $auth) {
								$data[$auth] = $mod;
							}
							
						}

						if(array_key_exists(Yii::app()->user->id, $data)){
							$arrAttr = explode('*', $data[Yii::app()->user->id]);
						}
							
					}else{
						$arrAttr = explode('*', $arrPar['attr']);
					}
					//-------------------------------------
					
					if($model != null){
						
					
						foreach($arrAttr as $item){
							$arrData[$item] = $model->$item;
						}
						//$subcribe = $model->subc_major;
					}else{
						foreach($arrAttr as $item){
							$arrData[$item] = 1;
						}
						
					}
					$arrData['moduleChecked'] = $checked;	
					$arrData['gid'] = Yii::app()->user->id;	
					
					
				?>
					<li>
						<strong><?php echo CHtml::checkBox('subscribeCek', $checked, array('uncheckValue'=>0));  echo ucfirst($val->label);?></strong>
						<span>
							<?php echo file_get_contents(Yii::app()->createAbsoluteUrl($val->subscribe_url_get_form,$arrData));?>
						</span>
					</li>
				<?php if($i%2==0){
						echo '<div class="clear"></div>';
					}
				$i++;
				}?>
				<div class="clear"></div>
				<li>
					<?php $checkedNews = Content::model()->isSubscribeEnabled($id);
					if($checkedNews == false){
						$enableSave = 0;
					}else{
						$enableSave = 1;
					}
					?>
					<strong><?php echo CHtml::checkBox('subscribeCek',$checkedNews, array('uncheckValue'=>0));?> Berita</strong>
					<span>
						<div id="input-form-subscribe" <?php echo $checkedNews == false?'class="hide"':'';?>>
							<?php $content = CcnSubscribeContent::model()->findByAttributes(array('swt_users_id'=>Yii::app()->user->id_user));
							$article = array();
							if($content != null){
								$article[$content->content_category] = array('selected' => 'selected');
							}
							
							$listDataContent = CHtml::listdata(ContentCategories::model()->findAll(array('condition'=>'published = 1 AND id != 1')), 'title', 'title');
							echo CHtml::hiddenField('CcnSubscribeContent[enableSave]', $enableSave, array('id'=>'is-enablesave'));?>
							Kategori: <br/><br/><?php echo CHtml::dropDownList('CcnSubscribeContent[content_category]', $content->content_category, $listDataContent); ?>
						</div>
					</span>
				</li>
				<div class="clear"></div>
			</ul>
			<?php echo CHtml::submitButton('Simpan'); ?>
		<?php }?>
			
			<?php $this->endWidget(); ?>
		
	</div>
</div>