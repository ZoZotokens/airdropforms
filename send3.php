<?php
// Replace this with your own email address
$to = "YOUR_EMAIL@example.com";
$subject = "New Zozo Airdrop Submission";

// Sanitize and collect POST data
$twitterFollow = isset($_POST['twitter_follow']) ? $_POST['twitter_follow'] : '';
$twitterID = isset($_POST['twitter_id']) ? trim($_POST['twitter_id']) : '';
$retweetCount = isset($_POST['retweet_count']) ? trim($_POST['retweet_count']) : '';
$walletAddress = isset($_POST['wallet_address']) ? trim($_POST['wallet_address']) : '';

// Validate required fields
if ($twitterID === '' || $retweetCount === '' || $walletAddress === '') {
    http_response_code(400);
    echo "Error: Missing required fields.";
    exit;
}

// Prepare email body
$body = "New Twitter Airdrop Submission:\n\n";
$body .= "Followed Zozo on X: $twitterFollow\n";
$body .= "Twitter ID: $twitterID\n";
$body .= "Retweet Count: $retweetCount\n";
$body .= "Wallet Address: $walletAddress\n";
$body .= "\nSubmitted on: " . date("Y-m-d H:i:s");

// Send email
$headers = "From: Zozo Airdrop <no-reply@yourdomain.com>";

if (mail($to, $subject, $body, $headers)) {
    echo "success";
} else {
    http_response_code(500);
    echo "Error: Failed to send email.";
}
?>
