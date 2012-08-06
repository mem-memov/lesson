<?php
class Domain_Collection_Reader_Teacher implements Domain_Collection_Reader_Interface {
    
    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_CrudInterface 
     */
    protected $dataAccess;
    
    /**
     * Объект для создания элементов данной коллекции
     * @var Domain_Collection_Constructor_TeacherInterface 
     */
    protected $constructor;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Interface
     */
    protected $accountCollection;
    
    /**
     * Контейнер для состояний учителей
     * @var Domain_Collection_Container_Interface
     */
    protected $stateContainer;
    
    /**
     * Контейнер для счетов учителей
     * @var Domain_Collection_Container_Interface
     */
    protected $accountContainer;
    
    public function __construct(
        Data_Access_CrudInterface $dataAccess,
        Domain_Collection_Constructor_TeacherInterface $constructor,
        Domain_Collection_Interface $accountCollection,
        Domain_Collection_Container_Interface $stateContainer,
        Domain_Collection_Container_Interface $accountContainer
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->constructor = $constructor;
        $this->accountCollection = $accountCollection;
        $this->stateContainer = $stateContainer;
        $this->accountContainer = $accountContainer;
        
    }
    
    public function readUsingId($id) {
        
        $state = $this->dataAccess->readUsingId($id);
        $account = $this->accountCollection->readUsingTeacherId($id);
                
        $item =  $this->constructor->construct($state, $account);
        
        $this->stateContainer->add($item, $state);
        $this->accountContainer->add($item, $account);

        return $item;
    }
    
}