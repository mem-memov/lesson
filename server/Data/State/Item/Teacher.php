<?php
/**
 * Состояние учителя
 */
class Data_State_Item_Teacher extends Data_State_Item_Abstract {
    
    /**
     * Имя учителя
     * @var string
     */
    private $firstName = null;
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    public function getFirstName() {
        return $this->firstName;
    }
    
    /**
     * Фамилия учителя
     * @var string
     */
    private $lastName = null;
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    public function getLastName() {
        return $this->lastName;
    }

}