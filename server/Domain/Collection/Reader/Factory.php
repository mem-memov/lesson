<?php
class Domain_Collection_Reader_Factory 
implements 
    Domain_Collection_Reader_FactoryInterface 
{

    private $accessFactory;
    private $constructorFactory;
    private $collectionFactory;
    private $containerFactory;
    
    public function __construct(
        Data_Access_FactoryInterface $accessFactory,
        Domain_Collection_Constructor_FactoryInterface $constructorFactory,
        Domain_Collection_FactoryInterface $collectionFactory,
        Domain_Collection_Container_FactoryInterface $containerFactory
    ) {

        $this->accessFactory = $accessFactory;
        $this->constructorFactory = $constructorFactory;
        $this->collectionFactory = $collectionFactory;
        $this->containerFactory = $containerFactory;

    }
    

    
    public function makeAccount() {
        
        return new Domain_Collection_Creator_Account(
            $this->accessFactory->makeAccount(),
            $this->constructorFactory->makeAccount(),
            $this->containerFactory->makeContainer() 
        );

    }

    public function makeStudent() {
        
        return new Domain_Collection_Creator_Student(
            $this->accessFactory->makeStudent(),
            $this->constructorFactory->makeStudent(),
            $this->collectionFactory->makeAccountCollection(),
            $this->containerFactory->makeContainer(),
            $this->containerFactory->makeContainer() 
        );

    }

    public function makeTeacher() {
        
        return new Domain_Collection_Creator_Teacher(
            $this->accessFactory->makeTeacher(),
            $this->constructorFactory->makeTeacher(),
            $this->collectionFactory->makeAccountCollection(),
            $this->containerFactory->makeContainer(),
            $this->containerFactory->makeContainer() 
        );

    }

    public function makeTeacherUsingLessinId() {
        
        return new Domain_Collection_Creator_Teacher(
            $this->accessFactory->makeTeacher(),
            $this->constructorFactory->makeTeacher(),
            $this->collectionFactory->makeAccountCollection(),
            $this->containerFactory->makeContainer(),
            $this->containerFactory->makeContainer() 
        );

    }

}