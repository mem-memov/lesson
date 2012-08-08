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
                `lesson`.`title` AS `title`,
                `lesson`.`description` AS `description`,
                `teacher_lesson`.`teacher_id` AS `teacher_id`
            FROM
                `lesson`
                LEFT JOIN `teacher_lesson` ON (`lesson`.`id` = `teacher_lesson`.`lesson_id`)
            WHERE
                `id` = '.$id.'
            LIMIT
                1
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
                `lesson`.`title` AS `title`,
                `lesson`.`description` AS `description`,
                `teacher_lesson`.`teacher_id` AS `teacher_id`
            FROM
                `lesson`
                LEFT JOIN `teacher_lesson` ON (`lesson`.`id` = `teacher_lesson`.`lesson_id`)
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
            
            // Находим ID для урока
            
            $this->storage->query('
                INSERT INTO
                    `lesson`
                SET
                    `id` = DEFAULT
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
            
            // Связываем урок с учиелем
            
            if ($state->getTeacherId() < 1) {
                throw new Data_Access_Exception('Урок должен быть связан с учителем.');
            }
            
            $this->storage->query('
                INSERT INTO
                    `teacher_lesson`
                SET
                    `teacher_id` = "'.$state->getTeacherId().'",
                    `lesson_id` = "'.$state->getId().'"
                ;
            ');
            
        }
        
        // Сохраняем параметры урока в базе данных
        
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
        
            $this->storage->query('
                DELETE FROM
                    `teacher_lesson`
                WHERE
                    `lesson_id` = '.$state->getId().'
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
        $state->setTeacherId($row['teacher_id']);
        
        return $state;
        
    }
    
}
