<?php
class Domain_Message_Factory_AccountPresentation {
    
    /**
     * Создаёт сообщение
     * @param integer $amount сумма
     * @return Domain_Message_Account_Response_AccountPresentation
     */
    public function makeMessage(
        $amount
    ) {
        
        return new Domain_Message_Account_Response_AccountPresentation(
            $amount
        );
        
    }
    
}