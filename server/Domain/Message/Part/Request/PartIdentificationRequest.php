<?php
/**
 * Запрос идентификатора части урока
 */
class Domain_Message_Part_Request_PartIdentificationRequest {
    
    /**
     * Состояние посещения
     * @var Data_State_Item_Visit
     */
    private $visitState;
    
    /**
     * Создаёт экземпляр класса
     * @param Data_State_Item_Visit $visitState состояние посещения
     */
    public function __construct(
        Data_State_Item_Visit $visitState
    ) {
        
        $this->visitState = $visitState;
        
    }
    
    /**
     * Передаёт ID части урока
     * @return integer $partId ID части урока
     */
    public function setPartId($partId) {
        
        $this->visitState->setPartId($partId);
        
    }
    
}