<?php
$cs = Yii::app()->getClientScript();
$urlUpdate=Yii::app()->controller->createUrl("adminUpdateRequisite");
$urlAjaxVolunteerUser=Yii::app()->createUrl('project/project/EditTime/id');

$js=<<<EOP
    function verify(id,typeAct,project_id)
    {
        if(typeAct=="approve"){
            var r=confirm("Apakah anda yakin terima pendanaan?");
            if (r==true)
            {
                window.location.href='$urlUpdate/id/'+id+'/type/'+typeAct+'/project_id/'+project_id
            }
        }
        else if(typeAct=="cancel"){
            var r=confirm("Apakah anda yakin tolak pendanaan?");
            if (r==true)
            {
                window.location.href='$urlUpdate/id/'+id+'/type/'+typeAct+'/project_id/'+project_id
            }
        }
        else {
            var r=confirm("Apakah anda yakin pending pendanaan?");
            if (r==true)
            {
                window.location.href='$urlUpdate/id/'+id+'/type/'+typeAct+'/project_id/'+project_id
            }
        }
    }

    function showPopUpTime(idPendanaan){
        var inp=idPendanaan;
        var urlAjaxVolunteerUser="$urlAjaxVolunteerUser";
        $.ajax({
            type: "POST",
            //dataType: "html",
            data: "input="+inp,
            url: urlAjaxVolunteerUser+'/'+inp,
            success: function(data) {
                //alert(data);
                //$("div").html(data).dialog({modal: true}).dialog('open');
                $('#mydialog1').dialog("open");

            },
            error: function(xhr,err){
                //alert("readyState: "+xhr.readyState+" "+xhr.status);
                alert(xhr.responseText);
            }
        });
    };

EOP;

