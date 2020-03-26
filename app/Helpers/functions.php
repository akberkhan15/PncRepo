<?php

function image_url($folder,$file_name)
{   
	$file_name = trim($file_name)=='' || !file_exists(storage_path(DefaultStorage.'/'.$folder.'/'.$file_name)) ? 'noimage.png' : $file_name;
	return url($folder.'/'.$file_name);
}

function image_path($folder,$file_name)
{
	$file_name = trim($file_name)=='' || !file_exists(storage_path(DefaultStorage.'/'.$folder.'/'.$file_name)) ? 'noimage.png' : $file_name;
	return storage_path(DefaultStorage.'/'.$folder.'/'.$file_name);
}

function base_url($var="")
{
	return url($var);
}

function root_path($var="")
{
	return base_path($var);
}

function cdn_url($var="")
{
	return url($var);
}

function rdd($arr)
{
	echo '<textarea style="width:100%;height:800px" width="100%" readonly height="800">';
	print_r($arr);
	echo '</textarea>';	
}

function m_encypt($arr)
{
	$secretHash = ENCYPKEY;
	$encryptionMethod = "AES-256-CBC";
	
	//To encrypt
	return $encryptedMessage = base64_encode(@openssl_encrypt(serialize($arr),$encryptionMethod, $secretHash));
}

function m_decypt($encrypted)
{
	$secretHash = ENCYPKEY;
	$encryptionMethod = "AES-256-CBC";

	//To Decrypt
	return $decryptedMessage = unserialize(@openssl_decrypt(base64_decode($encrypted), $encryptionMethod, $secretHash));
}

function CURL($url,$var=''){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST ,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS ,$var);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER ,0); // DO NOT RETURN HTTP HEADERS
	curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1); // RETURN THE CONTENTS OF THE CALL;
	return curl_exec($ch);
}

function isValidEmail($email)
{
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email);
}

function isValidURL($url)
{
	return preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}


function SendGridMail($to,$subject,$body)
{	
	$url = 'https://api.sendgrid.com/';
	$json_string = ['to' => [$to, $to],'category' => 'website'];
	$params = array(
		'api_user'  => "fibg",
		'api_key'   => "Propane2016.",
		'x-smtpapi' => json_encode($json_string),
		'to'        => $to,
		'subject'   => $subject,
		'html'      => $body,
		'text'      => $body,
		'from'      => SUPPORT_EMAIL,
	  );
	$request =  $url.'api/mail.send.json';
	$response =  CURL($request,$params);
	return true;
}


function get_day_name($GivenDate) {

    $date = date('d/m/Y', strtotime($GivenDate));

    if($date == date('d/m/Y')) {
      $date = 'Today';
    } 
    else if($date == date('d/m/Y',time() - (24 * 60 * 60))) {
      $date = 'Yesterday';
    }
    else
    	$date = $GivenDate;

    return $date;
}


function pagintion($pagination,$pageLink='')
{
    
 //parse_str($_SERVER['QUERY_STRING'], $params);
 if($pageLink=='' && !empty($params))
 {
 	foreach ($params as $key => $value) {
 		if($key!='page')
 			$pageLink.="$key=$value&";
 	}
 	if($pageLink!='')
 		$pageLink = '&'.$pageLink;
 }

 if($pagination['total']>1):?>
 <!--- Pagination --->
 <div class="row">   
    <?php //$pageLink = ''/*'&duration='.get_post('duration').'&filter='.get_post('filter').'&startDate='.get_post('startDate').'&endDate='.get_post('endDate').'&q='.get_post('q')*/ ?>
    <div class="dataTables_info" id="datatable-buttons_info" role="status" aria-live="polite">Showing <?php echo $pagination['from']; ?> to <?php echo $pagination['to']; ?> entries</div>
    <div class="dataTables_paginate paging_simple_numbers" style="float:right" id="datatable-buttons_paginate">
      <?php $start = ($pagination['current'] - 4) > 0 ? ($pagination['current'] - 4) : 1 ?>
      <?php $end = ($pagination['current'] + 4) < $pagination['last'] ?($pagination['current'] + 4) : $pagination['last'] ?>
      <ul class="pagination">
        <li class="paginate_button previous <?php if($pagination['current'] == $pagination['first']): echo 'disabled'; endif;?>" aria-controls="datatable-buttons" tabindex="0" id="datatable-buttons_previous"><a href="<?php if($pagination['current'] == $pagination['first']): echo '#_'; endif;?>?page=<?php echo $pagination['first'].$pageLink ?>"><i class="fa fa-angle-double-left"></i><?php //echo 'First';?></a></li>
        <?php for($i=$start;$i<=$end;$i++):?>
        <li class="paginate_button  <?php if($pagination['current'] == $i): echo 'active'; endif;?>" aria-controls="datatable-buttons" tabindex="0"> <a href="?page=<?php echo $i . $pageLink;?>"  class="page" ><?php echo $i;?></a> </li>
        <?php endfor; ?>
        <li class="paginate_button next <?php if($pagination['current'] == $pagination['last']): echo 'disabled'; endif;?>" aria-controls="datatable-buttons" tabindex="0" id="datatable-buttons_next"><a href="<?php if($pagination['current'] == $pagination['last']): echo '#_'; endif;?>?page=<?php echo $pagination['last'].$pageLink ?>"><i class="fa fa-angle-double-right"></i><?php //echo 'Last';?></a></li>
      </ul>
    </div>
  </div>
 <?php endif; 
}


