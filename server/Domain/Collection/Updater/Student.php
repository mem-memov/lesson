<?php
class Domain_Collection_Updater_Student implements Domain_Collection_Updater_Interface{
    
    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_CrudInterface 
     */
    protected $dataAccess;
    
    /**
     * Объект для создания элементов данной коллекции
     * @var Domain_Collection_Constructor_StudentInterface 
     */
    protected $constructor;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Interface
     */
    protected $accountCollection;
    
    /**
     * Контейнер для состояний учеников
     * @var Domain_Collection_Container_Interface
     */
    protected $stateContainer;
    
    /**
     * Контейнер для счетов учеников
     * @var Domain_Collection_Container_Interface
     */
    protected $accountContainer;
    
    public function __construct(
        Data_Access_CrudInterface $dataAccess,
        Domain_Collection_Constructor_StudentInterface $constructor,
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
    
    public function update($item) {
        
        $this->dataAccess->update( $this->stateContainer->get($item) );
        $this->accountCollection->update( $this->accountContainer->get($item) );
        
    }
    
}