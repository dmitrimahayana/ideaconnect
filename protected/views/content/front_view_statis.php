<?php
	$this->pageTitle = "Berita";
	/* Register Script */
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/module/article/article_view.css');
?>

<?php echo $model->full_text ?>