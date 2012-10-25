<?php
/**
 * Доступ к текстам
 */
class Data_Access_Text {
    
    /**
     * Фабрика состояний
     * @var Data_State_Factory_Interface
     */
    private $stateFactory;
    
    /**
     * Хранилище
     * @var Service_Storage_Interface
     */
    private $storage;

    public function __construct(
        Data_State_Factory_Interface $stateFactory,
        Service_Storage_Interface $storage
    ) {
        
        $this->stateFactory = $stateFactory;
        $this->storage = $storage;
        
    }
    
    /**
     * Создаёт состояние текста
     * @return Data_State_Item_Text
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние текста по ID
     * @param integer $id
     * @return Data_State_Item_Text
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `id`,
                `text`
            FROM
                `text`
            WHERE
                `id` = '.$id.'
            LIMIT
                1
            ;
        ');

        if (empty($row)) {
            throw new Data_Access_Exception('Текста с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->rowToState($row);
        
        return $state;
        
    }
    
    /**
     * Сохраняет состояние текста
     * @param Data_State_Item_Text $state
     */
    public function update(Data_State_Item_Text $state) {
        
        // Находим ID для текста
        $this->secureId($state);
        
        // Сохраняем параметры текста в базе данных
        $this->storage->query('
            UPDATE
                `text`
            SET
                `text` = "'.$state->getText().'"
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
  
    }
    
    /**
     * Удаляет состояние текста
     * @param Data_State_Item_Text $state
     */
    public function delete(Data_State_Item_Text $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `text`
                WHERE
                    `id` = '.$state->getId().'
                LIMIT
                    1
                ;
            ');
        
        }
        
    }
    
    private function rowToState(array $row) {
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($row['id']);
        
        $state instanceof Data_State_Item_Text;
        $state->setText($row['text']);
        
        return $state;
        
    }
    
    //TODO: удалить?
    private function fetchTypeId($state) {
        
        $typeId = $this->storage->fetchValue('
            SELECT
                `id`
            FROM
                `part_type`
            WHERE
                `type` = "'.get_type($state).'"
            LIMIT
                1
            ;
        ');
        
        if (is_null($typeId)) {
            $this->storage->query('
                INSERT INTO
                    `part_type`
                SET
                    `type` = "'.get_type($state).'"
                ;
            ');
            $typeId = $this->storage->lastId();
        }
        
        return $typeId;
        
    }
    
    /**
     * Снабжает состояние идентификатором, если его пока нет
     * @param Data_State_Item_Text $state
     */
    private function secureId(Data_State_Item_Text &$state) {
        
        $state instanceof Data_State_Item_TrackableInterface;

        if(!$state->hasId()) {

            $this->storage->query('
                INSERT INTO
                    `text`
                SET
                    `id` = DEFAULT
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
            
        }
        
    }
    
}