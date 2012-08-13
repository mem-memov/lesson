<?php
/**
 * Запрос на продолжение урока
 */
class Domain_Message_Item_ContinueRequest {
    
    /**
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Collection_Part $partCollection коллекция частей урока
     */
    public function __construct(
        Domain_Collection_Part $partCollection
    ) {
        
        $this->partCollection = $partCollection;
        
    }
    
    /**
     * Передаёт коллекцию частей урока
     * @return Domain_Collection_Part
     */
    public function getPartCollection() {
        
        return $this->partCollection;
        
    }
    
}