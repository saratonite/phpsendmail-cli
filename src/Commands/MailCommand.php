<?php
namespace saratonite\phpsendmail\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailCommand extends Command{
	protected function configure()
    {
        $this
            ->setName('mail')
            ->setDescription('Send email using SMTP');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('--- Started Mail Command ---');

        // Composing Mail
        $message = \Swift_Message::newInstance();
        $message->setSubject("Sample message")
        ->setFrom([getenv('FROM_EMAIL_ID')=>getenv('FROM_EMAIL_NAME')])
        ->setTo([getenv('TO_EMAIL_ID')=>getenv('TO_EMAIL_NAME')])
        ->setBody('A Sample message');

        // Creating Mail Transport object
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
        ->setUsername(getenv('SMTP_USERNAME'))
        ->setPassword(getenv('SMTP_PASSWORD'));

        // Send mail using mailer
        $mailer = \Swift_Mailer::newInstance($transport);

        if($mailer->send($message)){
         $output->writeln("Email Sended successfully");

        }
        else{
          $output->writeln("Error sending mail ");
        }
    }
}