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
        
        return  new Frontend_Action_Start($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkProjectPresentation() {
        
        return  new Frontend_Action_ProjectPresentation($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkLessonList() {
        
        return  new Frontend_Action_LessonList($this->request, $this->responseFactory, $this, $this->domainFactory);
 
    }
    
    public function linkPayment() {
        
        return  new Frontend_Action_Payment($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkWorkshop() {
        
        return  new Frontend_Action_Workshop($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkIncome() {
        
        return  new Frontend_Action_Income($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkPageNotFound() {
        
        return  new Frontend_Action_PageNotFound($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkLesson() {
        
        return  new Frontend_Action_Lesson($this->request, $this->responseFactory, $this, $this->domainFactory);
 
    }
    
    public function linkLessonCreate() {
        
        return  new Frontend_Action_LessonCreate($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkSignUp() {
        
        return  new Frontend_Action_SignUp($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkSignIn() {
        
        return  new Frontend_Action_SignIn($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkSignOut() {
        
        return  new Frontend_Action_SignOut($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkLessonToTeacher() {
        
        return  new Frontend_Action_LessonToTeacher($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkPartCreate() {
        
        return  new Frontend_Action_PartCreate($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkPart() {
        
        return  new Frontend_Action_Part($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkPartEdit() {
        
        return  new Frontend_Action_PartEdit($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkLessonShow() {
        
        return  new Frontend_Action_LessonShow($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkNotEnoughMoney() {
        
        return  new Frontend_Action_NotEnoughMoney($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkHybridAuth() {
        
        return  new Frontend_Action_HybridAuth($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
    public function linkActivateEmail() {
        
        return  new Frontend_Action_ActivateEmail($this->request, $this->responseFactory, $this, $this->domainFactory);

    }
    
}