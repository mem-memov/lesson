<?php
class Domain_Collection_User {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_User 
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
     * Коллекция почтовых адресов
     * @var Domain_Collection_Email 
     */
    private $emailCollection;
    
    /**
     * Фабрика помошников активации адреса электронной почты
     * @var Domain_Collaborator_Factory_EmailActivation
     */
    private $emailActivationFactory;
    
    /**
     * Фабрика инспекторов почтовых адресов
     * @var Domain_Message_Factory_EmailInspector
     */
    private $emailInspectorFactory;
    
    /**
     * Фабрика запросов на перемещение почтового сообщения
     * @var Domain_Message_Factory_MailRequest
     */
    private $mailRequestFactory;
    
    /**
     * Фабрика отчётов о подтверждении владения адресом электронной почты
     * @var Domain_Message_Factory_EmailConfirmationReport
     */
    private $emailConfirmationReportFactory;
    
    public function __construct(
        Data_Access_User $dataAccess,
        Domain_Collection_Email $emailCollection,
        Domain_Collaborator_Factory_EmailActivation $emailActivationFactory,
        Domain_Message_Factory_EmailInspector $emailInspectorFactory,
        Domain_Message_Factory_MailRequest $mailRequestFactory,
        Domain_Message_Factory_EmailConfirmationReport $emailConfirmationReportFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->emailCollection = $emailCollection;
        $this->emailActivationFactory = $emailActivationFactory;
        $this->emailInspectorFactory = $emailInspectorFactory;
        $this->mailRequestFactory = $mailRequestFactory;
        $this->emailConfirmationReportFactory = $emailConfirmationReportFactory;
        
        $this->states = array();
        $this->items = array();
        
    }
    
    public function create() {
        
        $state = $this->dataAccess->create();
        
        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        
        return $item;
        
    }
    
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
    
    public function readUsingEmail($email) {
        
        $state = $this->dataAccess->readUsingEmail($email);
        
        if (is_null($state)) {
            return $state;
        }

        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        
        return $item;
        
    }
    
    public function update($item) {
        
        $this->dataAccess->update( $this->states[spl_object_hash($item)] );
        
    }
    
    public function delete($item) {
        
        $this->dataAccess->delete( $this->states[spl_object_hash($item)] );
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
        
        return new Domain_User(
            $state,
            $this->emailCollection,
            $this->emailActivationFactory,
            $this->emailInspectorFactory,
            $this->mailRequestFactory,
            $this->emailConfirmationReportFactory
        );
        
    }

}
