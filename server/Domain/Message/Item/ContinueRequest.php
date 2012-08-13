<?php
/**
 * Запрос на продолжение урока
 */
class Domain_Message_Item_ContinueRequest {
    
    /**
     * ID частей урока
     * @var integer[]
     */
    private $partIds;
    
    /**
     * Создаёт экземпляр класса
     * @param integer[] $partIds ID частей урока
     */
    public function __construct(array $partIds) {
        
        $this->partIds = $partIds;
        
    }
    
    /**
     * Сообщает ID частей урока
     * @return integer[]
     */
    public function getPartIds() {
        
        return $this->partIds;
        
    }
    
}