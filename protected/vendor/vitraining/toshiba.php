<?php
/* TOSHIBA Sequences **********************************************************************
	example:

	[ESC] D0508, 0760, 0468 [LF] [NUL] 
	[ESC] T20C41 [LF] [NUL]
	[ESC] C [LF] [NUL]
	[ESC] RC000; ABC [LF] [NUL]
	[ESC] RC001; DEF [LF] [NUL]
	[ESC] XS; I, 0001, 0002C41000 [LF] [NUL]

	[ESC] LC: Sets the line format and draws it. 
	[ESC] PC: Sets the bit map font format.
	[ESC] RC: Draws bit map font data. 
	/* [ESC] RC: Provides data for the bit map font row.**************************************************
	􀁣 [ESC] RCaaa; bbb ------ bbb [LF] [NUL]
	􀁤 Link Field Data Command
	[ESC] RC; ccc ------ ccc [LF] ddd ------ ddd [LF] ------ [LF] xxx ------ xxx [LF] [NUL]

	aaa: Character string number
		000 to 199 (Two digits, 00 to 99, also acceptable.)
	bbb ------ bbb: Data string to be printed
		Max. 255 digits
		(Max. 127 digits when the font type is e, j, v, or w.)
		Any excess data will be discarded.
		For the character codes, refer to chapter 12 “CHARACTER CODE TABLE”.
	ccc ------ ccc: Data string of link field No. 1
	ddd ------ ddd: Data string of link field No. 2
	to
	xxx ------ xxx: Data string of link field No. 99
	***************************************************/
	/* $data .= ESC . 'RC'.
		// sprintf('%03d',  $i).';'.
		// sprintf('%13d',  $i). LF . NUL ;
	*/

	/* [ESC] RV: Draws outline font data. .**************************************************
	􀁣 [ESC] RVaa; bbb ------ bbb [LF] [NUL]
	􀁤 Link Field Data Command
	[ESC] RV; ccc ------ ccc [LF] ddd ------ ddd [LF] ------ [LF] xxx ------ xxx [LF] [NUL]

	aa: Character string number
		00 to 99
	bbb ------ bbb: Data string to be printed
		Max. 255 digits
		Any excess data will be discarded.
		For the character codes, refer to chapter 12 “CHARACTER CODE TABLE”.
	ccc ------ ccc: Data string of link field No. 1
	ddd ------ ddd: Data string of link field No. 2
	to
	xxx ------ xxx: Data string of link field No. 99
	*/
	/*$data .= ESC . 'RV'.
		sprintf('%02d',  $i+1).';'.
		sprintf('%013d',  $i). 
		LF . NUL ;
*******************************************************************************************/


defined('ESC') or define('ESC' , chr(27));
defined('LF') or define('LF'  , chr(0x0a));
defined('NUL') or define('NUL' , chr(0x00));
defined('CURR') or define('CURR', 'Rp.');

class BarcodePrinter {

	public function openPrinter(){
		$printername = 'zebra';
		$handle = printer_open($printername); 
		printer_set_option($handle, PRINTER_MODE, 'RAW');
		
		return $handle;
	}
	
	public function writePrinter($handle, $data){
		$ret = printer_write($handle, $data);
		return $ret;
	}
	
	public function closePrinter($handle){
		printer_close($handle);	
		//ss
	}


	/* [ESC] C: Clears the image buffer. **************************************************
		harus dipanggil setiap kali issue baru, supaya cleared buffer yang
		sebelumnya
	***************************************************************************************/
	public function clearBuffer(){
		$data = ESC . 'C' . LF . NUL ;
		return $data;
	}
		
