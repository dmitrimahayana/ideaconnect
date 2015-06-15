<?php
$js = <<<EOP
$('a.clean').live('click', function(event) {
	if(!confirm('Anda yakin ingin menghapus module ini?\\naksi ini tidak dapat diundo.')) {
		return false;
	}
});
EOP;

Yii::app()->clientScript->registerScript(Utility::getUniqId(), $js, CClientScript::POS_READY);
?>

<div>
	<?php if(Yii::app()->user->hasFlash('success')): ?>
		<?php echo Yii::app()->user->getFlash('success')?>
	<?php endif; ?>

	<?php if(Yii::app()->user->hasFlash('error')): ?>
		<?php echo Yii::app()->user->getFlash('error')?>
	<?php endif; ?>
</div><br />

<?php

$asset = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview';
$uninstallButton = array(
	'label' => 'Uninstall',
	'url' => 'Yii::app()->controller->createUrl("uninstall",array("id"=>$data->id_module))',
	'imageUrl' => $asset.'/delete.png'
);

$installButton = array(
	'label' => 'Install',
	'url' => 'Yii::app()->controller->createUrl("install",array("mn"=>$data->nama))',
	'imageUrl' => Yii::app()->baseUrl.'/images/resource/icons/install.png'
);

$pages = $dataProvider->pagination;
?>

<div style="background-color: white" class="pl-10 pt-5 pb-5">
	<form action="<?php echo $this->createUrl('adminmanage'); ?>" name="form-module-upload"
		method="post" enctype="multipart/form-data">
		<label>Nama file: </label>&nbsp;
		<input type="file" name="file_name" size="40">&nbsp;
		<input type="submit" value="Submit">
	</form>
</div>
<br />
<div id="users-grid" class="grid-view">
	<div class="summary">Displaying 1-1 of 10 result(s).</div>
	<table class="items">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Description</th>
				<th>Status</th>
				<th class="button-column">Option</th>
			</tr>
		</thead>
	<tbody>
		<?php
		$i = 1;
		foreach($dataProvider->getData() as $val): ?>
			<?php
			$config = Yii::app()->moduleHandle->getModuleConfig($val['name']);
			if($i % 2 == 0): ?>
				<tr class="odd">
			<?php else: ?>
				<tr>
			<?php endif; ?>
					<td><?php echo $i?></td>
					<td><a href="<?php echo $this->createUrl('/'.$val['name'])?>" target="_blank"><?php echo $val['name']?></a></td>
					<td><?php echo $config['description']?></td>
					<td>
						<?php if($val['enabled'] == 1): ?>
							<img src="<?php echo Yii::app()->baseUrl.'/images/resource/icons/accept.png'?>" />
						<?php else: ?>
							<img src="<?php echo Yii::app()->baseUrl.'/images/resource/icons/cancel.png'?>" />
						<?php endif; ?>
					</td>
					<td class="button-column">
						<?php if($val['enabled'] == 1): ?>
							<?php echo CHtml::link('Uninstall', $this->createUrl('default/uninstall', array(
								'id' => $val['id'])), array('class' => 'delete'))?>
							<?php echo CHtml::link('Uninstall', $this->createUrl('default/delete', array(
								'id' => $val['id'])), array('class' => 'clean'))?>

						<?php else: ?>
							<?php echo CHtml::link('Install', $this->createUrl('default/install', array(
								'id' => $val['id'])))?>
						<?php endif; ?>
					</td>
				</tr>
		<?php
			$i++;
		endforeach; ?>
	</tbody>
	</table>
</div>
<?php $this->widget('CLinkPager', array('pages' => $dataProvider->pagination, 'header' => '')); ?>
