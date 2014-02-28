<?php require('php/Functions.php'); ?>
<?php

$function = new Functions();
if (isset($_POST['sortvalue'])) {
    $dat = explode("&", $_POST['data']);
    $data = array();
    foreach ($dat as $values) {
        $dataVal = explode("=", $values);
        $data[$dataVal[0]][] = $dataVal[1];
    }
    /*   start sorting the values here */
    $sortData = $data['sortvalues'];
    $sortData = $function->mysort($sortData);
    $returnData = json_encode($sortData);
    echo $returnData;
    die;
} else if (isset($_POST['domainform'])) {
    $dat = explode("&", $_POST['data']);
    $data = array();
    foreach ($dat as $values) {
        $dataVal = explode("=", $values);
        $data[$dataVal[0]][] = $dataVal[1];
    }
    $domain = $data['domain'][0];
    $result = $function->checkdomain($domain);
    $returnData = json_encode($result);
    echo $returnData;
    die;
} else if (isset($_POST['countones'])) {
    $dat = explode("&", $_POST['data']);
    $data = array();
    foreach ($dat as $values) {
        $dataVal = explode("=", $values);
        $data[$dataVal[0]][] = $dataVal[1];
    }
    $number = $data['number'][0];
    $binary = $function->countones($number);
    $returnData = json_encode($binary);
    echo $returnData;
    die;
} else if (isset($_POST['truncate'])) {


    $string = isset($_POST['string']) ? $_POST['string'] : '';
    $length = isset($_POST['length']) ? $_POST['length'] : '';
    $replaceString = (isset($_POST['replacewith']) && !empty($_POST['replacewith']) ) ? $_POST['replacewith'] : '...';
    $word_break = isset($_POST['word_break']) ? true : false ;
    $middle = isset($_POST['middle']) ? true : false;
    $resultData = $function->truncateString($string, $length, $replaceString, $word_break, $middle);
    echo $resultData;
    die;
}else if(isset($_POST['sanitize'])){
   // echo "<pre>"; print_r($_POST); die;
    $html=isset($_POST['htmlstring']) ? $_POST['htmlstring'] : '';
    $tagsattributes=isset($_POST['allowedtags']) ? $_POST['allowedtags']: array();
    $allowedtags=array();
    if(!empty($tagsattributes)){
    foreach($tagsattributes as $tag){
        $allowedtags[$tag['tag']]=$tag['attributes'];
        
    }
    }
    
    $returnedhtml=$function->sanitize($html,$allowedtags);
    echo $returnedhtml; die;
    
}
?>