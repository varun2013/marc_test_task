<?php

class Functions {

    public function mysort($sortData = null) {
        $length = count($sortData); //Gets The length of the entered valued array
        for ($outer = 0; $outer < $length; $outer++) {  // loop over entered array 
            for ($inner = 0; $inner < $length; $inner++) {  // Inner loop to compare the bubbles of each value
                if (strcasecmp($sortData[$outer], $sortData[$inner]) > 0) {   //condition to check bubbles value for descending order
                    /* swapping the values accordingly */
                    $tmp = $sortData[$outer];
                    $sortData[$outer] = $sortData[$inner];
                    $sortData[$inner] = $tmp;
                }
            }
        }
        return $sortData;  // return the sorted array;
    }

    public function checkdomain($domain = null) {

        $validpattern = "/^(?!.{254})(?:[a-z0-9][a-z0-9\-\_]{0,61}[a-z0-9]\.|[a-z0-9]{0,63}\.)*?[a-zA-z0-9]{0,62}$/";
        return preg_match($validpattern, $domain) ? "MATCH" : "NO MATCH";
    }

    public function countones($number = null) {
        $binnumber = decbin((int) $number);
        $length = strlen($binnumber);
        $count = 0;
        for ($i = 0; $i < $length; $i++) {

            if ($binnumber[$i] == '1') {
                $count++;
            }
        }
        $return_array = array(
            'binary' => $binnumber,
            'count' => $count,
        );
        return $return_array;
    }

    public function sanitize($html = null, $allowedtags = null) {

        $allowedtagstring = '<script>';
        if (!empty($allowedtags)) {
            foreach ($allowedtags as $key => $tag) {
                $allowedtagstring.='<' . strtolower($key) . '>';
            }
        }
        $stripedhtml = strip_tags($html, "'" . $allowedtagstring . "'");
    
        $htmlarray = xml_parser_create();
        xml_parse_into_struct($htmlarray, $stripedhtml, $vals, $index);
        xml_parser_free($htmlarray);

        $returnedArray = array();
        if (!empty($vals)) {
            foreach ($vals as $key => $data) {

                if ($data['tag'] == "SCRIPT" && !array_key_exists(strtolower($data['tag']), $allowedtags)) {

                    continue;
                }

                if (!empty($data['attributes'])) {



                    foreach ($data['attributes'] as $key1 => $attribute) {
                        $allowedattributes = explode(",", $allowedtags[strtolower($data['tag'])]);

                        if (in_array(strtolower($key1), $allowedattributes)) {
                            
                        } else {
                            unset($data['attributes'][$key1]);
                        }
                    }
                }
                $returnedArray[] = $data;
            }
        }
        $returnhtml = '';
  
        if (!empty($returnedArray)) {

            foreach ($returnedArray as $element) {
                $htmldata = '';
                if ($element['type'] == 'open') {
                    $htmldata.='<' . strtolower($element['tag']);
                    if (!empty($element['attributes'])) {
                        foreach ($element['attributes'] as $key => $attribute) {
                            $htmldata.=' ' . strtolower($key) . "=" . "'" . $attribute . "' ";
                        }
                    }

                    $htmldata.='>' . $element['value'];
                } else if ($element['type'] == 'complete') {

                    $htmldata.='<' . strtolower($element['tag']);
                    if (!empty($element['attributes'])) {
                        foreach ($element['attributes'] as $key => $attribute) {
                            $htmldata.=' ' . strtolower($key) . "=" . "'" . $attribute . "'";
                        }
                    }
                    $htmldata.='>' . $element['value'] . '</' . strtolower($element['tag']) . '>';
                } else if ($element['type'] == 'close') {
                    $htmldata.='</' . strtolower($element['tag']) . ">";
                }

                $returnhtml.=$htmldata;
            }
        }
        return $returnhtml;
    }
    
    
    function truncateString($string, $length = 0, $replaceWith = '...',  $break_words = false, $middle = false,$charset='UTF-8')
    {
        
        if ($length == 0)
        return $string;
 
    if (mb_strlen($string) > $length) {
        $length -= min($length, mb_strlen($replaceWith));
        if (!$break_words && !$middle) {
               $string = preg_replace('/\s+?(\S+)?$/u', '', mb_substr($string, 0, $length+1, $charset));
        }
        if(!$middle) {
            return mb_substr($string, 0, $length, $charset) . $replaceWith;
        } else {
            return mb_substr($string, 0, $length/2, $charset) . $replaceWith . mb_substr($string, -$length/2, (mb_strlen($string)-$length/2), $charset);
        }
    } else {
        return $string;
    }
}


}
?>
