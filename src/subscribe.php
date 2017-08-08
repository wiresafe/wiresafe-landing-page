<?php
$email = $_POST["emailaddress"];
$to = "jakirsuman@gmail.com";
$subject = "A New report Has Been Downloaded";
$headers = "From: info@wiresafe.com\n";
$message = "A visitor to your site has with following email address has downloaded the Cyber Security Report.\n

Email Address: $email";
$user = "$email";
$usersubject = "Thank You from WireSafe.com";
$userheaders = "From: info@wiresafe.com\n";
$usermessage = "Thank you for downloading the Cyber Security Report from WireSafe.com.";
mail($to,$subject,$message,$headers);
mail($user,$usersubject,$usermessage,$userheaders);

header('Location: thank-you-book.html');
?>