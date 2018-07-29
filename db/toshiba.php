<?php

/*
TOSHIBA Sequences

example:
[ESC] D0508, 0760, 0468 [LF] [NUL] 
[ESC] T20C41 [LF] [NUL]
[ESC] C [LF] [NUL]
[ESC] RC000; ABC [LF] [NUL]
[ESC] RC001; DEF [LF] [NUL]
[ESC] XS; I, 0001, 0002C41000 [LF] [NUL]





[ESC] D:Sets the label size.
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
	(Omissible. When omitted, the initial value is used as the effective print width.)
	Fixed as 4 digits (in 0.1 mm units) 0300 (30.0 mm) to 1120 (112.0 mm)


[ESC] AX:Adjusts the feed amount, cut position, and back feed amount.

[ESC] AY: Adjusts the print density.

[ESC] T: Feeds one label to align with the print start position.

[ESC] C: Clears the image buffer. 

[ESC] LC: Sets the line format and draws it. 

[ESC] PC: Sets the bit map font format.

[ESC] PV: Sets the outline font format. 

[ESC] XB: Sets the bar code format.

[ESC] RC: Draws bit map font data. 

[ESC] RV: Draws outline font data. 

[ESC] RB: Draws bar code data. 

[ESC] XS: Issues (prints) the label.

*/

//open printer
$printername = 'zebra';
$handle = printer_open($printername); //or it could be \\pcname\printername
//set printing option to raw
printer_set_option($handle, PRINTER_MODE, 'RAW');
 
//write data to printer
$esc = chr(27);
$lf  = chr(0x0a);
$nul = chr(0x00);

$data = '';
$data .= $esc . 'D0508,0760,0468' . $lf . $nul ;
$data .= $esc . 'T20C41' . $lf . $nul ;
//repeat:
$data .= $esc . 'C' . $lf . $nul ;
$data .= $esc . 'XB00, 0100, 0100, 9, 1, 01, 0, 0100' . $lf . $nul ;
$data .= $esc . 'RB01; DEF' . $lf . $nul ;
$data .= $esc . 'XS; I, 0001, 0002C41000' . $lf . $nul ; 
$ret = printer_write($handle, $data);
printer_close($handle);

?>