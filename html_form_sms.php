<?php
if(isset($_POST['email'])) {
	
	// CHANGE THE TWO LINES BELOW
	$email_to = "sales@mensafutura.com";
	
	
	
	
	
	
	$first_name = $_POST['name']; 
	$subjects = $_POST['subjects']; 
	$email_from = $_POST['email']; 
	$telephone = $_POST['Phone']; 
	
	
	$rfirst_name = $_POST['rname'];
	$rtelephone = $_POST['rPhone'];
	$comments = $_POST['Text']; 
	
	if (($telephone < "9999999999") &&($telephone > "5555555555")){
    echo "Have a good day!";
} else {
	echo "Phone number is invalid. Kindly enter your phone numer again and resubmit the form to hear back from us. You entered: {$telephone}";
	 header( "Refresh:10; url=http://mensafutura.com", true, 303); 
	
    die();
	
}




	$email_message = "Form details below:\n\n";
	
	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}
	
	$email_message .= "Sender Name: ".clean_string($first_name)."\n";
	$email_message .= "Subject ".clean_string($subjects)."\n";
	$email_message .= "Sender Email: ".clean_string($email_from)."\n";
	$email_message .= "Sender Telephone: ".clean_string($telephone)."\n";
	$email_message .= "Receiver Name: ".clean_string($rfirst_name)."\n";
	$email_message .= "Receiver Telephone: ".clean_string($rtelephone)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";
	
$email_subject = "Message from ".$first_name;	

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  


	
	
function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files){
	$cc="sales.mensafutura@gmail.com";
    $from = $senderName." <".$senderMail.">"; 
	$headers = "From: $from"."\r\n".
	"CC: $cc";

    // boundary 
    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    // headers for attachment 
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

    // multipart boundary 
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

    // preparing attachments
    if(count($files) > 0){
        for($i=0;$i<count($files);$i++){
            if(is_file($files[$i])){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($files[$i],"rb");
                $data =  @fread($fp,filesize($files[$i]));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
                "Content-Description: ".basename($files[$i])."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
    }

    $message .= "--{$mime_boundary}--";
   /*  $returnpath = "-f" . $senderMail; */

    //send email
    $mail = @mail($to, $subject, $message, $headers); 

    //function return true, if email sent, otherwise return fasle
    if($mail){ return TRUE; } else { return FALSE; }

}

//email variables
$to = $email_from;
$from = "sales@mensafutura.com"; 
$from_name = "Mensa Futura Life Sciences Pvt Ltd";

//attachment files path array

$attach1 = "/home/ox34qfbat5fv/public_html/images/Price_List.pdf"; 
$attach2 = "/home/ox34qfbat5fv/public_html/images/13.jpg"; 
/* $files = array($attach1,$attach2); */

$files = NULL; 
$subject = "Acknowledgement from Mensa Futura Life Sciences for ".$first_name;
$html_content = "<b><p>Dear Sir,<br/><i>Greetings from Mensa Futura Life Sciences family!</i><br/><br/>We have received your request for scheduling SMS.<br/>Please communicate about how you feel about our service.</p></b>For Mensa Futura Life Sciences Pvt. Ltd.<br/>Tel: 09462823655<br/>www.mensafutura.com";



//call multi_attach_mail() function and pass the required arguments
$send_email = multi_attach_mail($to,$subject,$html_content,$from,$from_name,$files);

//print message after email sent
echo $send_email?"<p>Mail Sent</p>":"<p>Mail sending failed.</p>";


?>

<!-- place your own success html below -->

<script type="text/javascript">

    alert("Thank you for contacting us. We will be in touch with you very soon.");
	/* <![CDATA[ */
var google_conversion_id = 809214338;
var google_conversion_label = "lpkjCO2FmoQBEILD7oED";
var google_remarketing_only = false;
/* ]]> */

</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/809214338/?label=lpkjCO2FmoQBEILD7oED&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


    <head>
        <meta http-equiv="refresh" content="3;http://www.mensafutura.com/index.html" />
    </head>
    <body>
        <h1>Thanks for your query. Redirecting in 3 seconds...</h1>
    </body>



<?php

/* header("Location: http://www.mensafutura.com/index.html"); */
}
die();
?>
