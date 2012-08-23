<?php
/**
 * Интерфейс почтового рассыльщика
 */
interface Service_Mailer_Interface {
    
    public function send(
        array $from,
        array $to, 
        $subject = '',
        $template = '',
        array $data = array(),
        array $attachments = array()
    );
    
}
