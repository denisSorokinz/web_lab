<?php
$xml = new DOMDocument();
$xml_album = $xml->createElement("item");
$xml->appendChild( $xml_album );

$xml->save("test.xml");
?>
