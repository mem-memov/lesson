<?php
/**
 * Доступ к частям урока
 */
class Data_Access_Part {
    
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
     * @return Data_State_Item_Part
     */
    public function create() {
      
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние части урока по ID
     * @param integer $id
     * @return Data_State_Item_Part
     * @throws Data_Access_Exception
     */
    public function readUsingId($id) {
        
        $row = $this->storage->fetchRow('
            SELECT
                `id`,
                `lesson_id`,
                `order`,
                `price`
            FROM
                `part`
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
        $this->addWidgetsToState($state);
        
        return $state;
        
    }
    
    public function readUsingFilter($filter) {
       
        $conditions = array();

        $rows = $this->storage->fetchRows('
            SELECT
                `id`,
                `lesson_id`,
                `order`,
                `price`
            FROM
                `part`
            WHERE
                TRUE
                '.implode(' ', $conditions).'
            ;
        ');
        
        $states = $this->rowsToStates($rows);
        $this->addWidgetsToStates($states);

        return $states;
        
    }
    
    /**
     * Сохраняет состояние части урока
     * @param Data_State_Item_Part $state
     */
    public function update(Data_State_Item_Part $state) {
        
        // Находим ID для части урока
        $this->secureId($state);

        // Сохраняем параметры части урока в базе данных
        $this->storage->query('
            UPDATE
                `part`
            SET
                `lesson_id` = '.$state->getLessonId().',
                `order` = '.$state->getOrder().',
                `price` = '.$state->getPrice().'
            WHERE
                `id` = '.$state->getId().'
            ;
        ');
        
        // Привязываем к учебным пособиям
        $this->updateWidgets($state);
  
    }
    
    /**
     * Удаляет состояние части урока
     * @param Data_State_Item_Part $state
     */
    public function delete(Data_State_Item_Part $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `part`
                WHERE
                    `id` = '.$state->getId().'
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
        
        $state instanceof Data_State_Item_Part;
        $state->setLessonId($row['lesson_id']);
        $state->setOrder($row['order']);
        $state->setPrice($row['price']);
        
        return $state;
        
    }
    
    /**
     * Снабжает состояние идентификатором, если его пока нет
     * @param Data_State_Item_Part $state
     */
    private function secureId(Data_State_Item_Part &$state) {
        
        $state instanceof Data_State_Item_TrackableInterface;

        if(!$state->hasId()) {

            $this->storage->query('
                INSERT INTO
                    `part`
                SET
                    `id` = DEFAULT
                ;
            ');
            $id = $this->storage->lastId();
            $state->setId($id);
            
        }
        
    }
    
    /**
     * Добавляет ID пособий и их видов к состоянию части урока
     * @param Data_State_Item_Part $state
     */
    private function addWidgetsToState($state) {
        
        $columns = $this->storage->fetchColumns('
            SELECT
                `widget_id`,
                `widget_type_id`
            FROM
                `part_widget`
            WHERE
                `part_id` = '.$state->getId().'
            ;
        ', array('widget_id', 'widget_type_id'));

        $state->setWidgetIds($columns['widget_id']);
        $state->setWidgetTypeIds($columns['widget_type_id']);

    }
    
    /**
     * Добавляет ID пособий к нескольким состояниям частей уроков
     * @param Data_State_Item_Part[] $states
     */
    private function addWidgetsToStates(array &$states) {
        
        $ids = array();
        foreach($states as $state) {
            
            $state instanceof Data_State_Item_Lesson;
            $ids[] = $state->getId();
            
        }
        
        $rows = $this->storage->fetchRows('
            SELECT
                `part_id`,
                `widget_id`,
                `widget_type_id`
            FROM
                `part_widget`
            WHERE
                `part_id` IN ('.implode(', ', $ids).')
            ;
        ');

        $widgetIds = array();
        $widgetTypeIds = array();
        foreach ($rows as $row) {

            if ( !array_key_exists($row['part_id'], $widgetIds) ) {
                $widgetIds[$row['part_id']] = array();
                $widgetTypeIds[$row['part_id']] = array();
            }

            $widgetIds[$row['part_id']][] = $row['widget_id'];
            $widgetTypeIds[$row['part_id']][] = $row['widget_type_id'];

        }

        foreach ($states as &$state) {

            $state instanceof Data_State_Item_Part;

            if ( array_key_exists($state->getId(), $widgetIds) ) {

                $state->setWidgetIds( $widgetIds[$state->getId()] );
                $state->setWidgetTypeIds( $widgetTypeIds[$state->getId()] );

            } else {

                $state->setWidgetIds(array());
                $state->setWidgetTypeIds(array());

            }

        }

        return $states;
        
    }
    
    private function updateWidgets(Data_State_Item_Part $state) {
        
        // Получаем старый список пособий, относящихся к данной части урока
        $rows = $this->storage->fetchRows('
            SELECT
                `widget_id`,
                `widget_type_id`
            FROM
                `part_widget`
            WHERE
                `part_id` = '.$state->getId().'
            ;
        ');
        
        // Получаем новый список пособий, относящихся к данной части урока
        $newWidgetIds = $state->getWidgetIds();
        $newWidgetTypeIds = $state->getWidgetTypeIds();
       
        // Составляем список пособий на удаление
        $widgetIdsToBeDeleted = array();
        $widgetTypeIdsToBeDeleted = array();
        foreach ($rows as $row) {
            
            $isFound = false;
            
            foreach ($newWidgetIds as $index => $newWidgetId) {

                if (
                    $row['widget_id'] == $newWidgetId
                    && $row['widget_type_id'] == $newWidgetTypeIds[$index]
                ) {
                    $isFound = true;
                    break;
                }

            }
            
            // Пособия из старого списка, которые не найдены в новом, нужно удалить.
            if (!$isFound) {
                
                $widgetIdsToBeDeleted[] = $row['widget_id'];
                $widgetTypeIdsToBeDeleted = $row['widget_type_id'];
                
            }
            
        }
        
        // Составляем список пособий на вставку
        $widgetIdsToBeInserted = array();
        $widgetTypeIdsToBeInserted = array();
        foreach ($newWidgetIds as $index => $newWidgetId) {
            
            $isFound = false;
            
            foreach ($rows as $row) {
                
                if (
                    $newWidgetId == $row['widget_id']
                    && $newWidgetTypeIds[$index] == $row['widget_type_id']
                ) {
                    $isFound = true;
                    break;
                }

            }
            
            // Пособия из нового списка, которые не найдены в старом списке обновления, нужно вставить в данную часть урока
            if (!$isFound) {
                $widgetIdsToBeInserted[] = $newWidgetId;
                $widgetTypeIdsToBeInserted[] = $newWidgetTypeIds[$index];
            }
            
        }

        // Убираем пособия из данной части урока
        if (!empty($widgetIdsToBeDeleted)) {
            
            $deletes = array();
            foreach ($widgetIdsToBeDeleted as $deleteIndex => $widgetIdToBeDeleted) {
                $deletes[] = '
                    (
                        `part_id` = '.$state->getId().'
                         AND `widget_type_id` = '.$widgetTypeIdsToBeDeleted[$deleteIndex].'
                         AND `widget_id` = '.$widgetIdToBeDeleted.'
                     )
                ';
            }
            
            $this->storage->query('
                DELETE FROM
                    `part_widget`
                WHERE
                    '.implode(' OR ', $deletes).'
                ;
            ');
            
        }
        
        // Добавляем пособия к данной части урока
        if (!empty($widgetIdsToBeInserted)) {
            
            $inserts = array();
            foreach ($widgetIdsToBeInserted as $insertIndex => $widgetIdToBeInserted) {
                $inserts[] = '('.
                                    $state->getId().','.
                                    $widgetTypeIdsToBeInserted[$insertIndex ].','.
                                    $widgetIdToBeInserted.
                ')';
            }
        
            $this->storage->query('
                INSERT INTO
                    `part_widget` (
                                    `part_id`, 
                                    `widget_type_id`, 
                                    `widget_id`
                     )
                VALUES
                    '.implode(', ', $inserts).'
                ;
            ');
        
        }

    }
    
}