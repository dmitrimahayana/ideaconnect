<?php
	$this->pageTitle = "Berita";
	/* Register Script */
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/module/article/article_index.css');
?>

<?php //begin.Content ?>
<div class="grid-9 article">
	
	<div class="boxed">
		<?php //begin.Title ?>
		<?php if((!isset($_GET['y']) &&  !isset($_GET['m'])) && ($_GET['cid'] == 0)) { ?>
		<h3 class="rockwell">Headline</h3>
		<?php } ?>
		
		<?php //begin.Content ?>
		<div class="box">
        <?php if((!isset($_GET['y']) &&  !isset($_GET['m'])) && ($_GET['cid'] == 0)) { ?>
         	<?php foreach($headnews as $key => $val){ ?>
			<?php //begin.Headline ?>
			<div class="headline">
				<?php $baseUrl = Yii::app()->request->baseUrl.'/images/content/';
						$img = $val->images != '' ? $baseUrl . Content::model()->replaceSpaceWithUnderscore($val->content_categories->title).'/article_firstrow_'.$val->images: $baseUrl . 'article_firstrow_default_image.jpg'; ?>
				<img class="big" src="<?php echo $img?>" alt="<?php echo $val->images?>" />
				<a href="<?php echo Yii::app()->controller->createUrl('content/view',array('id'=>$val->id, 't'=>Utility::clearUrl($val->title))); ?>" title="<?php echo $val->title ?>"><?php echo $val->title ?></a>
				<span><?php echo  $val->content_categories->title ?> | <?php echo date('d F Y H:i',strtotime($val->modified));?>&nbsp;wib</span>
				<?php echo  Utility::shortText($val->intro_text,160,'...<a class="more" href ="'.Yii::app()->controller->createUrl('content/view',array('id'=>$val->id,'title'=>$val->title)).'">More</a>') ?>
				<div class="clear"></div>
			</div>
			<?php } ?>
		<?php } ?>
			<?php //begin.Arsip and Article ?>
			<div class="content">
				<div class="title">
					<h2 class="arsip"><span class="rockwell">Arsip</span></h2>
					<h2 class="previous">
						<span class="rockwell">
						<?php if(isset($_GET['y']) ||  isset($_GET['m'])) {
							if(isset($_GET['y']) &&  isset($_GET['m']))
								echo Yii::t('site', 'Arsip').' '. Yii::t('site', 'Tahun')." {$_GET['y']} ".Yii::t('site', 'Bulan'). ' '.Utility::monthInt2Name($_GET['m'], false);
							elseif(isset($_GET['y']))
								echo Yii::t('site', 'Arsip').' '. Yii::t('site', 'Tahun')." '{$_GET['y']}' ";
						
						}else if ($_GET['cid'] != 0) {
							$cat = ContentCategories::model()->find('id = '.$_GET['cid']);
							echo Yii::t('site', 'Kategori Artikel: '.$cat->title);
						} else	echo Yii::t('site', 'Artikel Sebelumnya');
						?>

						</span>
					</h2>
					<div class="clear"></div>
				</div>
				<?php //begin.Arsip ?>
				<div class="arsip">
                    <div class="category">
						<h4 class="rockwell">Kategori</h4>
						<div class="box">
							<ul>
								<?php
								$categories = Content::model()->findAll(array(
									'select' => 'id, modified, content_categories_id, title, alias_url, intro_text, full_text, images',
									'condition' => "published = 1 and section_id != 1 and content_categories_id !=4" ,
									'group'=>'content_categories_id', 			
									'order' => 'modified DESC'
								));
								/*foreach($categories as $key =>$val){
									$classCat = isset($_GET['content_categories_id']) && $_GET['content_categories_id'] == $key ? 'class="active"' : '';						
									$cat .= "<li $classCat><a href=\"".Yii::app()->createUrl('content/index', array('sid' => 2, 'content_categories_id' => $key ))."\" title=\"Klik disini untuk melihat arsip tahun $key \">$key ($val)</a>";
									$cat .= "</li>";
								}*/

								$class = $_GET['cid'] == 0 ? ' class="active"' : '';
								echo '<li'.$class.'><a href="'.Yii::app()->controller->createUrl('index', array('sid' => 2, 'cid' => 0)).'">Semua Kategori</a><span><em></em></span></li>';
								foreach($categories as $key =>$val){
								$class = $val->content_categories_id == $_GET['cid'] ? ' class="active"' : '';
								?>
									<li <?php echo $class ?>><a href="<?php echo Yii::app()->controller->createUrl('index', array('sid' => 2, 'cid' => $val->content_categories_id));?>"><?php echo $val->content_categories->title?></a><span><em></em></span></li>
									<?php /*<li<?php echo $class.'><a href="'.Yii::app()->controller->createUrl('index', array('sid' => 2, 'cid' => $val->content_categories_id)).'">'.$val->content_categories->title;?></a></li>*/?>
								<?php } ?>	
							</ul>
						</div>
						<?php /*<a class="more" href="javascript:void(0);" title="Selengkapnya">More<img src="<?php echo Yii::app()->request->baseUrl?>/images/icons/more_small.png" alt="Selengkapnya"/></a>*/ ?>
					</div>
                    <div class="archive">
						<h4 class="rockwell">Arsip</h4>
						<ul>
							<?php
							$nowYear = date('Y');
							$nowMonth = date('m');
							$archive = '';			
							$arrTotalPerYear = array();
							$arrPerMonth = array();

								$sql = 'SELECT YEAR(modified) as year_create, MONTH(modified) as month_create, COUNT(id) AS amount FROM swt_content ';
								$sql .= 'WHERE section_id != 1 AND content_categories_id != 4 GROUP BY YEAR(modified), MONTH(modified)';
								$rows = Yii::app()->db->createCommand($sql)->query();
								while(($row = $rows->read()) !== false) {
									$arrTotalPerYear[$row['year_create']] = $arrTotalPerYear[$row['year_create']] + $row['amount'];
									$arrPerMonth[$row['year_create']][$row['month_create']] = $row['amount'];													
								}
								krsort($arrTotalPerYear);
								
								foreach($arrTotalPerYear as $key=>$val) {
									$classY = isset($_GET['y']) && $_GET['y'] == $key ? 'class="active"' : '';
									$archive .= "<li $classY><a href=\"".Yii::app()->createUrl('content/index', array('sid' => 2, 'y' => $key ))."\" title=\"Klik disini untuk melihat arsip tahun $key \">$key ($val)</a>";
									krsort($arrPerMonth[$key]);
									$archive .= '<ul>';
									foreach($arrPerMonth[$key] as $monthKey=>$item) {
										$class = isset($_GET['m']) && $_GET['m'] == $monthKey ? 'class="active"' : '';
										$archive .= 	'<li '.$class.'><a href="'.Yii::app()->createUrl('content/index', array('sid' => 2, 'y' => $key, 'm' => $monthKey )).'" title="Klik disini untuk melihat arsip tahun '.$key.' bulan '.Utility::monthInt2Name($monthKey, false).' ">'.Utility::monthInt2Name($monthKey, false).' ('.$item.')</a></li>';
									}
									$archive .= '</ul>';
									$archive .= "</li>";
								}
								echo $archive;
							?>
						</ul>
					</div>
					
				</div>
				<?php //begin.Previous Article ?>
				<div class="previous">
				<?php /* 	<?php 
						$id = $val->id;
						$archieve = Content::model()->findAll(array(
                            'select' => 'id, modified, content_categories_id, title, alias_url, intro_text, full_text, images',
                            'condition' => " id != $id   and published = 1 and section_id = 2" , 			
                            'limit'=>4,
                            'order' => 'modified DESC'
                        )); 
                    ?>
					<?php foreach($archieve as $key => $val){ ?>
					<div class="sep">
						<?php $baseUrl = Yii::app()->request->baseUrl.'/images/content/';
								$img = $val->images != '' ? $baseUrl . Content::model()->replaceSpaceWithUnderscore($val->content_categories->title).'/article_thumb_'.$val->images: $baseUrl . 'article_thumb_default_image.jpg'; ?>
						<img src="<?php echo $img?>" alt="<?php echo $val->images?>" />
						<a href="<?php echo Yii::app()->controller->createUrl('content/view',array('id'=>$val->id,'t'=>Utility::clearUrl($val->alias_url))); ?>" title="<?php echo $val->title ?>"><?php echo $val->title ?></a><br/>
						<span><?php echo  $val->content_categories->title ?> | <?php echo date('d F Y H:i',strtotime($val->modified));?>&nbsp;wib</span>
						<br/>
						<?php echo  Utility::shortText($val->intro_text,160,'...<a class="more" href ="'.Yii::app()->controller->createUrl('content/view',array('id'=>$val->id,'t'=>Utility::clearUrl($val->alias_url))).'">More</a>') ?>
						<div class="clear"></div>
					</div>
                    <?php } ?> */?>
					
					<?php 
				$emptyText = '<span class="empty bell-gothic">Maaf, berita tidak ditemukan.</span>';
				$this->widget('application.components.system.FListView', array(
					'dataProvider'=>$dataProvider,
					'summaryText' =>'', 
					'itemView'=>'_view',
					'pager' => array(
						'header' => '',
					), 
					//'pagerCssClass'=>'pager',
					'emptyText' =>$emptyText,
				)); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<?php //end.Content ?>

<?php //begin.Sidebar ?>
<div class="grid-3 sidebar last">
	<?php //begin.Banner ?>
	<?php $this->widget('SidebarBanner'); ?>
	<?php //begin.Banner ?>

	<?php //begin.Vacancy ?>
	<?php $this->widget('SidebarVacancy'); ?>
	<?php //begin.Vacancy ?>

	<?php //begin.Social Network ?>
	<?php $this->widget('SidebarSocialNetwork'); ?>
	<?php //begin.Social Network ?>

</div>
<?php //end.Sidebar ?>
