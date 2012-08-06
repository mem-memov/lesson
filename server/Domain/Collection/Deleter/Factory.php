<?php
class Domain_Collection_Deleter_Factory 
implements 
    Domain_Collection_Deleter_FactoryInterface 
{

    private $accessFactory;
    private $collectionFactory;
    private $containerFactory;
    
    public function __construct(
        Data_Access_FactoryInterface $accessFactory,
        Domain_Collection_FactoryInterface $collectionFactory,
        Domain_Collection_Container_FactoryInterface $containerFactory
    ) {

        $this->accessFactory = $accessFactory;
        $this->collectionFactory = $collectionFactory;
        $this->containerFactory = $containerFactory;

    }
    

    
    public function makeAccount() {
        
        return new Domain_Collection_Creator_Account(
            $this->accessFactory->makeAccount(),
            $this->containerFactory->makeContainer() 
        );

    }

    public function makeStudent() {
        
        return new Domain_Collection_Deleter_Student(
            $this->accessFactory->makeStudent(),
            $this->collectionFactory->makeAccountCollection(),
            $this->containerFactory->makeContainer(),
            $this->containerFactory->makeContainer() 
        );

    }

    public function makeTeacher() {
        
        return new Domain_Collection_Deleter_Teacher(
            $this->accessFactory->makeTeacher(),
            $this->collectionFactory->makeAccountCollection(),
            $this->containerFactory->makeContainer(),
            $this->containerFactory->makeContainer() 
        );

    }

}