	/* [ESC] PV: Sets the outline font format. ********************************************
		[ESC] PVaa; bbbb, cccc, dddd, eeee, f (, ghhh), ii, j (, Mk) (, lmmmmmmmmmm)
			(, Znn) (, Po) (=ppp------ppp) [LF] [NUL]
		[ESC] PVaa; bbbb, cccc, dddd, eeee, f (, ghhh), ii, j (, Mk) (, lmmmmmmmmmm)
			(, Znn) (, Po) (; qq1, qq2, qq3, ------, qq20) [LF] [NUL]
			
			
		aa: Character string number
			00 to 99
		bbbb: X-coordinate of the print origin of character string
			Fixed as 4 digits (in 0.1 mm units)
		cccc: Y-coordinate of the print origin of character string
			4 or 5 digits (in 0.1 mm units)
		dddd: Character width
			0020 to 0850 (in 0.1 mm units)
		eeee: Height of the character
			0020 to 0850 (in 0.1 mm units)
		f: Type of font
			A: TEC FONT1 (Helvetica [bold])
			B: TEC FONT1 (Helvetica [bold] proportional)
			E: Price Font 1
			F: Price Font 2
			G: Price Font 3
			H: DUTCH801 Bold (Times Roman Proportional)
			I: BRUSH738 Regular (Pop Proportional)
			J: GOTHIC725 Black (Proportional)
		ghhh: Fine adjustment of character-to-character space
			(Omissible. When omitted, the space is adjusted according to the
			designated font.)
			g: Designates whether to increase or decrease the character-to-character
			space.
				+: Increase
				−: Decrease
			hhh: No. of space dots between characters
				000 to 512 (in units of dots)
		ii: Rotational angles of a character and character string
			00: 0° (char.) 0° (char.-string)
			11: 90° (char.) 90° (char.-string)
			22: 180° (char.) 180° (char.-string)
			33: 270° (char.) 270° (char.-string)
		j: Character attribution
			B: Black character
			W (aabb): Reverse character
				aa: No. of dots from the character string to the end of the black
					background in the horizontal direction.
				bb: No. of dots from the character string to the end of the black
					background in the vertical direction.
				aa: 01 to 99 (in units of dots)
				bb: 01 to 99 (in units of dots)
			F (aabb): Boxed character
				aa: No. of dots from the character string area to the box in the
					horizontal direction.
				bb: No. of dots from the character string area to the box in the vertical
					direction.
				aa: 01 to 99 (in units of dots)
				bb: 01 to 99 (in units of dots)
			C (aa): Stroked out character
				aa: No. of dots from the character string area to the end of the stroke
				aa: 01 to 99 (in units of dots)
				* Parameter in parentheses are omissible.
				(If omitted, it is character size (the character width or height, whichever is
				greater) ÷ 8 dots.)
		Mk: Type of the check digit to be attached
			(Omissible. When omitted, the check digit is not drawn.)
			k: Type of check digit
				0: Modulus 10 (Draws data and check digit)
				1: Modulus 43 (Draws data and check digit)
				2: DBP Modulus 10 (Draws check digit only)
		lmmmmmmmmmm: Increment and decrement
			(Omissible. When omitted, incrementing/decrementing is not
			performed.)
			l: Designates whether to increment or decrement.
				+: Increment
				−: Decrement
			mmmmmmmmmm: Skip value
			0000000000 to 9999999999
		Znn: Zero suppression
			(Omissible. When omitted, zero suppression is not performed.)
			nn: No. of digits after zero suppression
			00 to 20		
		
		Po: Alignment (Omissible. When omitted, the alignment is set to the left.)
			o: Designates the character position.
			1: Left
			2: Center
			3: Right
			4aaaa: Justification
				aaaa: X direction of character string area
				0050 to 1040 (in 0.1 mm units)
		ppp------ppp: Data string to be printed (Omissible)
			Max. 255 digits
		qq1, qq2, qq3, ------, qq20: Link field No. (Omissible)
			01 to 99 (1 to 99 can also be used.)
			Up to 20 fields can be designated using commas.
	***************************************************************************************/
	public function addText($i, $x, $y, $text, $reverse=false, $width=20, $height=20, 
		$spacing='+000', $rotation='00'){
		$data = ESC . 'PV'.
			sprintf('%02d', $i).';'. 		//aa
			sprintf('%04d', $x).','.		//bbbb
			sprintf('%04d', $y).','.		//cccc
			sprintf('%04d', $width).','.	//dddd
			sprintf('%04d', $height).','.	//eeee
			'A,'.							//f
			$spacing . ','.					//ghhh
			$rotation . ','.				//ii
			($reverse?'W':'B').				//j
			'='.$text.						//ppp------ppp
			LF . NUL ;
		return $data;
	}
	
