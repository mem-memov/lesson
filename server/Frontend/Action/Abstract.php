<?php
abstract class Frontend_Action_Abstract {
    
    /**
     * Запрос
     * @var Frontend_Request_Html|Frontend_Request_Json
     */
    protected $request;
    
    /**
     * Фабрика ответов
     * @var Frontend_Response_Factory
     */
    protected $responseFactory;
    
    /**
     * Цепочка действий
     * @var Frontend_Action_Chain 
     */
    protected $chain;
    
    /**
     * Фабрика бизнес-объектов  
     * @var Domain_Factory
     */
    protected $domainFactory;
    
    public function __construct(
        $request,
        Frontend_Response_Factory $responseFactory,
        Frontend_Action_Chain $chain,
        Domain_Factory $domainFactory
    ) {
        
        $this->request = $request;
        $this->responseFactory = $responseFactory;
        $this->chain = $chain;
        $this->domainFactory = $domainFactory;
        
    }
    
    abstract public function run();
 
}