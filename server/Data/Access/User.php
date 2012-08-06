<?php
/**
 * Доступ к данным пользователей
 * Каждый пользователь может и обучать других, и учиться сам.
 */
class Data_Access_User {
    
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
     * Создаёт состояние пользователя
     * @return Data_State_Lesson_Item
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние пользователя по ID
     * @param integer $id
     * @return Data_State_User_Item
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `first_name`,
                `last_name`
            FROM
                `user`
            WHERE
                `id` = '.$id.'
            ;
        ');
        
        if (empty($row)) {
            throw new Data_Access_Exception('Пользователь с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($id);
        
        $state instanceof Data_State_User_Item;
        $state->setFirstName($row['first_name']);
        $state->setLastName($row['last_name']);
        
        return $state;
        
    }
    
    /**
     * Сохраняет состояние пользователя
     * @param Data_State_User_Item $state
     */
    public function update(Data_State_User_Item $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        $this->storage->query('
            UPDATE
                `user`
            SET
                `first_name` = '.$state->getFirstName().',
                `last_name` = '.$state->getLastName().'
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
        
    }
    
    /**
     * Удаляет состояние пользователя
     * @param Data_State_User_Item $state
     */
    public function delete(Data_State_User_Item $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `user`
                WHERE
                    `id` = '.$state->getId().'
                ;
            ');
        
        }
        
    }
    
}