	/* [ESC] XB: Sets the bar code format.**************************************************
		[ESC] XBaa; bbbb, cccc, d, e, ff, k, llll (, mnnnnnnnnnn, ooo, p, qq)
			(= sss ------ sss) [LF] [NUL]
		[ESC] XBaa; bbbb, cccc, d, e, ff, k, llll (, mnnnnnnnnnn, ooo, p, qq)
			(; tt1, tt2, tt3, ------, tt20) [LF] [NUL]
		aa: Bar code number
			00 to 31
		bbbb: X-coordinate of the print origin of bar code
			Fixed as 4 digits (in 0.1 mm units)
		cccc: Y-coordinate of the print origin of bar code
			4 or 5 digits (in 0.1 mm units)
		d: Type of bar code
			0: JAN8, EAN8
			5: JAN13, EAN13
			6: UPC-E
			7: EAN13 + 2 digits
			8: EAN13 + 5 digits
			9: CODE128 (with auto code selection)
			A: CODE128 (without auto code selection)
			C: CODE93
			G: UPC-E + 2 digits
			H: UPC-E + 5 digits
			I: EAN8 + 2 digits
			J: EAN8 + 5 digits
			K: UPC-A
			L: UPC-A + 2 digits
			M: UPC-A + 5 digits
			N: UCC/EAN128
			R: Customer bar code (Postal code for Japan)
			S: Highest priority customer bar code (Postal code for Japan)
			U: POSTNET (Postal code for U.S)
			V: RM4SCC (ROYAL MAIL 4 STATE CUSTOMER CODE)
			(Postal code for U.K)
			W: KIX CODE (Postal code for Belgium)
		e: Type of check digit
			1: Without attaching check digit
			2: Check digit check
				WPC Modulus 10
				CODE93 Modulus 47
				CODE128 PSEUDO 103
			3: Check digit automatic attachment (1)
				WPC Modulus 10
				CODE93 Modulus 47
				CODE128 PSEUDO 103
				UCC/EAN128 Modulus 10 + Modulus 103
				Customer code Special check digit
				POSTNET Special check digit
				RM4SCC Special check digit
			4: Check digit automatic attachment (2)
				WPC Modulus 10 + Price C/D 4 digits
			5: Check digit automatic attachment (3)
				WPC Modulus 10 + Price C/D 5 digits
				* For the Customer bar code, POSTNET, and RMC4SCC, only “3:
				Check digit auto attachment (1)” is effective.
		ff: 1-module width
			01 to 15 (in units of dots)
		k: Rotational angle of bar code
			0: 0°
			1: 90°
			2: 180°
			3: 270°
		llll: Height of the bar code
			0000 to 1000 (in 0.1 mm units)
			For the Customer bar code, POSTNET, RMC4SCC, and KIX CODE, the
			height of the long bar is specified.
		mnnnnnnnnnn: Increment/decrement
			(Omissible. When omitted, incrementing/decrementing is not
			performed.)
			m: Indicates whether to increment or decrement
				+: Increment
				−: Decrement
			nnnnnnnnnn: Skip value
				0000000000 to 9999999999
		ooo: Length of WPC guard bar
			(Omissible. When omitted, the guard bar is not extended.)
			000 to 100 (in 0.1 mm units)
		p: Selection of print or non-print of numerals under bars
			(Omissible. When omitted, the numerals under the bars are not printed.)
			0: Non-print
			1: Print
		qq: No. of digits after zero suppression
			(Omissible. When omitted, zero suppression is not performed.)
			00 to 20
		sss ------ sss: Data string to be printed (Omissible)
			Max. 126 digits. However, it varies depending on the type of bar code.
		tt1, tt2, tt3, ------. tt20: Link field No. (Omissible)
			01 to 99 (1 to 99 can also be used.)
			Up to 20 fields can be designated using commas.
	***************************************************************************************/
	
	public function setBarcodeFormat($i, $x, $y, $bar_width, $rotation, $bar_height){
		$data = ESC . 'XB'.
			sprintf('%02d', $i).';'.				//aa
			sprintf('%04d', $x).','.				//bbbb
			sprintf('%04d', $y+10) .','.			//cccc
			'9,'.									//d
			'2,'.									//e
			sprintf('%02d', $bar_width).','.		//ff
			sprintf('%d',   $rotation).',' . 		//k
			sprintf('%04d', $bar_height) . 			//llll
			LF . NUL ;
		return $data;
	}
	
	/* [ESC] D:Sets the label size ********************************************************
		[ESC] Daaaa, bbbb, cccc (, dddd) [LF] [NUL]
		aaaa: Pitch length of the label or tag
			4 and 5 digits (in 0.1 mm units)
			4 digits: 0100 (10.0 mm) to 9999 (999.9 mm)
			5 digits: 00100 (10.0 mm) to 09990 (999.0 mm)
		bbbb: Effective print width
			Fixed as 4 digits (in 0.1 mm units)
			0100 (10.0 mm) to 1057 (105.7 mm)
		cccc: Effective print length
			4 and 5 digits (in 0.1 mm units)
			4 digits: 0060 (6.0 mm) to 9970 (997.0 mm)
			5 digits: 00060 (6.0 mm) to 09970 (997.0 mm)
		dddd: Backing paper width
			(Omissible. When omitted, the initial value is used as the effective print
			width.)
			Fixed as 4 digits (in 0.1 mm units)
			0300 (30.0 mm) to 1120 (112.0 mm)
	***************************************************************************************/
	public function setLabelSize($label_length, $paper_width, $eff_print_length){
		$data = ESC . 'D'. 
			sprintf('%04d', $label_length).','.
			sprintf('%04d', $paper_width).','.
			sprintf('%04d', $eff_print_length) . 
			LF . NUL ;
		return $data;
	}
	
