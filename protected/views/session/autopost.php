<?php

if($oe_summary_mode==0){
	cs()->registerScript('postOrders',"
	var interval = " . $autopost_interval . "* 60 * 1000; //5 menit 
	setTimeout(executeQuery, interval);

	function executeQuery(){
	    $.ajax({
	        url: '". bu('/order/recreateUnpostedOeOrders?cron=1&limit=10') ."',
	        dataType: 'json',
	        success: function(data) {
	            var log = data.status + ': ' + data.msg + '<br>';
	        	$('#log').html(log);
	        },

	    });
	    setTimeout(executeQuery, interval); // you could choose not to continue on failure...
	}
"); 
}

cs()->registerScript('syncProduct',"
var interval = " . ($autopost_interval+1) . "* 60 * 1000; //5 menit 
setTimeout(syncProduct, interval);

function syncProduct(){
    $.ajax({
        url: '". bu('/product/sync?cron=1') ."',
        dataType: 'json',
        success: function(data) {
            var log = data.status + ': ' + data.msg + '<br>';
        	$('#log').html(log);
        },

    });
    setTimeout(syncProduct, interval); // you could choose not to continue on failure...
}
"); 

cs()->registerScript('syncZeroUom',"
var interval = " . ($autopost_interval/3) . "* 60 * 1000; //5 menit 
setTimeout(syncZeroUom, interval);

function syncZeroUom(){
    $.ajax({
        url: '". bu('/product/syncZeroUom?cron=1') ."',
        dataType: 'json',
        success: function(data) {
            var log = '[syncZeroUom] ' + data.status + ': ' + data.msg + '<br>';
        	$('#log').html(log);
        },

    });
    setTimeout(syncZeroUom, interval); // you could choose not to continue on failure...
}
"); 

?>
<h1>Automatic Sync Products and Post Orders</h1>
<div id="log">
</div>