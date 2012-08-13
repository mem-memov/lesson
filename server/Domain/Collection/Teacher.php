<?php
class Domain_Collection_Teacher {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_User 
     */
    private $dataAccess;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Account
     */
    private $accountCollection;
    
    /**
     * Коллекция уроков
     * @var Domain_Collection_Lesson
     */
    private $lessonCollection;
    
    /**
     * Фабрика презентационных запросов
     * @var Domain_Message_Factory_PresentationRequest
     */
    private $presentationRequestFactory;
    
    /**
     * Состояния
     * @var array 
     */
    private $states;
    
    /**
     * Счета
     * @var array 
     */
    private $accounts;

    
    public function __construct(
        Data_Access_User $dataAccess,
        Domain_Collection_Account $accountCollection,
        Domain_Collection_Lesson $lessonCollection,
        Domain_Message_Factory_PresentationRequest $presentationRequestFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->accountCollection = $accountCollection;
        $this->lessonCollection = $lessonCollection;
        $this->presentationRequestFactory = $presentationRequestFactory;
        
        $this->states = array();
        $this->accounts = array();
        
    }
    
    public function create() {
        
        $state = $this->dataAccess->create();
        $account = $this->accountCollection->create();
        
        $item = $this->make($state,$account);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->accounts[spl_object_hash($item)] = $account;
        
        return $item;
        
    }
    
    public function readUsingId($id) {
        
        $state = $this->dataAccess->readUsingId($id);
        $account = $this->accountCollection->readUsingUserId($id);
        
        $item = $this->make($state,$account);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->accounts[spl_object_hash($item)] = $account;
        
        return $item;
        
    }

    public function readUsingLessonId($lessonId) {
        
        $state = $this->dataAccess->readUsingLessonId($lessonId);
        $account = $this->accountCollection->readUsingUserId($state->getId());
        
        $item = $this->make($state,$account);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->accounts[spl_object_hash($item)] = $account;
        
        return $item;
        
    }
    
    public function update($item) {
        
        $this->dataAccess->update( $this->states[spl_object_hash($item)] );
        
        $this->accountCollection->update( $this->accounts[spl_object_hash($item)] );
        
    }
    
    public function delete($item) {
        
        $this->dataAccess->delete( $this->states[spl_object_hash($item)] );
        unset($this->states[spl_object_hash($item)]);
        
        $this->accountCollection->delete( $this->accounts[spl_object_hash($item)] );
        unset($this->accounts[spl_object_hash($item)]);
        
    }
    

    
    private function make($state, $account) {
        
        return new Domain_Teacher(
            $state, 
            $account, 
            $this->lessonCollection,
            $this->presentationRequestFactory
        );
        
    }

}
