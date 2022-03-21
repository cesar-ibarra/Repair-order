<?php
    //Recipient
    $to = 'ibarratcesar@gmail.com';

    //subject
    $subject = 'WIN Hyundai Service';

    //Message
    $message = '<h1>Hi there.</h1><p>Thanks for testing!</p>';

    //headers
    $headers = "From: WIN Hyundai El Monte <winhyundaiparts@gmail.com>\r\n";
    $headers .="Reply-To: winhyundaiparts@gmail.com\r\n";
    $headers .="Content-type: text/html\r\n";

    //send email
    mail($to, $subject, $message, $headers);

?>