<?php
/**
 * Показ счёта
 */
class Domain_Message_Account_Response_AccountPresentation 
implements
    Domain_Message_PresentingInterface
{

    /**
     * Сумма
     * @var integer
     */
    private $amount;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $amount сумма
     */
    public function __construct(
        $amount
    ) {
        
        $this->amount = $amount;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        return array(
            'amount' => $this->amount
        );
        
    }
    
}