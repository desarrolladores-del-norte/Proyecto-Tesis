<?php






 $PNG_TEMP_DIR = ROOT.'views'.DS.'usuarios'.DS.'phpqrcode'.DS.'temp'.DS;

// $PNG_TEMP_DIR =BASE_URL.'views/usuarios/phpqrcode/temp/';

// $PNG_WEB_DIR =ROOT.'views'.DS.'usuarios'.DS.'phpqrcode'.DS.'temp'.DS;

$PNG_WEB_DIR =BASE_URL.'views/usuarios/phpqrcode/temp/';

include_once ROOT.'views'.DS.'usuarios'.DS.'phpqrcode'.DS.'qrlib.php';


if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

// $Dato='123456';

$filename = $PNG_TEMP_DIR.'test.png';


$errorCorrectionLevel = 'L';


$matrixPointSize = 4;



if (isset($Dato)) {
 if (trim($Dato) == '')
        die('data cannot be empty! <a href="?">back</a>');

    $filename = $PNG_TEMP_DIR.'test'.md5($Dato.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    $filename1 = 'test'.md5($Dato.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    QRcode::png($Dato, $filename, $errorCorrectionLevel, $matrixPointSize, 2);


    echo '<img src="'.$PNG_WEB_DIR.$filename1.'" /><br>';
//echo $PNG_WEB_DIR.'<-DIR <br>';
//echo $filename1.'<-IMG <br>';

}




