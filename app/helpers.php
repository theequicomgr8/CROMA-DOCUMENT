<?php 
function authname($id){
	$data=App\Models\AdminLogin::where('id',$id)->first();
	return $data->username;
}

// function authpic($id){
// 	$data=App\Models\AdminLogin::where('id',$id)->first();
// 	return $data->profile_pic;
// }

function authid($id){
	$data=App\Models\AdminLogin::where('id',$id)->first();
	return $data->id;
}

function basepath($file){
	//return "http://localhost/seo/public/admin/images/".$file;
	return "https://document.cromacampus.com/public/".$file;
}



function sendSMS($sendto, $message,$tempid=null){
	$username = 't1cromacampussms';
	$password = '42308595';
	$sender = 'CCAMPS';
	$sendto = $sendto;
		$tempid = $tempid;
	//$templateId = '1707161786775524106';
	$message = str_replace(' ', '%20', $message);
//	$url = 'http://nimbusit.co.in/api/swsendSingle.asp';
	$url = 'http://nimbusit.co.in/api/swsend.asp';
//	$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&message=$message&entityID=1701160344973814570";
 
		$data = "username=$username&password=$password&sender=$sender&sendto=$sendto&entityID=1701160344973814570&templateID=$tempid&message=$message";
//http://nimbusit.co.in/api/swsendSingle.asp?username=t1cromacampussms&password=42308595&sender=CCAMPS&sendto=9205323836&entityID=1701160344973814570&templateID=1707161786775524106&message=%201234%20is%20Lead%20Portal%20Verification%20Code%20for%20Brijesh%20CROMA%20CAMPUS

//http://nimbusit.co.in/api/swsendSingle.asp?username=t1cromacampussms&password=42308595&sender=CCAMPS&sendto=9205323836&entityID=1701160344973814570&templateID=1707161786775524106&message=v
//http://nimbusit.co.in/api/swsendSingle.asp?username=xxxx&password=xxxx&sender=senderId&sendto=919xxxx&entityID=170134xxxxxxxxx&templateID=158777xxxxxxxxxxx&message=hello  

	$objURL = curl_init($url);
	curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($objURL, CURLOPT_POST, 1);
	curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
	$retval = trim(curl_exec($objURL));
	curl_close($objURL);
	return $retval;
}

?>