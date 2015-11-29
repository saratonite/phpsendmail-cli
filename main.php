<?php

 require(__DIR__.'/vendor/autoload.php');


/*
Initalize dotenv
 */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

echo getenv('SMTP_USERNAME');

/*

Composing mail 
 */
 $message = Swift_Message::newInstance();
 $message->setSubject("Sample message")
 	->setFrom([getenv('FROM_EMAIL_ID')=>getenv('FROM_EMAIL_NAME')])
 	->setTo([getenv('TO_EMAIL_ID')=>getenv('TO_EMAIL_NAME')])
 	->setBody('A Sample message');

/*
 Creating Transport 
 */
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
  ->setUsername(getenv('SMTP_USERNAME'))
  ->setPassword(getenv('SMTP_PASSWORD'));

/*
	Create the Mailer using your created Transport
 */

$mailer = Swift_Mailer::newInstance($transport);


if($mailer->send($message)){
	echo "Email Sended successfully \n";

}
else{
	echo "Error sending mail \n";
}
