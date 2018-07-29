String s = "{D0920,0870,0800,0900|}"+ //                                      
    "{AX;+000,+000,+00|}"+ //                           
    "{AY;+01,1|}"+ //                              
    "{C|}"+//
    "{PV01;0350,0010,0025,0060,J,11,B=Article desc 1|}"+//
    "{PV02;0295,0010,0025,0060,J,11,B=desc2|}"+//
    "{PV03;0240,0010,0020,0032,J,11,B=QTY|}"+//
    "{PV04;0200,0010,0020,0032,J,11,B=EXP|}"+//
    "{PV05;0160,0010,0020,0032,J,11,B=LOT|}"+//
    "{PV06;0240,0100,0030,0040,J,11,B=12x|}"+//
    "{PV07;0200,0100,0030,0040,J,11,B=2012.12|}"+//
    "{PV08;0160,0100,0030,0040,J,11,B=LOT12345|}"+//
    "{PV09;0100,0010,0030,0040,J,11,B=Keep cool|}"+//
    "{PV10;0050,0010,0020,0032,J,11,B=STE|}"+//
    "{PV11;0020,0010,0020,0032,J,11,B=STO|}"+//
    "{XS;I,0001,0002C6011|}";

Socket prtSocket = new Socket(printerHost, port);
DataOutputStream outToPrt = new DataOutputStream(prtSocket.getOutputStream());
outToPrt.writeBytes(s);
prtSocket.close();