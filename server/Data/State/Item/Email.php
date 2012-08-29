<?php
/**
 * Почтовый адрес
 */
class Data_State_Item_Email extends Data_State_Item_Abstract {
    
    /**
     * Адрес
     * @var string
     */
    private $email = null;
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }

    /**
     * ID пользователя
     * @var integer
     */
    private $userId = null;
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function getUserId() {
        return $this->userId;
    }
    
    /**
     * Флаг проверенного адреса
     * @var boolean
     */
    private $isConfirmed = null;
    public function setIsConfirmed($isConfirmed) {
        $this->isConfirmed = $isConfirmed;
    }
    public function getIsConfirmed() {
        return $this->isConfirmed;
    }
    
}
