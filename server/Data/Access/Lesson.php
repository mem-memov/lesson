<?php
/**
 * Доступ к данным уроков
 */
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
     * @return Data_State_Item_Lesson
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние урока по ID
     * @param integer $id
     * @return Data_State_Item_Lesson
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `title`,
                `description`
            FROM
                `lesson`
            WHERE
                `id` = '.$id.'
            ;
        ');
        
        if (empty($row)) {
            throw new Data_Access_Exception('Урока с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->rowToState($row);
        
        return $state;
        
    }
    
    public function readUsingFilter($filter) {

        $rows = $this->storage->fetchRows('
            SELECT
                `title`,
                `description`
            FROM
                `lesson`
            WHERE
                TRUE
            ;
        ');
        
        $states = array();
        foreach ($rows as $row) {
            $states[] = $this->rowToState($row);
        }
        
        return $states;
        
    }
    
    /**
     * Сохраняет состояние урока
     * @param Data_State_Item_Lesson $state
     */
    public function update(Data_State_Item_Lesson $state) {
        
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
                `title` = "'.$state->getTitle().'",
                `description` = "'.$state->getDescription().'"
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
        
    }
    
    /**
     * Удаляет состояние урока
     * @param Data_State_Item_Lesson $state
     */
    public function delete(Data_State_Item_Lesson $state) {
        
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
    
    private function rowToState($row) {
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($id);
        
        $state instanceof Data_State_Item_Lesson;
        $state->setTitle($row['title']);
        $state->setDescription($row['description']);
        
        return $state;
        
    }
    
}
