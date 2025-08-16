<?php
require 'vendor/autoload.php';

SparkPost::setConfig(getEnv("687f9916b3d128aa7db8e7c9c0f93066c73ba879"));

try {
    // Build your email and send it!
    Transmission::send(array('campaign'=>'first-mailing',
        'from'=>'jacob@thewatnwhere16.info' . getEnv("SPARKPOST_SANDBOX_DOMAIN"), // 'test@sparkpostbox.com'
        'subject'=>'Hello from php-sparkpost',
        'html'=>'<html><body><h1>Congratulations, {{name}}!</h1><p>You just sent your very first mailing!</p></body></html>',
        'text'=>'Congratulations, {{name}}!! You just sent your very first mailing!',
        'substitutionData'=>array('name'=>'YOUR FIRST NAME'),
        'recipients'=>array(array('address'=>array('name'=>'Gary N Swan', 'email'=>'swann.gary13@gmail.com' )))
    ));

    echo 'Woohoo! You just sent your first mailing!';
} catch (Exception $err) {
    echo 'Whoops! Something went wrong';
    var_dump($err);
}

?>