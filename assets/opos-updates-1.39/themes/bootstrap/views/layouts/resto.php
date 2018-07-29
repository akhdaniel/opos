<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/keypad.less"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/resto-style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-box.css" />
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/less-1.3.0.min.js" type="text/javascript"></script>
</head>

<body>
   <!--  <div class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-inner">
                <div class="span5">
                   
                </div>

                <div class="span7">
                    <ul class="nav">
                        <li class="divider-vertical"/>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->

    <?php 
$as = AppSetting::model()->findOrCreate('major_version','1');
$major_version = $as->val;

$as = AppSetting::model()->findOrCreate('minor_version','0');
$minor_version = $as->val;
$v = "v".$major_version . "." . $minor_version;

$this->widget('bootstrap.widgets.TbNavbar',array(
    //'type'=>'inverse', // null or 'inverse'
    'brand'=>CHtml::image(bu().'/images/vitraining.png') . ' <small>OPOS ' . $v . '</small>',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 
                    'icon'=>'home',
                    'url'=>array('/site/index'), 
                    'visible'=>!Yii::app()->user->isGuest,
                    'active'=>($this->uniqueid=='site' &&  $this->action->id=='index')),

                array('label'=>'Login', 
                    'icon'=>'user', 
                    'url'=>array('/site/login'), 
                    'visible'=>Yii::app()->user->isGuest, 
                    'active'=>($this->uniqueid=='site' &&  $this->action->id == 'login') ),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 
                    'icon'=>'user', 
                    'url'=>array('/site/logout'), 
                    'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Uploading...', 
                    'htmlOptions',array('id'=>'status'),
                    'icon'=>'cog', 
                    'url'=>'#', 
                    'visible'=>false
                ),
            ),
        ),
    ),
)); ?>

    <div class="container-fluid" id="page">
        <?php echo $content; ?>
    </div>
</body>
</html>