	/* [ESC] AX:Adjusts the feed amount, cut position, and back feed amount.***************
		[ESC] AX; abbb, cddd, eff [LF] [NUL]

		a: Indicates the direction of the print start position fine adjustment
			+: Front
			−: Behind
		bbb: Fine adjustment value
			000 to 500 (in 0.1 mm units)
		c: Indicates the direction of the cut position (or strip position) fine adjustment
			+: Front
			−: Behind
		ddd: Fine adjustment value
			000 to 500 (in 0.1 mm units)
		e: Indicates whether the reverse feed amount is to be increased or decreased.
			+: Increase
			−: Decrease
		ff: Reverse feed amount fine adjustment value
			00 to 99 (in 0.1 mm units)
	***************************************************************************************/
	public function setFeedAmount(){
		$data = ESC . 'AX;+000,+000,+00' . LF . NUL ;
		return $data;
	}
	
	/* [ESC] AY: Adjusts the print density.************************************************
		[ESC] AY; abb, c [LF] [NUL]

		a: Indicates whether to increase or decrease the density.
			+: Increase (darker)
			−: Decrease (lighter)
		bb: Print density fine adjustment value
			00 to 10 (in units of 1 step)
		c: Indicates the print mode (thermal transfer or direct thermal)
			0: Thermal transfer
			1: Direct thermal
	***************************************************************************************/
	public function setPrintDensity($density='+00', $thermal='1'){
		$data = ESC . 'AY;'.$density.','.$thermal . 
			LF . NUL ;
		return $data;
	}
	
	/* [ESC] T: Feeds one label to align with the print  start position.*******************
		[ESC] Tabcde [LF] [NUL]

		a: Type of sensor
			0: No sensor
			1: Reflective sensor
			2: Transmissive sensor
			3: Transmissive sensor (when using manual threshold value)
			4: Reflective sensor (when using manual threshold value)
		b: Cut or non-cut
			0: Non-cut
			1: Cut
		c: Feed mode
			C: Batch mode (Cut and feed when “1 (Cut)” is selected for parameter b.)
			D: Strip mode (with reverse feed)
			E: Strip mode (with reverse feed, the strip sensor is ignored, supporting an
			applicator.)
		d: Feed speed
			2: 2 ips
			4: 4 ips
			6: 6 ips
		e: Use of ribbon
			0: No ribbon
			1: Ribbon is used.
			2: Ribbon is used.
	***************************************************************************************/
	public function alignStartPosition(){
		$data = ESC . 'T10C41' . LF . NUL ;
		return $data;
	}

	/* [ESC] XS: Issues (prints) the label. ***********************************************

		[ESC] XS; I, aaaa, bbbcdefgh [LF] [NUL]

		aaaa: Number of labels to be issued
			0001 to 9999
		bbb: Cut interval. Designates the number of pieces to be printed before a cut
			operation is performed.
			000 to 100 (000 when no cut)
		c: Type of sensor
			0: No sensor
			1: Reflective sensor
			2: Transmissive sensor
			3: Transmissive sensor (when using manual threshold value)
			4: Reflective sensor (when using manual threshold value)
		d: Issue mode
			C: Batch mode
			D: Strip mode (with reverse feed, the strip sensor is activated.)
			E: Strip mode (with reverse feed, the strip sensor is ignored,
			supporting an applicator.)
		e: Print speed
			2: 2 ips
			4: 4 ips
			6: 6 ips
		f: Use of ribbon
			0: No ribbon
			1: Ribbon is used.
			2: Ribbon is used.
		g: Print orientation and mirror printing
			0: Bottom first printing
			1: Top first printing
			2: Bottom first mirror printing
			3: Top first mirror printing
		h: Type of status response
			0: No status response
			1: Status response is returned.
	***************************************************************************************/
	public function issueLabel(){
		$data = ESC . 'XS;I,'.
			'0001,'.						//aaaa
			'000'.							//bbb
			'1'.							//c
			'C'.							//d
			'2'.							//e
			'1'.							//f
			'1'.							//g
			'1'.							//h 
			LF . NUL ; 
			
		return $data;
	}	


