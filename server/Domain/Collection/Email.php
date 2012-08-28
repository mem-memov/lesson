<?php
class Domain_Collection_Email {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Crud_Email 
     */
    private $dataAccess;
    
    /**
     * Состояния
     * @var array 
     */
    private $states;
    
    /**
     * Экземпляры
     * @var array
     */
    private $items;
    
    /**
     * Почтовый рассыльщик
     * @var Service_Mailer_Interface
     */
    private $mailer;
    
    public function __construct(
        Data_Access_Email $dataAccess,
        Service_Mailer_Interface $mailer
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->mailer = $mailer;
        
        $this->states = array();
        $this->items = array();
        
    }
    
    /**
     * Создаёт почтовый адрес
     * @param integer $userId
     * @param string $email
     * @return Domain_Email
     */
    public function create($userId, $email) {
        
        $state = $this->dataAccess->create();

        $state->setUserId($userId);
        $state->setEmail($email);
        
        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        
        return $item;
        
    }
    
    /**
     * Извлекает почтовый адрес по ID
     * @param integer $id
     * @return Domain_Lesson
     */
    public function readUsingId($id) {
        
        $existingItem = $this->findById($id);
        if ($existingItem !== false) {
            return $existingItem;
        }

        $state = $this->dataAccess->readUsingId($id);
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        return $item;
        
    }
    
    public function readUsingUserId($userId) {
        
        $states = $this->dataAccess->readUsingUserId($userId);
        
        $items = array();
        foreach ($states as $state) {
            
            $existingItem = $this->findById( $state->getId() );
            if ($existingItem !== false) {
                $items[] = $existingItem;
            } else {
                $item = $this->make($state);
                $this->states[spl_object_hash($item)] = $state;
                $this->items[spl_object_hash($state)] = $item;
                $items[] = $item;
            }
            
        }

        return $items;
        
    }
    
    public function update($item) {
        $this->dataAccess->update($this->states[spl_object_hash($item)]);
    }
    
    public function delete($item) {
        $this->dataAccess->delete($this->states[spl_object_hash($item)]);
        unset($this->states[spl_object_hash($item)]);
    }
    
    private function findById($id) {
        
        foreach ($this->states as $state) {
            
            $state instanceof Data_State_Item_TrackableInterface;

            if ($state->hasId() && $state->getId() === $id) {
                return $this->items[spl_object_hash($state)];
            }
            
        }
        
        return false;
        
    }
    
    private function make($state) {
        
        return new Domain_Email(
            $state,
            $this->mailer,
            $this->mailRequestFactory
        );
        
    }
    
}
