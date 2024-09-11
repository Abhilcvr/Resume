<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = 'abhilcvr83@gmail.com'; // Replace with your real receiving email address
    $subject = $_POST['subject'] ?? '';
    $from_name = $_POST['name'] ?? '';
    $from_email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $errors = [];
    if (empty($from_name)) $errors[] = 'Name is required.';
    if (empty($from_email) || !filter_var($from_email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (empty($message)) $errors[] = 'Message is required.';

    if (!empty($errors)) {
        echo json_encode(['errors' => $errors]);
        http_response_code(400); // Bad request
        exit;
    }

    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_sent = mail($to, $subject, $message, $headers);

    if ($email_sent) {
        echo json_encode(['success' => 'Your message has been sent successfully!']);
    } else {
        echo json_encode(['error' => 'There was a problem sending your message.']);
        http_response_code(500); // Internal server error
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
    http_response_code(405); // Method Not Allowed
}
?>
