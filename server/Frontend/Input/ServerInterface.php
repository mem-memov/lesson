<?php
/**
 * Интерфейс менеджер сведений о сервере
 */
interface Frontend_Input_ServerInterface {
    
    public function getRequestUri();
    
    public function getHttpHost();
    
}