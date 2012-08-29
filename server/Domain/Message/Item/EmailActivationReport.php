<?php
/**
 * Отчёт об активации адреса электронной почты
 */
class Domain_Message_Item_EmailActivationReport {
    
    /**
     * Проблемы, возникшие при активации адреса электронной почты
     * @var Domain_Exception[]
     */
    private $problems;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Exception[] $problems проблемы, возникшие при активации адреса электронной почты
     */
    public function __construct(
        array $problems = array()
    ) {
        
        $this->problems = $problems;
        
    }
    
    /**
     * Сообщает о том, возникли при активации адреса электронной почты
     * @return boolean
     */
    public function hasProblems() {
        
        return !empty($this->problems);
        
    }
    
    /**
     * Сообщает о проблемах, которые возникли при активации адреса электронной почты
     * @return Domain_Exception[]
     */
    public function getProblems() {
        
        return $this->problems;
        
    }
    
}