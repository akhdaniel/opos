<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
</head>

<body>

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
                array('label'=>'Session', 
                    'icon'=>'book', 
                    'url'=>array('/session'), 
                    'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->group_name == GROUP_CASHIER || Yii::app()->user->group_name == GROUP_ADMIN),
                    'active'=>$this->uniqueid=='session'),
                array('label'=>'Order List', 
                    'icon'=>'list', 
                    'url'=>array('/restoOrder/kitchen'), 
                    'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_KITCHEN,
                ),
                array('label'=>'Product List', 
                    'icon'=>'list', 
                    'url'=>array('/restoOrder/productList'), 
                    'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_KITCHEN,
                ),
                array('label'=>'Resto Order', 
                    'icon'=>'pencil',
                    'url'=>array('/restoOrder'), 
                    'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_WAITER,
                    'active'=>$this->uniqueid=='restoOrder'),
                array('label'=>'Order', 
                    'icon'=>'pencil',
                    'url'=>array('/Order'), 
                    'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->group_name == GROUP_CASHIER || Yii::app()->user->group_name == GROUP_ADMIN),
                    'active'=>$this->uniqueid=='order'),
                array('label'=>'Product', 
                    'icon'=>'th', 
                    'url'=>array('/product'), 
                    'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->group_name == GROUP_CASHIER || Yii::app()->user->group_name == GROUP_ADMIN),
                    'active'=>$this->uniqueid=='product'),

               /* array('label'=>'Report', 
                    'icon'=>'file', 
                    'url'=>'#', 
                    'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->group_name == GROUP_CASHIER || Yii::app()->user->group_name == GROUP_ADMIN),
                    'items'=>array(
                        array('label'=>'Report per Category', 
                            'icon'=>'file', 
                            'url'=>array('/session/reportCategory'), 
                            'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->group_name == GROUP_CASHIER || Yii::app()->user->group_name == GROUP_ADMIN),
                            'active'=>$this->uniqueid=='reportCategory'
                        ),
                        array('label'=>'Report per Product', 
                            'icon'=>'file', 
                            'url'=>array('/session/reportProduct'), 
                            'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->group_name == GROUP_CASHIER || Yii::app()->user->group_name == GROUP_ADMIN),
                            'active'=>$this->uniqueid=='appSetting'
                        ),
                        array('label'=>'Report per Payment', 
                            'icon'=>'file', 
                            'url'=>array('/session/reportPayment'), 
                            'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->group_name == GROUP_CASHIER || Yii::app()->user->group_name == GROUP_ADMIN),
                            'active'=>$this->uniqueid=='account'
                        ),
                    ),
                ),
*/
                array('label'=>'Administration', 
                    'icon'=>'cog', 
                    'url'=>'#', 
                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_ADMIN),
                    'items'=>array(
                        array('label'=>'Payment Type', 
                            'icon'=>'cog', 
                            'url'=>array('/paymentType'), 
                            'visible'=>(!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_ADMIN),
                            'active'=>$this->uniqueid=='paymentType'
                        ),
                        array('label'=>'App Setting', 
                            'icon'=>'cog', 
                            'url'=>array('/appSetting'), 
                            'visible'=>(!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_ADMIN),
                            'active'=>$this->uniqueid=='appSetting'
                        ),
                        array('label'=>'COA', 
                            'icon'=>'file', 
                            'url'=>array('/account'), 
                            'visible'=>(!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_ADMIN),
                            'active'=>$this->uniqueid=='account'
                        ),
                        array('label'=>'User', 
                            'icon'=>'user', 
                            'url'=>array('/user'), 
                            'visible'=>(!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_ADMIN),
                            'active'=>$this->uniqueid=='user'
                        ),
                    ),
                ),
                
                array('label'=>'Versioning', 
                    'icon'=>'cog', 
                    'url'=>array('/versioning'), 
                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->user->group_name == GROUP_ADMIN),
                    'active'=>$this->uniqueid=='versioning'),

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

<div class="container" id="page">

    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php

    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    ));         
    ?>
    
    <?php echo $content; ?>

    <div class="clear"></div>

    <hr/>
    
    <footer>
        <div class="row">
            <div class="span6">
                <?php
                // $svn = new phpsvnclient(SVN_URL,'prog1','1234');
                // $ver = $svn->getVersion();
                // echo $ver;
 
                ?>
                Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                All Rights Reserved.<br/>
            </div>
            <div class="span6">
                <?php echo oeInfo() ?>
                <br>
            </div>
        </div><!-- footer -->
    </footer>

</div><!-- page -->

</body>
</html>