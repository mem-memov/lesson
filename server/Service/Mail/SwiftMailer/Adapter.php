<?php
class Service_Mail_SwiftMailer_Adapter 
implements
    Service_Mail_Interface
{
    
    /**
     *
     * @var Swift_Mailer
     */
    private $mailer;
    
    public function __construct(
        Swift_Mailer $mailer
    ) {
        
        $this->mailer = $mailer;
        
    }
    
    public function send(
        array $from,
        array $to, 
        $subject = '',
        $body = '',
        array $attachments = array()
    ) {
        
        $message = Swift_Message::newInstance($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
        ;
        
        $result = $this->mailer->send($message);
        
    }
    
    
}