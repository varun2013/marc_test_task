<?php

class Functions {

    public function mysort($sortData = null) {
        $length = count($sortData); //Gets The length of the entered valued array
        for ($outer = 0; $outer < $length; $outer++) {  // loop over entered array 
            for ($inner = 0; $inner < $length; $inner++) {  // Inner loop to compare the bubbles of each value
                if ($sortData[$outer] > $sortData[$inner]) {   //condition to check bubbles value for descending order
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

        $validpattern = "/^([a-z0-9][a-z0-9\-\_]{0,61}[a-z0-9]\.|[a-z0-9]\.)*?[a-z]+\.[a-zA-z0-9]{2,6}$/";
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

    public function sanitize($html=null,$allowedtags=null) {
        
        //$htmlarray = simplexml_load_string($html);
         $htmlarray = xml_parser_create();
        xml_parse_into_struct($htmlarray, $html, $vals, $index);
        xml_parser_free($htmlarray);
        echo "<pre>"; print_r($vals);
        
        die;
        return $htmlarray;
        
    }

    public function truncateString($string = null, $length = 0, $replacewith = "---", $word_break = false, $middle = false) {
        $result = $string;

        if ($length != '') {
            $result = substr_replace($string, "...", -$length);
            if ($word_break == 'false') {
                $s = substr($string, 0, $length);
                $result = substr($s, 0, strrpos($s, ' '));
            }

            if (strlen(trim($replacewith)) > 0) {

                if ($word_break == 'false') {

                    $s = substr($string, 0, $length);
                    $result = substr($s, 0, strrpos($s, ' '));
                    $result.=$replacewith;
                } else if ($middle == 'true') {

                    $sublength = ($length / 2) - 1;
                    $s = substr($string, 0, $sublength);
                    $s1 = substr($string, strlen($string) - 14, strlen($string));
                    $result = $s . $replacewith . $s1;
                    echo $result;
                    die;
                } else {
                    $result = substr_replace($string, $replacewith, -$length);
                }
            } else {
                $result .="...";
            }
        }

        return $result;
    }

}

?>