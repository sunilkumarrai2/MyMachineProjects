<?php
   /*
   * Collect all Details from Angular HTTP Request.
   */
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $email = $request->email;
    $name = $request->name;
    $message = $request->message;

    $from = 'This message is from '.$name;
    $to1 = "harshitasinghal.mua@gmail.com";
//    $to1 = "sunilkumarrai2@yahoo.co.in";
    $to2 = "sunilkumarrai2@gmail.com";
    $subject = 'Message from my website';
    $body =" From: $name\n E-Mail: $email\n Message: $message";

    if(mail($to1,$subject,$body,$from))
            {
                       mail($to2,$subject,$body,$from);
	                   $result="Thank You! I will be in touch shortly";
                       echo $result;
	        }
        else{
                        $result="Mail Not Sent";
                        echo $result;
	       }
?>

<!--{"data":"Thank You! I will be in touch shortly","status":200,"config":{"method":"POST","transformRequest":[null],"transformResponse":[null],"jsonpCallbackParam":"callback","url":"http://harshitasinghal.com/Backend/a.php","data":{"email":"sunilkumarrai2@gmail.com","name":"","message":""},"headers":{"Content-Type":"application/x-www-form-urlencoded","Accept":"application/json, text/plain, */*"}},"statusText":"OK"}-->



