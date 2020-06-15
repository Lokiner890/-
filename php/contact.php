<?php

// Define some constants
define( "RECIPIENT_NAME", "YOUR_NAME_HERE" );
define( "RECIPIENT_EMAIL", "YOUR_EMAIL_HERE" );
define( "EMAIL_SUBJECT", "$subject" );

// Read the form values
$success = false;
$senderName = isset( $_POST['senderName'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderName'] ) : "";
$senderEmail = isset( $_POST['senderEmail'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderEmail'] ) : "";
$subject = isset( $_POST['subject'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['subject'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// If all values exist, send the email
if ( $senderName && $senderEmail && $message ) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $senderName . " <" . $senderEmail . ">";
  $success = mail( $recipient, $subject , $message, $headers );
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Дякую!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Дякую за відправку повідомлення скоро відповім.</p>" ?>
  <?php if ( !$success ) echo "<p>Вибачте, але з відправкою виникли проблеми .Повторіть спробу.</p>" ?>
  <p>Натисніть клавішу повернутися в браузері щоб перейти на минулу сторінку.</p>
  </body>
</html>
<?php
}
?>