<?php
	$this->pageTitle = "Halaman tidak ditemukan";
?>
	<?php //begin.404 page ?>
	<div class="boxed">	
		<img class="image404" src="<?php echo Yii::app()->request->baseUrl;?>/images/resource/404_jigsaw.png" title="404 error page" />
	
	<div class="center">
		<h2>Maaf, halaman yang Anda cari tidak ditemukan.</h2><br/>
<p class="larger-px"><a href="javascript:history.go(-1)">Kembali ke halaman sebelumnya</a> atau kembali ke <a href="<?php echo Yii::app()->request->baseUrl?>">halaman muka</a> untuk memulai berselancar dari sana.
<br/><br/>
Bantu laporkan link yang putus ke <a href="<?php echo Yii::app()->request->baseUrl?>/contact/pcr-carrer-center-politeknik-riau?=">tim support</a> kami.
</p><br/><br/>
	</div>
</div>
	<?php //end.404 page ?>
<?php if($_SERVER["HTTP_HOST"] =='localhost' || $_SERVER['SERVER_ADDR'] =='192.168.1.250') {	//in localhost or testing condition?>
			<h2>Error <?php echo $code; ?></h2>
			<div class="error">
			<?php echo CHtml::encode($message); ?>
			</div>
<?php } ?>

<h2>Error <?php echo $code; ?></h2>
			<div class="error">
			<?php echo CHtml::encode($message); ?>
			</div>
