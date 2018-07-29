<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
    'encodeHeading'=>false,
    //'headingOptions'=>array('align'=>'center'),
)); ?>

<br>

<?php if (!isset(Yii::app()->session['session_id'])) : ?>
    <?php if (Yii::app()->user->id) : ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'New Session',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/session/create')
    )); ?>
    <?php endif; ?>
<?php else: ?>
    <?php 
    $session = Session::model()->findByPk(Yii::app()->session['session_id']);
    ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'New Order',
        'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/order/create')
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close Active Session [' . $session->name . ']' ,
        'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'htmlOptions'=>array('onclick'=>'return confirm("Close current session?")'),
        //'url'=>bu('/session/close')
        'url'=>bu('/session/closingControl/'.$session->id)
    )); ?>

<?php endif; ?>

<?php if (Yii::app()->user->id) : ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Run Automatic Sync',
        'type'=>'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url'=>bu('/session/autopost'),
        'buttonType'=>'link',
        'htmlOptions'=>array(
            'target'=>"_new"
        ),    
    )); ?>
<?php endif; ?>

<?php $this->endWidget(); ?>

    <h2>Settings Checklist</h2>
    <p>Configuration and Settings Checklist in order this software to work</p>

    <ul>
        <li>Install the standard POS (Point Of Sale) modul on the OpenERP database</li>
        <li>Install <b><a href="addons/vit_opos.zip">vit_opos</a></b> or <b><a href="addons/vit_opos_v8.zip">vit_opos_v8</a></b> addon module on OpenERP 7 / Odoo 8 database. It will:</li>
        <ul>
            <li>add product account related fields (stock valuation, income , expense account) for syncing</li>
            <li>add POS journal</li>
            <li>add account.move shop_id field </li>
            <li>add stock.move shop_id field </li>
        </ul>

        <!--li>Install vit_sync_master modul on OpenERP database</li>
        <ul>
            <li>add account.move shop_id field </li>
            <li>add stock.move shop_id field </li>
        </ul-->
        
        <li>From the <b>Administration > App Setting</b> menu, set the POS relation AppSetting
            <ul>
                <li>shop_id = database ID of this Shop</li>
                <li>shop_name = name of this Shop to appear in the slip</li>
                <li>pos_journal_id = POS Journal ID created by vit_opos module</li>
                <li>pos_config_id = POS ID for this point of sales</li>
            </ul>
        </li>
        
        <li>Connection AppSetting 
            <ul>
                <li>openerp_server = OpenERP server XML-RPC address, eg http://127.0.0.1/xmlrpc/ </li>
                <li>openerp_database = OpenERP database name</li>
                <li>oe_summary_mode  = [0|1] operation mode: summary or detail per POS order</li>
                <li>auth_oe  = [0|1] authentication mode: online to OpenERP or locat database</li>
            </ul>
        </li>


        <li>Accounts AppSetting
            <ul>
                <li>other_income_coa_id = Other Income Account ID for this point of sales</li>
                <li>discount_account_id = Discount Account ID for this point of sales</li>
                <li>ppn_account_id = VAT Account ID for this point of sales</li>
                <li>ar_account_id = Receivable Account ID for this point of sales, if oe_summary_mode = 0</li>
            </ul>
        </li>

        <li>Locations AppSetting
            <ul>
                <li>source_location_id = Source Location ID for this point of sales</li>
                <li>dest_location_id = Destination Location ID for this point of sales</li>
            </ul>
        </li>

    </ul>


    <h2>Sync do be done at first</h2>
    <p>Before using OPOS, you must first download initial data from OpenERP in this order:</b>
    <ul>
        <li>Sync User from <b>Administration > User</b> menu</li>
        <li>Sync Account from <b>Administration > COA </b> menu</li>
        <li>Sync Payment Type from <b>Administration > Payment Type</b> menu, first set it as "PoS Payment Method" in OpenERP</li>
        <!-- <li>Sync Product from <b>Product</b> menu</li> -->
    </ul>
    <p>
        Please consider decreasing the App Settings: 
        product_last_sync, payment_type_last_sync, account_last_sync, and user_last_sync 
        date values if you find a message like "No newer PaymentType found than yyyy-mm-dd hh:ii:ss"
    </p>
