<?php
namespace saratonite\phpsendmail\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use saratonite\phpsendmail\Parser\MarkdownParser;

class MailCommand extends Command{
	protected function configure()
    {
        $this
            ->setName('mail')
            ->setDescription('Send email using SMTP')
            ->addArgument(
                'to',
                InputArgument::OPTIONAL,
                'Recipient Eamil Address'
                );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('--- Started Mail Command ---');

        $to = $input->getArgument('to');

        if(!$to){
            $to = getenv('TO_EMAIL_ID');
        }


        // Composing Mail
        
        $parser = new MarkdownParser();

        $file_content = file_get_contents(__DIR__."/../../mails/mail.md");
        $mail_content = $parser->parse($file_content);


        $message = \Swift_Message::newInstance();
        $message->setSubject("Sample message")
        ->setFrom([getenv('FROM_EMAIL_ID')=>getenv('FROM_EMAIL_NAME')])
        ->setTo([$to=>getenv('TO_EMAIL_NAME')])
        // setContentType('text/html');
        ->setBody($mail_content,'text/html');

        // Creating Mail Transport object
        $transport = \Swift_SmtpTransport::newInstance(getenv('SMTP_HOST'), getenv('SMTP_PORT'),getenv('SMTP_ENC'))
        ->setAuthMode('LOGIN')
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