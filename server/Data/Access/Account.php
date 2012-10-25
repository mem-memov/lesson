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
     * @return Data_State_Item_Account
     */
    public function create() {
      
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние счёта по ID
     * @param integer $id
     * @return Data_State_Item_Account
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
        
        $state instanceof Data_State_Item_Account;
        $state->setAmount($row['amount']);
        
        return $state;
        
    }

    /**
     * Находит состояние счёта по ID прользователя
     * @param integer $userId
     * @return Data_State_Item_Account
     */
    public function readUsingUserId($userId) {
        
        $accountId = $this->storage->fetchValue('
            SELECT
                `account_id`
            FROM
                `user_account`
            WHERE
                `user_id` = '.$userId.'
            ;
        ');
        
        return $this->readUsingId($accountId);
        
    }
    
    /**
     * Сохраняет состояние счёта
     * @param Data_State_Item_Account $state
     */
    public function update(Data_State_Item_Account $state) {
        
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
     * @param Data_State_Item_Account $state
     */
    public function delete(Data_State_Item_Account $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `account`
                WHERE
                    `id` = '.$state->getId().'
                LIMIT
                    1
                ;
            ');
        
        }
        
    }
    
}