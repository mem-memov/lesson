<?php
/**
 * Интерфейс почтового рассыльщика
 */
interface Service_Mailer_Interface {
    
    public function send(
        array $to, 
        $template = '',
        array $data = array(),
        array $attachments = array()
    );
    
}
