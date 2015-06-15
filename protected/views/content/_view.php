<div class="sep">
	<?php $baseUrl = Yii::app()->request->baseUrl.'/images/content/';
			$img = $data->images != '' ? $baseUrl . Content::model()->replaceSpaceWithUnderscore($data->content_categories->title).'/article_thumb_'.$data->images: $baseUrl . 'article_thumb_default_image.jpg'; ?>
	<img src="<?php echo $img?>" alt="<?php echo $data->images?>" />
	<a href="<?php echo Yii::app()->controller->createUrl('content/view',array('id'=>$data->id,'t'=>Utility::clearUrl($data->alias_url))); ?>" title="<?php echo $data->title ?>"><?php echo $data->title ?></a><br/>
	<span><?php echo  $data->content_categories->title ?> | <?php echo date('d F Y H:i',strtotime($data->modified));?>&nbsp;wib</span>
	<br/>
	<?php echo  Utility::shortText($data->intro_text,160,' <a class="more" href ="'.Yii::app()->controller->createUrl('content/view',array('id'=>$data->id,'t'=>Utility::clearUrl($data->alias_url))).'">More</a>') ?>
	<div class="clear"></div>
</div>


	