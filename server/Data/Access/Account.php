<?php
class Data_Access_Account extends Data_Access_Abstract {
    
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
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
            throw new Data_Access_Exception('Счёта с идентификатором - '.$id.' не существует. Чтение невозможно.');
        }
        
        $state = $this->create();
        
        $state instanceof Data_State_TrackableInterface;
        $state->setId($id);
        
        $state instanceof Data_State_Account_Item;
        $state->setAmount($row['amount']);
        
        return $state;
        
    }
    
    public function update(Data_State_Account $state) {
        
        $state instanceof Data_State_TrackableInterface;

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
    
    public function delete(Data_State_Account $state) {
        
        $state instanceof Data_State_TrackableInterface;
        
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
