<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $twitter_follow = $_POST['twitter_follow'];
    $twitter_id = $_POST['twitter_id'];
    $zozo_holder_duration = $_POST['zozo_holder_duration'];
    $can_prove_loss = $_POST['can_prove_loss'];
    $zozo_wallet = $_POST['zozo_wallet'];
    $crypto_loss_percent = $_POST['crypto_loss_percent'];
    $wallet_with_loss = $_POST['wallet_with_loss'];
    $loss_explanation = $_POST['loss_explanation'];
    $wallet_address = $_POST['wallet_address'];
    $email = $_POST['email'];
    
    // Validate crypto loss percentage
    if ($crypto_loss_percent < 50) {
        die("You are not eligible, you must have lost more than 50%.");
    }

    // Validate duration for ZOZO holder
    if (intval($zozo_holder_duration) < 30) {
        die("You are not eligible, you must have held ZOZO for more than 30 days.");
    }

    // If 'can_prove_loss' is 'no'
    if ($can_prove_loss == 'no') {
        die("You are not eligible, you must be able to prove your loss with documentation.");
    }

    // Prepare the email content
    $subject = "ZOZO Airdrop Information";
    $message = "
    ZOZO Airdrop Information:
    <br>Are you a follower on Twitter (X)?: $twitter_follow
    <br>Twitter ID: $twitter_id
    <br>ZOZO Holder Duration: $zozo_holder_duration
    <br>Can you prove your loss?: $can_prove_loss
    <br>ZOZO Wallet Address: $zozo_wallet
    <br>Crypto Loss Percentage: $crypto_loss_percent
    <br>Wallet Address with Loss: $wallet_with_loss
    <br>Loss Explanation: $loss_explanation
    <br>MetaMask/Token Receipt Wallet Address: $wallet_address
    <br>Email: $email
    ";

    // Prepare file attachments
    $attachments = '';
    if (isset($_FILES['proof_files'])) {
        $attachment_files = $_FILES['proof_files']['tmp_name'];
        foreach ($attachment_files as $file) {
            $attachments .= "<br><a href='" . $file . "'>Attachment File</a>";
        }
    }

    // Send email
    $to = 'airdrop-meme@zozoofficial.org';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@zozoofficial.org" . "\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "<div class='message'>Thank you. Your information has been received, and once reviewed, the token will be sent to your address if approved.</div>";
    } else {
        echo "<div class='message' style='color: red;'>Error sending email.</div>";
    }
}
?>
