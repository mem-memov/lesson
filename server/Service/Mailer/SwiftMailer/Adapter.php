<?php
class Service_Mailer_SwiftMailer_Adapter 
implements
    Service_Mailer_Interface
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
        $template = '',
        array $data = array(),
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