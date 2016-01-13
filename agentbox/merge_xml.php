<?php
function debug($bug){
	echo "<code><pre>";
		print_r($bug);
	echo "</code></pre>";
}

  function simplexml_merge (SimpleXMLElement &$xml1, SimpleXMLElement $xml2) { 
     // convert SimpleXML objects into DOM ones 
     $dom1 = new DomDocument(); 
     $dom2 = new DomDocument(); 
     $dom1->loadXML($xml1->asXML()); 
     $dom2->loadXML($xml2->asXML()); 
   
     // pull all child elements of second XML 
     $xpath = new domXPath($dom2); 
     $xpathQuery = $xpath->query('/propertyList/residential'); 
     for($i = 0; $i < $xpathQuery->length; $i++) { 
         // and pump them into first one 
         $dom1->documentElement->appendChild($dom1->importNode($xpathQuery->item($i), true)); 
     } // for($i = 0; $i < $xpathQuery->length; $i++) 
     $xml1 = simplexml_import_dom($dom1); 
  } // function simplexml_merge (SimpleXMLElement &$xml1, SimpleXMLElement $xml2)  


//Get all the files
$all_xml_files = glob("*xml");
debug(sizeof($all_xml_files));
//Check if there is no other files and cleans the xml
if(sizeof($all_xml_files) > 2){
$template_file = file_get_contents('merge_template.xml'); 
$template_xml = new SimpleXMLElement($template_file);
file_put_contents("allprops.xml", $template_xml->asXML());
}
//Shows current Array before removeing files
echo "<strong>Before unset</strong>";
debug($all_xml_files);

//Find template files to remove.
$n = array_search('allprops.xml',$all_xml_files);
$n1 = array_search('merge_template.xml',$all_xml_files);
//Remove template files
unset($all_xml_files[$n]);
unset($all_xml_files[$n1]);

//Show final array to be merged.
echo "<strong>After unset</strong>";
$all_xml_files = array_values($all_xml_files);
debug($all_xml_files);

//Loops through files in the folder
for ($i=0; $i < sizeof($all_xml_files); $i++) { 
	if(isset($all_xml_files[$i]) && strlen($all_xml_files[$i]) > 0){

		//Get file and set up xml
		$xmlstr = file_get_contents($all_xml_files[$i]); 
	    $stock_xml = new SimpleXMLElement($xmlstr);

	    $xmlstr = file_get_contents('allprops.xml'); 
	    $xml_app = new SimpleXMLElement($xmlstr); 

	  	//Adds the data to all props
	    simplexml_merge($stock_xml, $xml_app); 
	    file_put_contents("allprops.xml", $stock_xml->asXML());

	    rename($all_xml_files[$i], 'merged/'.$all_xml_files[$i]);
		}
	}
	 echo "<h3>Final File</h3>";
    $xml_debug = new SimpleXMLElement(file_get_contents('allprops.xml')); 
 	debug($xml_debug);

 
?>