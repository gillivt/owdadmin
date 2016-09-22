<?php

function esc_quot($fixstring = "") {
    $temp = preg_replace('/^\'/', '&lsquo;', $fixstring);
    $temp2 = preg_replace('/\'$/', '&rsquo;', $temp);
    $tempx = preg_replace('/ \'/', ' &lsquo;', $temp2);
    $temp3 = str_replace('\'', '&rsquo;', $tempx);
    $temp4 = preg_replace('/^\"/', '&ldquo;', $temp3);
    $temp5 = preg_replace('/\"$/', '&rdquo;', $temp4);
    $temp6 = preg_replace('/(\")([ .,;:!])/', '&rdquo;$2', $temp5);
    $temp7 = preg_replace('/ \"/', ' &ldquo;', $temp6);
    return $temp7;
}

function strip_zeros_from_date($marked_string = "") {
    // first remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    // then remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function output_message($message = "") {
    if (!empty($message)) {
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}

function __autoload($class_name) {
    
    $class_name = strtolower($class_name);
    if (stristr($class_name,"httpful")) {
        $path = LIB_PATH . DS . "{$class_name}.php";
    } else {
        $path = LIB_PATH . DS . "class.{$class_name}.php";
    }
    
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file class.{$class_name}.php could not be found.");
    }
}

function include_layout_template($template = "") {
    include(SITE_ROOT . DS . 'templates' . DS . $template);
}

function log_action($action, $message = "") {
    $logfile = SITE_ROOT . DS . 'logs' . DS . 'log.txt';
    $new = file_exists($logfile) ? false : true;
    if ($handle = fopen($logfile, 'a')) { // append
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action}: {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        if ($new) {
            chmod($logfile, 0755);
        }
    } else {
        echo "Could not open log file for writing.";
    }
}

function datetime_to_text($datetime = "") {
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

function isoDate($datestring) {
    $datestring = str_replace("/", "-", $datestring);
    if (substr($datestring, -3, 1) === "-") {
        $datestring = substr($datestring, 0, strlen($datestring)-2)."20".substr($datestring, 6);
    }
    $date = DateTime::createFromFormat('d-m-Y', $datestring);
    $dt = $date->format('Y-m-d');
    return $dt;
}

function get_mime_type($file) {
 $mtype = false;
 if (function_exists('finfo_open')) {
 $finfo = finfo_open(FILEINFO_MIME_TYPE);
 $mtype = finfo_file($finfo, $file);
 finfo_close($finfo);
 } elseif (function_exists('mime_content_type')) {
 $mtype = mime_content_type($file);
 } 
 return $mtype;
}

function uploadCSV($filename) {
    global $max_file_size;
    global $session;
    //check for errors
    switch ($_FILES["file_upload"]["error"]) {
        case UPLOAD_ERR_OK:
            //check file size here as well
            if ($_FILES["file_upload"]["size"] > $max_file_size) {
                $session->message('Exceeded filesize limit', 'alert-danger', 'glyphicon-rwarning-sign');
                return false;
            }
            //check mimetype
            //$mtype = $_FILES["file_upload"]["type"];
            $mtype = get_mime_type($_FILES["file_upload"]["tmp_name"]);
            if (!($mtype === "text/plain" || $mtype === "text/csv")) {
                $session->message('Wrong mimetype ' . $mtype, 'alert-danger', 'glyphicon-warning-sign');
                return false;
            }
            break;
        case UPLOAD_ERR_NO_FILE:
            $session->message('No file sent', 'alert-danger', 'glyphicon-warning-sign');
            return false;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $session->message('Exceeded filesize limit', 'alert-danger', 'glyphicon-warning-sign');
            return false;
        default:
            $session->message('Unknown error', 'alert-danger', 'glyphicon-warning-sign');
            return false;
    }

    $target_dir = '../csvuploads/';
    $target_file = $target_dir . $filename;
    $file_noext = substr($filename, 0, -4);
    //check if file exists and delete if it does
    if (file_exists($target_file)) {
        unlink($target_file);
    }
    //move uploaded file to target
    if (move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file)) {
        //now convert file to JSON
        //open the csv file
        $fh = fopen($target_file, 'r');
        //setup a php array to hold our csv rows
        $csvdata = array();
        //discard first row
        $row = fgetcsv($fh, 0, ',');
        while (($row = fgetcsv($fh, 0, ',')) !== false) {
            $csvdata[] = $row;
        }
        if ($file_noext === "instructor") {
            processInstructor($csvdata);
        } elseif ($file_noext === "course") {
            processCourse($csvdata);
        } else {
            $session->message("Incorrect Function Call", "alert-danger", "glyphicon-warning-sign");
            return false;
        }
    } else {
        $session->message("File cannot be moved", "alert-danger", "glyphicon-warning-sign");
        return false;
    }
    return true;
}

