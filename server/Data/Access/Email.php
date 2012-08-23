<?php
/**
 * Доступ к данным почтовых адресов
 */
class Data_Access_Email {
    
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
     * Создаёт состояние почтового адреса
     * @return Data_State_Item_Email
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние почтового адреса по ID
     * @param integer $id
     * @return Data_State_Item_Email
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `id`,
                `user_id`,
                `email`
            FROM
                `email`
            WHERE
                `id` = '.$id.'
            LIMIT
                1
            ;
        ');
        
        if (empty($row)) {
            throw new Data_Access_Exception('Почтового адреса с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        
        $state = $this->rowToState($row);
        
        return $state;
        
    }
    
    public function readUsingUserId($userId) {

        $rows = $this->storage->fetchRows('
            SELECT
                `id`,
                `user_id`,
                `email`
            FROM
                `email`
            WHERE
                `user_id` = '.$userId.'
            ;
        ');
        
        $states = $this->rowsToStates($rows);

        return $states;
        
    }
    
    /**
     * Сохраняет состояние почтового адреса
     * @param Data_State_Item_Email $state
     */
    public function update(Data_State_Item_Email $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;

        if(!$state->hasId()) {
            
            // Находим ID для почтового адреса
            
            $this->storage->query('
                INSERT INTO
                    `email`
                SET
                    `id` = DEFAULT
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
            
            // проверяем, что почовый адрес связан с пользователем
            
            if ($state->getUserId() < 1) {
                throw new Data_Access_Exception('Почтовый адрес должен быть связан с пользователем.');
            }
            
        }
        
        // Сохраняем параметры почтового адреса в базе данных
        
        $this->storage->query('
            UPDATE
                `email`
            SET
                `email` = "'.$state->getEmail().'",
                `user_id` = "'.$state->getUserId().'"
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
  
    }
    
    /**
     * Удаляет состояние почтового адреса
     * @param Data_State_Item_Email $state
     */
    public function delete(Data_State_Item_Email $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `email`
                WHERE
                    `id` = '.$state->getId().'
                LIMIT
                    1
                ;
            ');

        }
        
    }
    
    private function rowsToStates(array $rows) {
        
        $states = array();

        foreach ($rows as $row) {
            $states[] = $this->rowToState($row);
        }
        
        return $states;
        
    }
    
    private function rowToState(array $row) {
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($row['id']);
        
        $state instanceof Data_State_Item_Email;
        $state->setEmail($row['email']);
        $state->setUserId($row['user_id']);
        
        return $state;
        
    }

}
