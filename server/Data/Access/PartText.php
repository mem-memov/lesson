<?php
/**
 * Доступ к текстовым частям урока
 */
class Data_Access_PartText {
    
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
     * Создаёт состояние части урока
     * @return Data_State_Item_PartText
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние текстовой части урока по ID
     * @param integer $id
     * @return Data_State_Item_Part_Text
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `id`,
                `text`
            FROM
                `part_text`
            WHERE
                `part`.`id` = '.$id.'
            LIMIT
                1
            ;
        ');

        if (empty($row)) {
            throw new Data_Access_Exception('Части урока с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->rowToState($row);
        
        return $state;
        
    }
    
    /**
     * Сохраняет состояние текстовой части урока
     * @param Data_State_Item_PartText $state
     */
    public function update(Data_State_Item_PartText $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;

        if(!$state->hasId()) {
            
            // Находим ID и записываем тип для части урока
            
            $typeId = $this->fetchTypeId($state);
            $this->storage->query('
                INSERT INTO
                    `part`
                SET
                    `id` = DEFAULT,
                    `type_id` = '.$typeId.'
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
            
            // Связываем часть с уроком
            
            if ($state->getLessonId() < 1) {
                throw new Data_Access_Exception('Часть урока должна быть связана с уроком.');
            }
            
            $this->storage->query('
                INSERT INTO
                    `lesson_part`
                SET
                    `lesson_id` = '.$state->getLessonId().',
                    `part_id` = '.$state->getId().'
                ;
            ');
            
        }
        
        // Сохраняем параметры урока в базе данных
        
        $this->storage->query('
            UPDATE
                `part_text`
            SET
                `text` = "'.$state->getText().'"
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
  
    }
    
    /**
     * Удаляет состояние текстовой части урока
     * @param Data_State_Item_PartText $state
     */
    public function delete(Data_State_Item_PartText $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `part`
                WHERE
                    `id` = '.$state->getId().'
                ;
            ');
        
            $this->storage->query('
                DELETE FROM
                    `part_text`
                WHERE
                    `id` = '.$state->getId().'
                ;
            ');
        
            $this->storage->query('
                DELETE FROM
                    `lesson_part`
                WHERE
                    `part_id` = '.$state->getId().'
                ;
            ');
        
        }
        
    }
    
    private function rowToState(array $row) {
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($row['id']);
        
        $state instanceof Data_State_Item_Lesson;
        $state->setTitle($row['type']);
        $state->setDescription($row['text']);
        
        return $state;
        
    }
    
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
    
}