function  secondsToTime($inputSeconds) {

    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($inputSeconds / $secondsInADay);

    // extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the final array
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    $hours+=(24*$days);
    if($hours < 10)
    {
     $hours = "0".$hours;   
    }
    if($minutes < 10)
    {
     $minutes = "0".$minutes;   
    }
    if($seconds < 10)
    {
     $seconds = "0".$seconds;   
    }
    return "$hours:$minutes:$seconds";
}


function send_notification_GCM_android($user_type,$registatoin_id,$message,$title='Anesthesia Notification',$event="message") 
{
    if($user_type=='crna')
        $GOOGLE_SERVER_KEY = GOOGLE_SERVER_KEY_CRNA;
    else
        $GOOGLE_SERVER_KEY = GOOGLE_SERVER_KEY_CUSTOMER;

    $data = false;
    // Set POST variables
    $url = GOOGLE_FCM_URL;
    $fields = array(
            'to'        => $registatoin_id,
            'notification'  => array('body' => $message, 'title'=> $title),
            'data'  => array('message' => $message, 'title'=> $title)
        );
    // print_r($fields);
    // exit();
    $headers = array(
        'Authorization: key='.$GOOGLE_SERVER_KEY,
        'Content-Type: application/json'
    );
    // Open connection
    $ch = curl_init();
    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Disabling SSL Certificate support temporarly
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //print_r($fields);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    // Execute post
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    // Close connection
    curl_close($ch);
    return $result;
}

function send_notification_iphone($user_type,$deviceToken,$message,$title='Anesthesia Notification',$event="message")
{
    if($user_type=='crna')
        $APNS_LOICAL_CERT = APNS_LOICAL_CRNA_CERT;
    else
        $APNS_LOICAL_CERT = APNS_LOICAL_CERT;

    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', root_path($APNS_LOICAL_CERT));
    stream_context_set_option($ctx, 'ssl', 'passphrase', APNS_PASSPHRASE);  
    $fp = stream_socket_client(APNS_PUSHGATWAY, $err,$errstr,60, 
    STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT,$ctx);
    //if (!$fp)
    //exit("Failed to connect amarnew: $err $errstr" . PHP_EOL);
    //  echo 'Connected to APNS' . PHP_EOL;
    // Create the payload body
    $body['aps'] = array(
        'badge' => +1,
        'alert' => $message,
        'sound' => 'default'
        );
        //$body['event'] = $event;
    $payload = json_encode($body);
    // Build the binary notification
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
    // Send it to the server
    $result = fwrite($fp, $msg, strlen($msg));  
    if (!$result)
    {
        $response['message'] = 'Message not delivered' . PHP_EOL;
        $response['response'] = 'ERROR';
        $response['result'] = $result;
    }
    else
    {
        $response['message'] = 'Message successfully delivered amar'.$message. PHP_EOL;
        $response['response'] = 'SUCCESS';
        $response['result'] = $result;
        
    }
    // Close the connection to the server
    fclose($fp);
    return json_encode($response);          
}
