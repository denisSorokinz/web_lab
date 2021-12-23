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
    if(strlen($_POST["password"]) < intval($xml->password->lenght)){
        foo("BAD Short password");
    }
    elseif (strval($xml->password->shoodConsistNum) === "True" ){
        if(preg_match('~[0-9]+~', strval($xml->password->shoodConsistNum))){
            foo("Good");
            exit();
        }
        else{
            foo("Bad");
            exit();
        }
    }else{
        echo "Good";
    }
} else {
    echo 'Не удалось открыть файл test.xml.';
}
?>
