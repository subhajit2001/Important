<?php

	header("refresh: 10");
   	
   	error_reporting(E_ERROR | E_PARSE);

   	$begin = new DateTime('2021-04-17');
	$end = new DateTime('2021-04-19');

	$interval = DateInterval::createFromDateString('1 day');
	$period = new DatePeriod($begin, $interval, $end);
	
	$count = 0;
	$message = 'Dear '.'Subhajit Saha'.',<br>';
	
	foreach ($period as $dt)
	{
   	$url = "https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByDistrict?district_id=725&date=".$dt->format("d-m-Y");
    $json = json_decode(file_get_contents($url), true);
    
    if($json["sessions"][0]["center_id"]!==NULL)
    {
		$message .= "Take vaccine on : ".$dt->format("d-m-Y").'<br>';
		$count+=1;
	}
	}
		if($count>0)
		{
		$to = "subhajit.asia@gmail.com";
		$subject = "Take Vaccine";
		$message .= "<br><br>Regards,<br>";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <enquiry@example.com>' . "\r\n";

		mail($to,$subject,$message,$headers);
		echo "Slots available!!!Check Mail...";
		}
		else
		{
			echo "No slots available";
		}
?>