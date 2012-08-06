<?php
/**
 * Доступ к данным счетов
 */
class Data_Access_Account {
    
    /**
     * Фабрика состояний
     * @var Data_State_Factory_Interface
     */
    protected $stateFactory;
    
    /**
     * Хранилище
     * @var Service_Storage_Interface
     */
    protected $storage;

    public function __construct(
        Data_State_Factory_Interface $stateFactory,
        Service_Storage_Interface $storage
    ) {
        
        $this->stateFactory = $stateFactory;
        $this->storage = $storage;
        
    }
    
    /**
     * Создаёт состояние счёта
     * @return Data_State_Account_Item
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние счёта по ID
     * @param integer $id
     * @return Data_State_Account_Item
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `amount`
            FROM
                `account`
            WHERE
                `id` = '.$id.'
            ;
        ');
        
        if (empty($row)) {
            throw new Data_Access_Exception('Счёта с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($id);
        
        $state instanceof Data_State_Account_Item;
        $state->setAmount($row['amount']);
        
        return $state;
        
    }
    
    
    /**
     * Находит состояние счёта по ID учителя
     * @param integer $teacherId
     * @return Data_State_Account_Item
     */
    public function readUsingTeacherId($teacherId) {
        
        return $item;
        
    }
    
    /**
     * Находит состояние счёта по ID ученика
     * @param integer $studentId
     * @return Data_State_Account_Item
     */
    public function readUsingStudentId($studentId) {
        
        return $item;
        
    }
    
    /**
     * Сохраняет состояние счёта
     * @param Data_State_Account_Item $state
     */
    public function update(Data_State_Account_Item $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;

        if(!$state->hasId()) {
            $this->storage->query('
                INSERT INTO
                    `account`
                SET
                    `id` = DEFAULT
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
        }
        
        $this->storage->query('
            UPDATE
                `account`
            SET
                `amount` = '.$state->getAmount().'
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
        
    }
    
    /**
     * Удаляет счёт
     * @param Data_State_Account_Item $state
     */
    public function delete(Data_State_Account_Item $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `account`
                WHERE
                    `id` = '.$state->getId().'
                ;
            ');
        
        }
        
    }
    
}