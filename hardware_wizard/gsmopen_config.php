<?php
include("config.php");
$data = file(HardwareDiscovery);
$i = 0;

$writer = new XMLWriter();  
$writer->openURI(GsmOpenConfig);  
$writer->startDocument('1.0','UTF-8');  
$writer->setIndent(4);   

$writer->startElement('configuration');  
$writer->writeAttribute('name','gsmopen.conf');
$writer->writeAttribute('description','GSMopen Configuration');
$writer->startElement('global_settings');  

$writer->startElement('param');  
$writer->writeAttribute('debug','8');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('dialplan','XML');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('context','default');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('hold-music','$${moh_uri}');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('destination','5000');
$writer->endElement();  

$writer->startElement('per_interface_settings');  

print_r($data);

foreach($data as $key => $entry){

  $i++;
 $entry = explode(",",$entry);

 if($entry[6] == 'freeswitch'){

    //find port for audio
    $no = substr($entry[3], -1);
    $audio = intval($no)-1;
    $audio_port = substr($entry[3], 0, -1).$audio;

    $writer->startElement('interface');  
    $writer->writeAttribute('id',$i); //FS{x}-IMSI
    $writer->writeAttribute('interface',"FS".$i."-".$entry[0]); //FS{x}-IMSI

    $writer->startElement('param');  
    $writer->writeAttribute('controldevice_name',$entry[3]); //Port number
    $writer->endElement();  

    $writer->startElement('param');  
    $writer->writeAttribute('controldevice_audio_name',$audio_port); // Port number -1
    $writer->endElement();  

    $writer->startElement('param');  
    $writer->writeAttribute('destination','500'.($i-1)); // Extention
    $writer->endElement();  

    $writer->endElement();  //interface

 }

}

$writer->endElement(); //per_interface_settings
$writer->endElement();  //global_settings
$writer->endElement();  //configuration
$writer->endDocument();  
$writer->flush();  



/*
<configuration name="gsmopen.conf" description="GSMopen Configuration">
  <global_settings>
    <param name="debug" value="8"/>
    <param name="dialplan" value="XML"/>
    <param name="context" value="default"/>
    <param name="hold-music" value="$${moh_uri}"/>
    <param name="destination" value="5000"/>
  </global_settings>
  <!-- one entry here per gsmopen interface -->
  <per_interface_settings>
    <interface id="1" name="FS1-IMSI">
      <param name="controldevice_name" value="/dev/ttyUSB2"/>
      <param name="controldevice_audio_name" value="/dev/ttyUSB1"/>
      <param name="destination" value="5000"/>
    </interface>
  <interface id="2" name="interface2">
      <param name="controldevice_name" value="/dev/ttyUSB5"/>
      <param name="controldevice_audio_name" value="/dev/ttyUSB4"/>
      <param name="destination" value="5001"/>
    </interface>
  <interface id="3" name="interface3">
      <param name="controldevice_name" value="/dev/ttyUSB8"/>
      <param name="controldevice_audio_name" value="/dev/ttyUSB7"/>
      <param name="destination" value="5002"/>
    </interface>


  </per_interface_settings>
</configuration>
*/



?>