	/* 	[ESC] RB: Draws bar code data. ****************************************************
	
		[ESC] RBaa; bbb ------ bbb [LF] [NUL]
		
		Link Field Data Command
		[ESC] RB; ccc ------ ccc [LF] ddd ------ ddd [LF] ------ [LF] xxx ------ xxx [LF] [NUL]	
		
		aa: Bar code number
			00 to 31
		bbb ------ bbb: Data string to be printed
			The maximum number of digits varies according to the type of bar code.
		ccc ------ ccc: Data string of link field No. 1
		ddd ------ ddd: Data string of link field No. 2
		to
		xxx ------ xxx: Data string of link field No. 99
	***************************************************************************************/
	public function drawBarcode($i, $barcode){
		$data = ESC . 'RB'.
			sprintf('%02d',  $i).';'.
			$barcode .
			//sprintf('%13s', $barcode). 
			LF . NUL ;
		return $data;
	}
	
	
	public function send($products, $shopname='', $company_name =''){
		//var_dump($_SERVER['HTTP_USER_AGENT']);
			
		/* open printer: ********************************************************
		 WIN32 must be a generic printer driver
		 LINUX /dev/usb00
		*************************************************************************/
		$handle = $this->openPrinter();
		
		$label_length     = 180;
		$eff_print_length = 150;
		$label_width      = 320;
		$paper_width      = 960;
		$label_column     = 3;
		$x_margin         = 5;

		$bar_height       = 60;
		$bar_width        = 2;		

		$data = '';
		$header_data = '';

		$header_data .= $this->setLabelSize($label_length, $paper_width, $eff_print_length);
		
		$header_data .= $this->setFeedAmount();

		$header_data .= $this->setPrintDensity() ;

		$header_data .= $this->alignStartPosition();

		$header_data .= $this->clearBuffer();

		/* repeat **************************************************
		repeat print barcode
		************************************************************/

		$data = $header_data;
		$y = 0;
		$x = 0;
		$k = 0; // product_index  0 1 2 3 4 5 ...
		$i = 0; //label index ... 0 1 2   0 1 2 ..
		
		$ret = '';
		foreach($products as $j=>$p){
			$nama  = ucwords(substr($p->name,0,25))  ;
			$harga = CURR . number_format($p->list_price,0)  ;
			$ean13 = $p->ean13  ;
			$barcode = $p->default_code  ;
			
			$ret .= $k . ' ' . $i . " ";
			$ret .= $nama . " ";
			$ret .= $harga. " ";
			$ret .= $ean13. " ";
			$ret .= $barcode. "\n";

			if ($k>0 && ($k % ($label_column) == 0) ){

				$data .= $this->issueLabel();
				$data .= $this->clearBuffer();

				$x = 0;
				$y = 0;	
				$i = 0;
			}
			
			$x = $i * $label_width + $x_margin;
			
			$rotation   = 0;
			
			$data .= $this->setBarcodeFormat($i, $x, $y, $bar_width, $rotation, $bar_height);
				
			$data .= $this->drawBarcode($i, $barcode);

		
			/* $i, $x, $y, $text, $reverse=false, $width=20, $height=20, $spacing='+000', $rotation='00' */
			/********* barcode number *******/
			$data .= $this->addText(5*$i+1, $x, $y+1.5*$bar_height, $barcode,false,20,20,'-005');
			
			/********* harga ****************/
			$data .= $this->addText(5*$i+2, $x, $y+2*$bar_height, $harga,false,20,20,'-005');

			/********* nama barang **********/
			$data .= $this->addText(5*$i+3, $x, $y+2.5*$bar_height, $nama,false,20,20,'-010');

			/********* shop name ************/
			$x = $label_width * ($i+1) - 55;
			$data .= $this->addText(5*$i+4, $x, $y, $shopname, false, 10,20,'-002','11');
				
			/********* COMPANY **************/
			$x = $label_width * ($i+1) - 25;
			$data .= $this->addText(5*$i+5, $x, $y, $company_name, true, 20,20,'-002','11');

			$i++;
			$k++;
			
		}
		
		$data .= $this->issueLabel();
		
		//echo $data;
		
		$ret = $this->writePrinter($handle, $data);
		
		$this->closePrinter($handle);

		return $ret;
	}
	
					
}


?>