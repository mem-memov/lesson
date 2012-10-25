<?php
class Domain_Message_Account_Factory {

    /**
     * Создаёт показ счета
     * @param integer $amount сумма
     * @return Domain_Message_Account_Response_AccountPresentation
     */
    public function makeAccountPresentation(
        $amount
    ) {
        
        return new Domain_Message_Account_Response_AccountPresentation(
            $amount
        );
        
    }
    
}