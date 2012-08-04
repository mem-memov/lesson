<?php
class Data_Access_Crud_Account extends Data_Access_Crud_Abstract {
    
    /**
     * Создаёт состояние счёта
     * @return Data_State_Account_Item
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * Находит состояние счёта по ID
     * @param type $id
     * @return Data_State_Account_Item
     * @throws Data_Access_Crud_Exception
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
            throw new Data_Access_Crud_Exception('Счёта с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->create();
        
        $state instanceof Data_State_Item_TrackableInterface;
        $state->setId($id);
        
        $state instanceof Data_State_Account_Item;
        $state->setAmount($row['amount']);
        
        return $state;
        
    }
    
    /**
     * Сохраняет состояние счёта
     * @param Data_State_Account_Item $state
     */
    public function update(Data_State_Account_Item $state) {
        
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
     * @param Data_State_Account_Item $state
     */
    public function delete(Data_State_Account_Item $state) {
        
        $state instanceof Data_State_Item_TrackableInterface;
        
        if($state->hasId()) {
        
            $this->storage->query('
                DELETE FROM
                    `account`
                WHERE
                    `id` = '.$state->getId().'
                ;
            ');
        
        }
        
    }
    
}
