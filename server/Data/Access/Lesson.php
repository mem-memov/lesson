<?php
class Data_Access_Lesson {
    
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
     * Создаёт состояние урока
     * @return Data_State_Lesson_Item
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние урока по ID
     * @param integer $id
     * @return Data_State_Lesson_Item
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `title`
            FROM
                `lesson`
            WHERE
                `id` = '.$id.'
            ;
        ');
        
        if (empty($row)) {
            throw new Data_Access_Exception('Урока с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($id);
        
        $state instanceof Data_State_Lesson_Item;
        $state->setTitle($row['title']);
        
        return $state;
        
    }
    
    public function readUsingTeacherId($teacherId) {
        
        
        
    }
    
    /**
     * Сохраняет состояние урока
     * @param Data_State_Lesson_Item $state
     */
    public function update(Data_State_Lesson_Item $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;

        if(!$state->hasId()) {
            $this->storage->query('
                INSERT INTO
                    `lesson`
                SET
                    `id` = DEFAULT
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
        }
        
        $this->storage->query('
            UPDATE
                `lesson`
            SET
                `title` = '.$state->getTitle().'
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
        
    }
    
    /**
     * Удаляет состояние урока
     * @param Data_State_Lesson_Item $state
     */
    public function delete(Data_State_Lesson_Item $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `lesson`
                WHERE
                    `id` = '.$state->getId().'
                ;
            ');
        
        }
        
    }
    
}