$cs->registerScript('search', $js, CClientScript::POS_HEAD);
?>
    <!--<a class="link-dialog" href="javascript:void(0);" id="<?= $data->id ?>" url="<?= Yii::app()->createUrl('project/project/EditTime') ?>">Edit Waktu Pendanaan</a>

    <br/><a class="link-dialog" href="javascript:void(0);" id="demo-dlg">Tes klik</a>
    <div class="open-dialog-demo-dlg" style="display: none;">
        <div class="title-box-blue"><a class="dialog-close" href="javascript:void(0);" title="close">Close</a></div>
        <h1>asdasdsadadad</h1>
    </div>-->

    <div class="view">

        <b><?php echo 'Pengajuan Pendanaan ke- ';//CHtml::encode($data->getAttributeLabel('counter_time')); ?></b>
        <?php echo CHtml::encode($data->counter_time); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('total_value')); ?>:</b>
        <?php echo CHtml::encode($data->total_value); ?>
        <br />

        <b><?php echo CHtml::encode('Lama Project'); ?>:</b>
        <?php echo CHtml::encode($data->funding_time.' Bulan'); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('funding_started_time')); ?>:</b>
        <?php echo CHtml::encode($data->funding_started_time); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('funding_closed_time')); ?>:</b>
        <?php echo CHtml::encode($data->funding_closed_time); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('argument')); ?>:</b>
        <?php echo CHtml::encode($data->argument); ?>
        <br />

        <!---<b><?php //echo CHtml::encode($data->getAttributeLabel('is_approved')); ?>:</b>
        <?php //echo CHtml::encode($data->is_approved); ?>
        <br />-->

        <?php if($data->is_approved==1){ ?>
            <b>Status: <a style="color:red">Telah Disetujui</a></b><br />
        <?php } else if($data->is_approved==0){ ?>
            <b>Status: <a style="color:red">Belum Disetujui</a></b><br />
        <?php } else { ?>
        <b>Status: <a style="color:red">Pending</a></b><br />
        <?php } ?>

        <?php if(isset($data->approved_time)){ ?>
            <b><?php echo CHtml::encode($data->getAttributeLabel('approved_time')); ?>:</b>
            <?php echo CHtml::encode($data->approved_time); ?>
            <br />
        <?php } ?>

        <br />
        <button name="edit_time" onclick="window.location.href='<?php echo Yii::app()->createUrl('project/admin/EditTime',array('id'=>$data->id,'project_id'=>$data->project_id)); ?>'">Ubah Waktu Pendanaan</button>
        <button name="fundinguser" onclick="window.location.href='<?= Yii::app()->createUrl('project/admin/GetFundingUser',array('id'=>$data->id,'project_id'=>$data->project_id)); ?>'">Lihat Pendanaan Sponsor</button>
        <button name="reward" onclick="window.location.href='<?= Yii::app()->createUrl('project/admin/GetDetailReward',array('id'=>$data->id,'project_id'=>$data->project_id)); ?>'">Lihat Detail Reward</button>
        <br /><br />

        <?php
        if($data->cekMaterial($data->id)) {
            $model_material=New Material("'getSomeMaterial($data->id)'");

            $columnTemp = array();
            if(isset($_GET['GridColumn'])) {
                foreach($_GET['GridColumn'] as $key => $val) {
                    if($_GET['GridColumn'][$key] == 1) {
                        $columnTemp[] = $key;
                    }
                }
            }
            $columns_material = $model_material->getGridColumn($columnTemp);

            echo '<br />Detail Material';
            $this->widget('application.components.system.BGridView', array(
                //'id'=>'project-grid',
                'dataProvider'=>$model_material->getSomeMaterial($data->id),
                'columns' => $columns_material,
            ));
        }
        ?>

        <?php
        if($data->cekFunding($data->id)) {
            $model_funding=New Funding("'getSomeFunding($data->id)'");

            $columnTemp = array();
            if(isset($_GET['GridColumn'])) {
                foreach($_GET['GridColumn'] as $key => $val) {
                    if($_GET['GridColumn'][$key] == 1) {
                        $columnTemp[] = $key;
                    }
                }
            }
            $columns_funding = $model_funding->getGridColumn($columnTemp);

            echo '<br/>Detail Dana';
            $this->widget('application.components.system.BGridView', array(
                //'id'=>'project-grid',
                'dataProvider'=>$model_funding->getSomeFunding($data->id),
                'columns' => $columns_funding,
            ));
        }
        ?>

        <?php
        if($data->cekVolunteer($data->id)) {
            $model_volunteer=New VolunteerRequirement("'getSomeVolunteer($data->id)'");

            $columnTemp = array();
            if(isset($_GET['GridColumn'])) {
                foreach($_GET['GridColumn'] as $key => $val) {
                    if($_GET['GridColumn'][$key] == 1) {
                        $columnTemp[] = $key;
                    }
                }
            }
            $columns_volunteer = $model_volunteer->getGridColumn($columnTemp);

            array_push($columns_volunteer, array(
                'header' => 'Option',
                'class'=>'CButtonColumn',
                'template' => '{test}&nbsp;',
                'buttons' => array(
                    'test' => array(
                        'label' => 'Detail Sukarelawan',
                        'options' => array(
                            'rel' => 500,
                            'class' => 'view',
                        ),
                        'click' => 'dialogUpdate',
                        'url' => 'Yii::app()->controller->createUrl("DetailVolunteer",array("id"=>$data->primaryKey,"project_id"=>'.$data->project_id.', "requirement"=>$data->requirement))',
                    ),
                ),
            ));

            echo '<br/>Detail Sukarelawan';
            $this->widget('application.components.system.BGridView', array(
                //'id'=>'project-grid',
                'dataProvider'=>$model_volunteer->getSomeVolunteer($data->id),
                'columns' => $columns_volunteer,
            ));
        }
        ?>

        <br/>
        <button name="cancel" onclick="verify('<?php echo $data->id; ?>','cancel','<?php echo $data->project_id; ?>')">Cancel</button>
        <button name="pending" onclick="verify('<?php echo $data->id; ?>','pending','<?php echo $data->project_id; ?>')">Pending</button>
        <button name="approve" onclick="verify('<?php echo $data->id; ?>','approve','<?php echo $data->project_id; ?>')">Approve</button>
        <br />
        <br />
    </div>
