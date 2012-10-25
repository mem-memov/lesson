<?php
/**
 * Состояние ученика
 */
class Data_State_Item_Student extends Data_State_Item_Abstract {
    
    /**
     * Имя ученика
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
     * Фамилия ученика
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