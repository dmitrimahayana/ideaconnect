<div class="sep">
   	<a href="<?php echo Yii::app()->createUrl("test/site/view",array('id'=>$data->id, 't'=>Utility::clearUrl($data->test_title))); ?>" title="Panggilan <?php echo $data->test_title; ?> ">Panggilan <?php echo $data->test_title ?></a><br/>
    Tanggal Tes : <?php echo date("d F Y",strtotime($data->test_date)); ?>| Jenis Tes: <?php echo $data->test_type->name; ?>
</div>
