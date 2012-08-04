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
    
    /**
     * Фабрика бизнес-объектов  
     * @var Domain_Factory
     */
    protected $domainFactory;

    public function __construct(
        $request,
        Frontend_Response_Factory $responseFactory,
        Domain_Factory $domainFactory
    ) {
        
        $this->request = $request;
        $this->responseFactory = $responseFactory;
        $this->domainFactory = $domainFactory;
        
    }
    
    public function linkStart() {
        
        $action = new Frontend_Action_Start($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkProjectPresentation() {
        
        $action = new Frontend_Action_ProjectPresentation($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkLessonList() {
        
        $action = new Frontend_Action_LessonList($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkPayment() {
        
        $action = new Frontend_Action_Payment($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkWorkshop() {
        
        $action = new Frontend_Action_Workshop($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkIncome() {
        
        $action = new Frontend_Action_Income($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkPageNotFound() {
        
        $action = new Frontend_Action_PageNotFound($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkLesson() {
        
        $action = new Frontend_Action_Lesson($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkLessonCreate() {
        
        $action = new Frontend_Action_LessonCreate($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkSignIn() {
        
        $action = new Frontend_Action_SignIn($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
    public function linkSignOut() {
        
        $action = new Frontend_Action_SignOut($this->request, $this->responseFactory, $this, $this->domainFactory);
        
        return $action->run();
        
    }
    
}