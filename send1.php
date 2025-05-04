<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['twitter_member'] !== 'yes') {
        http_response_code(400);
        echo "Twitter membership required";
        exit;
    }

    $to = "airdrop-meme@zozoofficial.org";
    $subject = "ZoZo Meme Airdrop Submission";
    $message = "ZoZo Twitter Member: Yes\n";
    $message .= "Twitter Handle: " . $_POST['twitter_handle'] . "\n";
    $message .= "Eligible Meme Coins: " . $_POST['meme_coin'] . "\n";
    $message .= "Amount of Meme Coins: " . $_POST['coin_amount'] . "\n";
    $message .= "Wallet Address Holding Meme Coins: " . $_POST['wallet_address'] . "\n";
    $message .= "Your MetaMask/Token Receiving Address: " . $_POST['metamask_address'] . "\n";
    $message .= "Email: " . $_POST['email'] . "\n";

    $headers = "From: no-reply@zozoofficial.org\r\n";

    mail($to, $subject, $message, $headers);

    echo "success";
    exit;
}
?>
