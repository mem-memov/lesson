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
        
        list($subject, $body) = $this->fillTemplate($template, $data);
        
        $message = Swift_Message::newInstance($subject)
            ->setFrom($this->senderEmail)
            ->setTo($to)
            ->setBody($body)
        ;
        
        $result = $this->mailer->send($message);
        
        return $result;
        
    }
    
    private function fillTemplate($template, array $data) {
        
        $path = __DIR__.'/../template/'.$template.'.php';

        if (!is_readable($path)) {
            throw new Service_Mailer_Exception('Шаблон письма '.$template.' не найден.');
        }
        
        ob_start();
        require($path);
        $body = ob_get_flush();
        
        return array($subject, $body); // тему письма нужно определять в шаблоне
        
    }
    
    
}