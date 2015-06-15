<?php
$this->pageTitle = 'Content Frontpages Create';
$this->breadcrumbs=array(
	'Content Frontpages'=>array('adminmanage'),
	'Create',
);

?>



<?php echo $this->renderPartial('/content_frontpage/_form', array('model'=>$model)); ?>