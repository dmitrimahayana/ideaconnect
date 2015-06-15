<script>
    function appFund(id,typeAct,project_id)
    {
        var x;
        var r=confirm("Apakah anda yakin setujui pendanaan?");
        if (r==true)
        {
            window.location.href='<?php echo Yii::app()->controller->createUrl("adminUpdateRequisite"); ?>/id/'+id+'/type/'+typeAct+'/project_id/'+project_id
            //window.location.href='<?php echo Yii::app()->controller->createUrl("adminUpdateRequisite",array("id"=>$data->id, "type"=>'appFund')); ?>'
        }
        else
        {
            //x="You pressed Cancel!";
        }
    }
</script>
<button name="appFund" class="float-right" onclick="appFund('0','appFund',<?php echo $id ?>)">Setujui Pendanaan</button><br/>

<br/>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model->getDetailSomeRequisite($id),
    'itemView'=>'/projectrequisite/requisite_detail',   // refers to the partial view named '_post'
    'template' => "{items}\n{pager}",
));
?>