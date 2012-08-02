<?php
class Frontend_Action_Chain {
    
    /**
     * Запрос
     * 
     * @var type 
     */
    protected $request;
    
    /**
     * Фабрика ответов
     * 
     * @var Frontend_Response_Factory
     */
    protected $responseFactory;

    public function __construct(
        $request,
        Frontend_Response_Factory $responseFactory
    ) {
        
        $this->request = $request;
        $this->responseFactory = $responseFactory;
        
    }
    
    public function linkStart() {
        
        $action = new Frontend_Action_Start($this->request, $this->responseFactory, $this);
        
        return $action->run();
        
    }
    
    public function linkProjectPresentation() {
        
        $action = new Frontend_Action_ProjectPresentation($this->request, $this->responseFactory, $this);
        
        return $action->run();
        
    }
    
    public function linkLessonList() {
        
        $action = new Frontend_Action_LessonList($this->request, $this->responseFactory, $this);
        
        return $action->run();
        
    }
    
    public function linkPayment() {
        
        $action = new Frontend_Action_Payment($this->request, $this->responseFactory, $this);
        
        return $action->run();
        
    }
    
    public function linkWorkshop() {
        
        $action = new Frontend_Action_Workshop($this->request, $this->responseFactory, $this);
        
        return $action->run();
        
    }
    
    public function linkIncome() {
        
        $action = new Frontend_Action_Income($this->request, $this->responseFactory, $this);
        
        return $action->run();
        
    }
    
}