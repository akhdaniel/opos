<?php 
defined('ESC') or define('ESC' , chr(27));
defined('LF') or define('LF'  , chr(0x0a));
defined('NUL') or define('NUL' , chr(0x00));

class PosPrinter {
	var $printername ;

	function __construct($printername = 'pos' ) {
	   $this->printername = $printername;
	}

	public function openPrinter(){
		$handle = printer_open($this->printername); 
		printer_set_option($handle, PRINTER_MODE, 'TEXT');		
		return $handle;
	}
	
	public function writePrinter($handle, $data){
		$ret = printer_write($handle, $data);
		return $ret;
	}
	

	public function closePrinter($handle){
		printer_close($handle);	
	}

	public function send($data, $shopname='', $company_name =''){
		$handle = $this->openPrinter();
		$ret = $this->writePrinter($handle, $data);		
		$this->closePrinter($handle);
		return $ret;
	}
}