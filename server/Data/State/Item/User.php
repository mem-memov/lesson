<?php
/**
 * Состояние пользователя
 */
class Data_State_User_Item extends Data_State_Item_Abstract {
    
    /**
     * Имя пользователя
     * @var string
     */
    private $firstName;
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    public function getFirstName() {
        return $this->firstName;
    }
    
    /**
     * Фамилия пользователя
     * @var string
     */
    private $lastName;
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    public function getLastName() {
        return $this->lastName;
    }
    
}
