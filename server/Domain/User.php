<?php
class Domain_User {

    /**
     * Сосояние
     * @var Data_State_Item_User 
     */
    private $state;

    /**
     * Коллекция почтовых адресов
     * @var Domain_Collection_Email 
     */
    private $emailCollection;
    
    /**
     * Фабрика инспекторов почтовых адресов
     * @var Domain_Message_Factory_EmailInspector
     */
    private $emailInspectorFactory;
    
    public function __construct(
        Data_State_Item_User $state,
        Domain_Collection_Email $emailCollection,
        Domain_Message_Factory_EmailInspector $emailInspectorFactory
    ) {
        
        $this->state = $state;
        $this->emailCollection = $emailCollection;
        $this->emailInspectorFactory = $emailInspectorFactory;
        
    }

    public function acquireMailBox($emailAddress) {
        
        $email = $this->emailCollection->create( $this->state->getId(), $emailAddress );
        
        $this->emailCollection->update( $email );
        
    }

}
