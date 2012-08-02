<?php
abstract class Frontend_Action_Abstract {
    
    /**
     * Запрос
     * @var type 
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
    
    public function __construct(
        $request,
        Frontend_Response_Factory $responseFactory,
        Frontend_Action_Chain $chain
    ) {
        
        $this->request = $request;
        $this->responseFactory = $responseFactory;
        $this->chain = $chain;
        
    }
    
}