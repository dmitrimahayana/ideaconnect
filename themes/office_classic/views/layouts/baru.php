<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?php echo CHtml::encode($this->pageTitle); ?> | <?php echo CHtml::encode(Yii::app()->name); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php /* <meta name="keywords" content="<?php echo CHtml::encode($this->pageMeta); ?>" />
  <meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />*/ ?>
    <meta name="author" content="Nirwasita Studio" />
    <script type="text/javascript">
        var baseUrl = '<?php echo BASEURL;?>';
    </script>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl?>/favicon.ico" />
</head>
<body>

            <div>
                <?php echo $content; ?>
            </div>


</body>
</html>
