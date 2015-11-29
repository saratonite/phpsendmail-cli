#!/usr/bin/env php
<?php

 require(__DIR__.'/../vendor/autoload.php');

 // import the Symfony Console Application 
use Symfony\Component\Console\Application; 


/*
Initalize dotenv
 */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Console
// set to run indefinitely if needed
set_time_limit(0);

/* Optional. It’s better to do it in the php.ini file */
//date_default_timezone_set('America/Los_Angeles'); 




$app = new Application();
$app->add(new \saratonite\phpsendmail\Commands\MailCommand());
$app->run();
// End Console