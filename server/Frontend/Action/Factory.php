<?php
class Frontend_Action_Factory {
    
    /**
     * Фабрика ответов
     * @var Frontend_Response_Factory
     */
    protected $responseFactory;
    
    /**
     * Фабрика бизнес-объектов  
     * @var Domain_Factory
     */
    protected $domainFactory;
    
    public function __construct(
        Frontend_Response_Factory $responseFactory,
        Domain_Factory $domainFactory
    ) {

        $this->responseFactory = $responseFactory;
        $this->domainFactory = $domainFactory;
        
    }
    
    /**
     * Создаёт цепочку действий
     *
     * @param type $request
     * @return Frontend_Action_Chain 
     */
    public function makeChain(
        $request
    ) {
        
        return new Frontend_Action_Chain($request, $this->responseFactory, $this->domainFactory);
        
    }
    
}
