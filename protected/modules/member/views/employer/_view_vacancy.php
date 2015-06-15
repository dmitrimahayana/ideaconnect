<?php 
$nowDate = date("Y-m-d H:i:s");
$closeDate = date($data->close_date);
$interval = Utility::dateInterval($nowDate, $closeDate); 
?>
<div class="sep">
     <?php echo $index + 1; ?> . <a href="<?php echo Yii::app()->createUrl("vacancy/site/view",array('id'=>$data->id, 't'=>Utility::clearUrl($data->position_name))); ?>" title="<?php echo $data->position_name ?>"><?php echo $data->position_name ?></a>
    <span><?php  if ($interval > 0) echo $interval ." hari "; else echo "tutup" ; ?></span>
</div>   
           
   

        