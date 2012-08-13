<?php
/**
 * Доступ к данным о посещениях уроков учителей студентами
 */
class Data_Access_Visit {
    
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
     * Создаёт состояние посещения
     * @return Data_State_Item_Visit
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит посещение по ID
     * @param integer $id
     * @return Data_State_Item_Visit
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `id`,
                `lesson_id`,
                `part_id`,
                `student_id`,
                `teacher_id`
            FROM
                `visit`
            WHERE
                `id` = '.$id.'
            LIMIT
                1
            ;
        ');
        
        if (empty($row)) {
            throw new Data_Access_Exception('Посещения урока с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        
        $state = $this->rowToState($row);
        
        return $state;
        
    }
    
    /**
     * 
     * @param type $filter
     * @return Data_State_Item_Visit[]
     */
    public function readUsingFilter($filter) {
       
        $conditions = array();
        
        if (array_key_exists('lesson_id', $filter) && $filter['lesson_id'] > 0) {
            $conditions[] = 'AND `lesson_id` = '.$filter['lesson_id'];
        }
        if (array_key_exists('part_id', $filter) && $filter['part_id'] > 0) {
            $conditions[] = 'AND `part_id` = '.$filter['part_id'];
        }
        if (array_key_exists('student_id', $filter) && $filter['student_id'] > 0) {
            $conditions[] = 'AND `student_id` = '.$filter['student_id'];
        }
        if (array_key_exists('teacher_id', $filter) && $filter['teacher_id'] > 0) {
            $conditions[] = 'AND `teacher_id` = '.$filter['teacher_id'];
        }

        $rows = $this->storage->fetchRows('
            SELECT
                `id`,
                `lesson_id`,
                `part_id`,
                `student_id`,
                `teacher_id`
            FROM
                `visit`
            WHERE
                TRUE
                '.implode(' ', $conditions).'
            ;
        ');
        
        $states = $this->rowsToStates($rows);

        return $states;
        
    }
    
    /**
     * Сохраняет состояние посещения
     * @param Data_State_Item_Visit $state
     */
    public function update(Data_State_Item_Visit $state) {

        // Находим ID для посещения урока учителя студентом
        $this->secureId($state);
        
        // Сохраняем параметры посещения в базе данных
        
        $this->storage->query('
            UPDATE
                `visit`
            SET
                `lesson_id` = '.$state->getLessonId().',
                `part_id` = '.$state->getPartId().',
                `student_id` = '.$state->getStudentId().',
                `teacher_id` = '.$state->getTeacherId().'
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
  
    }
    
    /**
     * Удаляет состояние посещения
     * @param Data_State_Item_Visit $state
     */
    public function delete(Data_State_Item_Visit $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `visit`
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
        
        $state instanceof Data_State_Item_Visit;
        $state->setLessonId($row['lesson_id']);
        $state->setPartId($row['part_id']);
        $state->setStudentId($row['student_id']);
        $state->setTeacherId($row['teacher_id']);

        return $state;
        
    }
    
    /**
     * Снабжает состояние идентификатором, если его пока нет
     * @param Data_State_Item_Visit $state
     */
    private function secureId(Data_State_Item_Visit &$state) {
        
        $state instanceof Data_State_Item_TrackableInterface;

        if(!$state->hasId()) {

            $this->storage->query('
                INSERT INTO
                    `visit`
                SET
                    `id` = DEFAULT
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
            
        }
        
    }
    
}