<?php
function foo($arg_1)
{
// Load XML with SimpleXml from string
    $root = simplexml_load_file("test.xml");
    $root->addChild('item', $arg_1);
// Saving the whole modified XML to a new filename
    $root->asXml('test.xml');
echo $arg_1;
}

if (file_exists('validator.xml')) {
    $xml = simplexml_load_file('validator.xml');
foreach ($xml->login->users->user as $element){
    if ($_POST["username"] === strval($element)){
        foo("BAD  login");
        exit();
    }
}
    if(strlen($_POST["username"]) < intval($xml->login->lenght)){
        foo("BAD Short login");
    }else{
        foo( "Good");
    }
} else {
   foo('Не удалось открыть файл test.xml.');
}
?>
