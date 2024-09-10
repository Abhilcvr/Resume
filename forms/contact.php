<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your real receiving email address
    $to = 'abhilcvr83@gmail.com';
    $subject = $_POST['subject'];
    $from_name = $_POST['name'];
    $from_email = $_POST['email'];
    $message = $_POST['message'];

    // Validate input
    $errors = [];
    if (empty($from_name)) $errors[] = 'Name is required.';
    if (empty($from_email) || !filter_var($from_email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (empty($message)) $errors[] = 'Message is required.';

    if (!empty($errors)) {
      echo implode('<br>', $errors);
      exit;
    }

    // Send email
    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $email_sent = mail($to, $subject, $message, $headers);
    
    if ($email_sent) {
      echo 'Your message has been sent successfully!';
    } else {
      echo 'There was a problem sending your message.';
    }
  } else {
    echo 'Invalid request method.';
  }


  // /**
  // * Requires the "PHP Email Form" library
  // * The "PHP Email Form" library is available only in the pro version of the template
  // * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  // * For more info and help: https://bootstrapmade.com/php-email-form/
  // */

  // // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'abhilcvr83@example.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  // /*
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );
  // */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();
?>
