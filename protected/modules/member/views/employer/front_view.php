<?php
	/* @var $this EmployerController */
	/* @var $model PcrUsers */

	$this->pageTitle = $model->name;
	$this->breadcrumbs=array(
		'Pcr Users'=>array('index'),
		$model->name,
	);
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/module/member/member_employer.css');
$js=<<<EOP
	$('div.closedVacancy').hide();
	$('.profile .sidebar ul li').click(function(){
		var id = $(this).attr('id');
		$('.profile .sidebar ul li').removeClass('active');
		$(this).addClass('active');
		$('.profile .content div[name="tabs-on"]').hide();
		$('.profile .content div[name="tabs-on"].'+id).show();
	});
EOP;
	$cs->registerScript('headline', $js, CClientScript::POS_END);

?>

<?php //begin.Content ?>
<div class="grid-9 profile">
	<div class="boxed">
		<h3 class="rockwell"><?php echo $model->name ?></h3>
		<div class="box">
			<div class="intro">
				<?php
					if($model->company_logo != '') {
						$images = Yii::app()->request->baseUrl.'/images/member_upload/employer/medium/medium_'.$model->company_logo;
					} else {
						$images = Yii::app()->request->baseUrl.'/images/member_upload/employer/medium/employer_default.png';
					}
				?>
				<img src="<?php echo $images; ?>" alt="" />
				<span><?php echo $model->company_desc; ?></span><br/>
				<strong>Contact:</strong><br/>
				<?php echo $model->address; ?><br/>
				<?php echo $model->city->name; echo " , "; echo $model->province->name;?><br />
                <?php echo $model->country->name; ?>
			</div>
			<div class="clear"></div>
			<?php //begin.Sidebar ?>
			<div class="sidebar">
				<ul>
					<li id="vacancy" class="active"><a href="javascript:void(0);" title="Lowongan Terbaru">Lowongan Terbaru</a><span><em>Arrow</em></span></li>
					<li id="closedVacancy"><a href="javascript:void(0);" title="Lowongan Lainnya">Lowongan Tutup</a><span><em>Arrow</em></span></li>
					<li id="test"><a href="javascript:void(0);" title="Panggilan Tes">Panggilan Tes</a><span><em>Arrow</em></span></li>
				</ul>
			</div>
			<?php //end.Sidebar ?>

			<?php //begin.Content ?>
			<div class="content">
				<?php //begin.Vacancy ?>
				<div class="vacancy" name="tabs-on">
					<?php
					$this->widget('application.components.system.FListView', array(
						'dataProvider'=>$dataProviderVacancy,
						'summaryText' =>'', 
						'itemView'=>'_view_vacancy',
						'pager' => array(
							'header' => '',
						), 
						'pagerCssClass'=>'pager',
						'emptyText' => 'Maaf, sepertinya belum ada lowongan yang tersedia untuk saat ini. <br />Silakan cek kembali disaat yang lain.',
					)); ?>
				</div>
				<?php //end.Vacancy ?>
				
				<?php //begin.Closed Vacancy ?>
				<div class="closedVacancy" name="tabs-on">
					<?php
					$this->widget('application.components.system.FListView', array(
						'dataProvider'=>$dataProviderClosed,
						'summaryText' =>'', 
						'itemView'=>'_view_vacancy',
						'pager' => array(
							'header' => '',
						), 
						'pagerCssClass'=>'pager',
						'emptyText' => 'Maaf, sepertinya belum ada lowongan yang tutup untuk saat ini. <br />Silakan cek kembali disaat yang lain.',
					)); ?>
				</div>
				<?php //end.Closed Vacancy ?>

				<?php //begin.Test ?>
				<div class="test" name="tabs-on">
					<?php
					$this->widget('application.components.system.FListView', array(
						'dataProvider'=>$dataProviderTest,
						'summaryText' =>'', 
						'itemView'=>'_view_test',
						'pager' => array(
							'header' => '',
						), 
						'pagerCssClass'=>'pager',
						'emptyText' => 'Maaf, sepertinya belum ada panggilan tes yang tersedia untuk saat ini. <br />Silakan cek kembali disaat yang lain.',
					)); ?>
				</div>
				<?php //end.Test ?>
			</div>
			<?php //end.Content ?>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php //end.Content ?>

<?php //begin.Sidebar ?>
<div class="grid-3 sidebar last">

	<?php //begin.Banner ?>
	<?php $this->widget('SidebarBanner'); ?>
	<?php //begin.Banner ?>

	<?php //begin.Article ?>
	<?php $this->widget('SidebarArticle'); ?>
	<?php //begin.Article ?>

	<?php //begin.Social Network ?>
	<?php $this->widget('SidebarSocialNetwork'); ?>
	<?php //begin.Social Network ?>

</div>
<?php //end.Sidebar ?>
