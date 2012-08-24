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
    
    /**
     * Адрес почты, с которого уходят письма
     * @var string 
     */
    private $senderEmail;
    
    /**
     * Путь к папке с шаблонами
     * @var string
     */
    private $templateDirectory;
    
    public function __construct(
        Swift_Mailer $mailer,
        $senderEmail,
        $templateDirectory
    ) {
        
        $this->mailer = $mailer;
        $this->senderEmail = $senderEmail;
        $this->templateDirectory = $templateDirectory;
        
    }
    
    public function send(
        array $to, 
        $template = '',
        array $data = array(),
        array $attachments = array()
    ) {
        
        $message = Swift_Message::newInstance($subject)
            ->setFrom($this->senderEmail)
            ->setTo($to)
            ->setBody($body)
        ;
        
        $result = $this->mailer->send($message);
        
    }
    
    private function fillTemplate($template, array $data) {
        
    }
    
    
}