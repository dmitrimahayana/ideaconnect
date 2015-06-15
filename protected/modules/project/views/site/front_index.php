<?php //begin.Page Title ?>
<h1>Passion, ideas, and ambition abound. Start exploring!</h1>
<?php //end.Page Title ?>

<?php //begin.Filter ?>
<?php if(isset($_GET['sort'])) {?>
<div class="filter">
	<ul class="clearfix">
		<li <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'new-project') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'new-project'));?>" title="New Project">New Project</a></li>
		<li <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'popular') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'popular'));?>" title="Popular">Popular</a></li>
		<li <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'staf-choice') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'staf-choice'));?>" title="Staf Choice">Staf Choice</a></li>
		<li <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'most-founded') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'most-founded'));?>" title="Most Founded">Most Founded</a></li>
		<li <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'time-ticking') ? 'class="active"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'time-ticking'));?>" title="Time is Ticking">Time is Ticking</a></li>
	</ul>
</div>
<?php }?>
<?php //begin.Filter ?>

<?php if(!isset($_GET['sort'])) {?>
	<?php //begin.New Project ?>
	<div class="boxed new">
		<h2>New Project</h2>
		<div class="list-view clearfix">
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
		</div>
		
		<?php //begin.See more ?>
		<div class="seemore"><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'new-project'));?>" title="">see all</a></div>
		<?php //end.See more ?>
	</div>
	<?php //end.New Project ?>

	<?php //begin.Popular Project ?>
	<div class="boxed popular">
		<h2>Popular</h2>
		<div class="list-view clearfix">
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
		</div>
		
		<?php //begin.See more ?>
		<div class="seemore"><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'popular'));?>" title="">see all</a></div>
		<?php //end.See more ?>
	</div>
	<?php //end.Popular Project ?>

	<?php //begin.Staf Choice ?>
	<div class="boxed staf-choice">
		<h2>Staf Choice</h2>
		<div class="list-view clearfix">
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
		</div>
		
		<?php //begin.See more ?>
		<div class="seemore"><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'staf-choice'));?>" title="">see all</a></div>
		<?php //end.See more ?>
	</div>
	<?php //end.Staf Choice ?>

	<?php //begin.Most Founded ?>
	<div class="boxed most-founded">
		<h2>Most Founded</h2>
		<div class="list-view clearfix">
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
		</div>
		
		<?php //begin.See more ?>
		<div class="seemore"><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'most-founded'));?>" title="">see all</a></div>
		<?php //end.See more ?>
	</div>
	<?php //end.Most Founded ?>

	<?php //begin.Time is Ticking ?>
	<div class="boxed time-ticking">
		<h2>Time is Ticking</h2>
		<div class="list-view clearfix">
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
		</div>
		
		<?php //begin.See more ?>
		<div class="seemore"><a href="<?php echo Yii::app()->controller->createUrl('site/index', array('sort'=>'time-ticking'));?>" title="">see all</a></div>
		<?php //end.See more ?>
	</div>
	<?php //end.Time is Ticking ?>

<?php } else {?>
	<?php //begin.All Project ?>
	<div class="boxed">
		<div class="list-view clearfix">
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>

			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>


			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 100%;">Success</div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
			<div class="sep">
				<?php //begin.Photo and Category ?>
				<div class="photo">
					<a href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">
						<span>Product</span>
						<img src="<?php echo Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/project/project_default.jpg', 120, 160, 1);?>" alt="">
					</a>
					<div>by <a href="" title="Putra Sudaryanto">Putra Sudaryanto</a></div>
				</div>
				<?php //end.Photo and Category ?>
				<?php //begin.Content ?>
				<div class="content">
					<?php //begin.Progress ?>
					<div class="progress">
						<div style="width: 45%;"></div>
					</div>
					<?php //end.Progress ?>
					<?php //begin.Information ?>
					<div class="info">
						<div class="percent">
							<span><strong>100</strong>%</span>
							Rp <strong>90.000.000</strong>
						</div>
						<span>5/5</span><br/>
						<strong>45</strong> sponsor <br />
						<strong>33</strong> hari lagi	
					</div>
					<?php //end.Information ?>
					<a class="title" href="<?php echo Yii::app()->controller->createUrl('site/view');?>" title="">Lorem ipsum dolor sit amet, metus eget dolor</a>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
				</div>
				<?php //end.Content ?>
			</div>
		</div>
	</div>
	<?php //end.All Project ?>

<?php }?>
