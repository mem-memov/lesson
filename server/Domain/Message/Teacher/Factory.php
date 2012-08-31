<?php
class Domain_Message_Teacher_Factory {

    /**
     * Создаёт презентационный запрос
     * @param integer $studentId ID ученика
     * @param Domain_Teacher $teacher учитель
     * @return Domain_Message_Lesson_Request_PresentationRequest
     */
    public function makePresentationRequest(
        $studentId,
        Domain_Teacher $teacher
    ) {
        
        return new Domain_Message_Lesson_Request_PresentationRequest($studentId, $teacher);
        
    }
    
    /**
     * Создаёт запрос на получение денег за показ части урока
     * @param Domain_Account $account счёт
     * @param Domain_Collection_Account $accountCollection коллекция счетов
     * @return Domain_Message_Part_Request_PartMoneyRequest
     */
    public function makePartMoneyRequest(
        Domain_Account $account,
        Domain_Collection_Account $accountCollection
    ) {
        
        return new Domain_Message_Part_Request_PartMoneyRequest($account, $accountCollection);
        
    }
    
}