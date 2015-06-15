<?php
	//$this->pageTitle = "Berita ".$model->title;
	/* Register Script */
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/module/article/article_view.css');
	$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/main/content/custom_view.js', CClientScript::POS_END);
	$updateCommentTarget = Yii::app()->createUrl('content/comments');
$js=<<<EOP

	$('#disqus_thread').ready(function(){
		var totalComments = $('#content$model->id').text();
		$.ajax({
			type:'post',
			url:'$updateCommentTarget',
			data: 'comment='+totalComments+'&id='+$model->id,
			success: function(r){}
		});
	});
	
EOP;
	$ukey = md5(uniqid(mt_rand(), true));
	$cs->registerScript($ukey, $js, 3);
?>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "08d6a40d-7987-4ac1-bd90-7d535189f1dd"});</script>
<?php //begin.Content ?>
<div class="grid-9 article">
	<?php //bagin.Picture and Share ?>
	<div class="grid-6 picture">
		<?php $baseUrl = Yii::app()->request->baseUrl.'/images/content/';
								$img = $model->images != '' ? $baseUrl . Content::model()->replaceSpaceWithUnderscore($model->content_categories->title).'/article_'.$model->images :
								$baseUrl . 'article_default_image.jpg'; ?>
		<img src="<?php echo $img?>" alt="" />
		<?php //bagin.Share ?>
		<div class="share">
			<div class="absolute">
				<div class="box">
					<span><strong>Share</strong></span>
					<div class="share-box">
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_email_large' displayText='Email'></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php //end.Picture and Share ?>
	<div class="clear"></div>

	<?php //bagin.Content ?>
	<div class="grid-6 content">
		<h2><?php echo $model->title ?></h2>
		<span class="date"><?php echo $model->content_categories->title; ?> | <?php echo date('d F Y H:i',strtotime($model->created));?>&nbsp;wib</span><br/>
		<strong><?php echo $model->intro_text ?></strong><br/>
		<?php echo $model->full_text ?>
	</div>
	<?php //end.Content ?>
	<?php //bagin.Article Related ?>
	<div class="grid-3 related last">
		<div class="boxed">
			<h3 class="rockwell">Artikel Terkait</h3>
			<div class="box">
           <?php
		   $id = $_GET['id'];
		   $cid= $model->content_categories_id; 
		   $related = Content::model()->findAll(array(
				'select' => 'id, content_categories_id, title, alias_url, intro_text, full_text, images ,created',
				'condition' => "section_id = 2 and published = 1 and id != $id and content_categories_id = $cid" , 			
				'limit'=>5,
				'order' => 'created DESC'
				)); ?>
            	<?php foreach($related as $key => $val){ ?>
				<div class="sep">
						<?php $baseUrl = Yii::app()->request->baseUrl.'/images/content/';
								$img = $val->images != '' ? $baseUrl . Content::model()->replaceSpaceWithUnderscore($val->content_categories->title).'/article_thumb_'.$val->images: $baseUrl . 'article_thumb_default_image.jpg'; ?>
					<img src="<?php echo $img?>" alt="<?php echo $val->images?>" />
					<a href="<?php echo Yii::app()->controller->createUrl('content/view',array("id"=>$val->id,'t'=> Utility::clearUrl($val->alias_url) )); ?>" title="<?php echo $val->title; ?>"><?php  echo  Utility::shortText($val->title,50) ?></a>
					<div class="clear"></div>
				</div>
                <?php } ?>
			</div>
		</div>
	</div>
	<?php //end.Article Related ?>
    <a href="http://localhost#disqus_thread" class="hide" id="<?php echo 'content'.$model->id ?>" data-disqus-identifier="content/view/<?php echo $model->id; ?>">Link</a>
	<div class="clear"></div>

	<?php //begin.Editorial ?>
	<div class="editorial">
		<span>Dilihat <?php echo $model->hits; ?> kali</span>
		Ditulis Oleh <strong><?php echo $model->modify_by->name; ?></strong>
		<div class="clear"></div>
	</div>
	<?php //end.Editorial ?>
    
    <div id="disqus_thread"></div>
	<script type="text/javascript">
		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		var disqus_shortname = 'sccpcr'; // required: replace example with your forum shortname
		var disqus_identifier = 'content/view/'+<?php echo $model->id; ?>;
		
		/* * * DON'T EDIT BELOW THIS LINE * * */
		(function() {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	<script type="text/javascript">
		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		var disqus_shortname = 'sccpcr'; // required: replace example with your forum shortname
		var disqus_identifier = 'content/view/'+<?php echo $model->id; ?>;
		
		/* * * DON'T EDIT BELOW THIS LINE * * */
		(function () {
			var s = document.createElement('script'); s.async = true;
			s.type = 'text/javascript';
			s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
			(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
		}());
	</script>

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