function processInstructor($csvdata) {
    global $session;
    try {
        //encode json array as a string
        //add opening array tag
        $json = "[";
        foreach ($csvdata as $rows) {
            $json .= '{"adinumber":"' . $rows[0] . '",';
            $json .= '"fullname":"' . $rows[1] . '",';
            $json .= '"gender":"' . $rows[2] . '",';
            $json .= '"mobile":"' . $rows[3] . '",';
            $json .= '"email":"' . $rows[4] . '",';
            $json .= '"streetaddress":"' . $rows[5] . '",';
            $json .= '"town":"' . $rows[6] . '",';
            $json .= '"county":"' . $rows[7] . '",';
            $json .= '"postcode":"' . $rows[8] . '",';
            $json .= '"hourlyrate":"' . $rows[9] . '",';
            $json .= '"hours_5":"' . $rows[10] . '",';
            $json .= '"hours_10":"' . $rows[11] . '",';
            $json .= '"hours_20":"' . $rows[12] . '",';
            $json .= '"hours_30":"' . $rows[13] . '",';
            $json .= '"hours_40":"' . $rows[14] . '",';
            $json .= '"model":"' . $rows[15] . '",';
            $json .= '"transmission":"' . $rows[16] . '",';
            $json .= '"fueltype":"' . $rows[17] . '",';
            $json .= '"areascovered":"' . $rows[18] . '",';
            $json .= '"radius":"' . $rows[19] . '",';
            $json .= '"bankdetails":"' . $rows[20] . '"';
            $json .= '},';
        }
        //remove last ,
        $json = trim($json, ',');
        //add closing array tag
        $json .= ']';

        //make service call to update instructorsupload table
        $url = 'http://localhost/owddbservice/public/owd/instructorcsv/upload';
        $response = \Httpful\Request::post($url)
                ->sendsJson()
                ->expectsJson()
                ->addHeader("Authorization", $session->token)
                ->body($json)
                ->send();
        /*         * ********************************* */
//        $response=$json;
//        $session->message($response);
        $session->message('The file ' . basename($_FILES["file_upload"]["name"]) . ' was uploaded', 'alert-success', 'glyphicon-ok-circle');
        return true;
    } catch (exception $e) {
        $session->message("Error {$e->getMessage()}, the file is not the right format", 'alert-danger', 'glyphicon-warning-sign');
        return false;
    }
}

function processCourse($csvdata) {
    global $session;
    try {
        //encode json array as a string
        //add opening array tag
        $json = "[";
        foreach ($csvdata as $rows) {
            $json .= '{"courseref":"' . $rows[0] . '",';
            $json .= '"coursestart":"' . $rows[1] . '",';
            $json .= '"hours":"' . $rows[2] . '",';
            $json .= '"lengthofcourse":"' . $rows[3] . '",';
            $json .= '"testtype":"' . $rows[4] . '",';
            $json .= '"fullname":"' .$rows[5] . '",';
            $json .= '"streetaddress":"' . $rows[6] . '",';
            $json .= '"town":"' . $rows[7] . '",';
            $json .= '"county":"' . $rows[8] . '",';
            $json .= '"postcode":"' . $rows[9] . '",';
            $json .= '"pupiltelephone":"' . $rows[10] . '",';
            $json .= '"drivingexperience":"' . $rows[11] . '",';
            $json .= '"theoryrequired":"' . $rows[12] . '",';
            $json .= '"testbooked":"' . $rows[13] . '",';
            $json .= '"courseclaimed":"' . $rows[14] . '"';
            $json .= '},';
        }
        //remove last ,
        $json = trim($json, ',');
        //add closing array tag
        $json .= ']';

        //make service call to update instructorsupload table
        $url = 'http://localhost/owddbservice/public/owd/coursecsv/upload';
        $response = \Httpful\Request::post($url)
                ->sendsJson()
                //->expectsJson()
                ->addHeader("Authorization", $session->token)
                ->body($json)
                ->send();
//        $session->message( $json );
        $session->message('The file ' . basename($_FILES["file_upload"]["name"]) . ' was uploaded', 'alert-success', 'glyphicon-ok-circle');
//        $session->message("$response");
        return true;
    } catch (exception $e) {
        $session->message("Error {$e->getMessage()}, the file is not the right format", 'alert-danger', 'glyphicon-warning-sign');
        return false;
    }
}

?>