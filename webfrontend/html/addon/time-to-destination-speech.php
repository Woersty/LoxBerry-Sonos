 <?php

function tt2t()
{
	// https://developers.google.com/maps/documentation/distance-matrix/intro#DistanceMatrixRequests
	
	global $config, $debug, $traffic;
    	
	$valid_traffic_models = array("pessimistic","best_guess","optimistic");
	if (empty($_GET['to'])) {
		LOGGING('You do not have a destination address maintained in syntax. Please enter address!',3);
		exit;
    } else {
		$arrival = $_GET['to'];
	}
	$key 		= trim($config['LOCATION']['googlekey']);
	$street		= $config['LOCATION']['googlestreet'];
	$town 		= $config['LOCATION']['googletown'];
	if (isset($_GET['traffic'])) {
		$traffic = '1';
	} else {
		$traffic = '0';
	}
	$start = $street. ', '.$town;
	if (!isset($_GET['model'])) {
		$traffic_model 	= "best_guess";
	} else {
		$traffic_model 	= $_GET['model'];
		if (in_array($traffic_model, $valid_traffic_models)) {
			$traffic_model 	= $_GET['model'];
		} else {
			LOGGING('The traffic model you have entered is invalid. Please correct!',3);
			exit;
		}
	}
	$lang		= "de"; // https://developers.google.com/maps/faq#languagesupport
	$mode 		= "driving"; // walking, bicycling, transit
	$units		= "metric"; // imperial
	$departure_time = time();
    $start      = urlencode($start);
    $arrival    = urlencode($arrival);
	$time 		= time(); # + 900; // +15 Minuten Abfahrtzeit
	$request    = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $start . "&destinations=" . $arrival . "&departure_time=" . $time . "&traffic_model=" . $traffic_model . "&mode=" . $mode . "&units=" . $units . "&key=" . $key . "&language=" . $lang;
    $jdata      = file_get_contents($request);
	#print_R($jdata);
	$data       = json_decode($jdata, true);
	if (empty($data)) {
		LOGGING('Data from Google Maps could not be obtainend! Please check your syntax',3);
		exit;
	} else {
		LOGGING('Data from Google Maps has been successful obtainend.',6);
	}	
	$status     = $data["status"];
    $row_status = $data["rows"][0]["elements"][0]["status"];
    if ($status == "OK" && $row_status == "OK") {
        $distance = $data["rows"][0]["elements"][0]["distance"]["value"];
        $distance = round(($distance / 1000), 0);
        $duration = $data["rows"][0]["elements"][0]["duration"]["value"];
        $dhours   = floor($duration / 3600);
        $dminutes = floor($duration % 3600 / 60);
        $dseconds = $duration % 60;
        if ($dseconds >= 30) {
            $dminutes = $dminutes + 1;
        }
		$duration_in_traffic = $data["rows"][0]["elements"][0]["duration_in_traffic"]["value"];
        $dthours             = floor($duration_in_traffic / 3600);
        $dtminutes           = floor($duration_in_traffic % 3600 / 60);
        $dtseconds           = $duration_in_traffic % 60;
		$start     = urldecode($start);
        $arrival   = urldecode($arrival);
        if ($dtseconds >= 30) {
            $dtminutes = $dtminutes + 1;
        }
		if ($traffic == '0') {
            $hours   = $dhours;
            $minutes = $dminutes;
			$textpart1 = "Die Fahrzeit für die Strecke von " . $distance . " km nach " . $arrival . " beträgt bei geplanter Abfahrtszeit von ". date("H", $time) ." Uhr ". date("i", $time) ." ohne Berücksichtigung des Verkehrs ca. ";
        } else {
            $hours   = $dthours;
            $minutes = $dtminutes;
			$textpart1 = "Die Fahrzeit für die Strecke von " . $distance . " km nach " . $arrival . " beträgt bei geplanter Abfahrtszeit von ". date("H", $time) ." Uhr ". date("i", $time) ." unter Berücksichtigung des Verkehrs ca. ";
        }
		if ($hours == 0 && $minutes == 1) {
            $textpart2 = "eine Minute";
        } else if ($hours == 0 && $minutes > 1) {
            $textpart2 = $minutes . " Minuten";
        } else if ($hours == 1 && $minutes == 1) {
            $textpart2 = "eine Stunde und eine Minute";
        } else if ($hours == 1 && $minutes >= 1) {
            $textpart2 = "eine Stunde und " . $minutes . " Minuten";
        } else if ($hours > 1 && $minutes > 1) {
            $textpart2 = $hours . " Stunden und " . $minutes . " Minuten";
        }
        $text = $textpart1 . $textpart2;
    } else {
		LOGGING('The entered URL is not complete or invalid. Please check URL!',3);
        exit;
    }
    $words = $text;
	#echo $request;
	
		$ttd = "Text = " . $text . "\r\n";
		$ttd .= "Abfahrtsort = " . $start . "\r\n";
		$ttd .= "Ankunftsort = " . $arrival . "\r\n";
		$ttd .= "geplante Abfahrtszeit = " . date("H:i", $time) . "\r\n";
		$ttd .= "Traffic Model = " . $traffic_model . "\r\n";
		$ttd .= "Mode = " . $mode . "\r\n";
		$ttd .= "Entfernung = " . $distance . "km / Zeit = " . $hours . " Stunden " . $minutes . " Minuten";

	LOGGING('Destination announcement: '.($ttd),7);
	LOGGING('Message been generated and pushed to T2S creation',6);
	return $words;
}


?>