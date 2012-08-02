<?php
class Frontend_Action_Factory {
    
    /**
     * Фабрика ответов
     * @var Frontend_Response_Factory
     */
    protected $responseFactory;
    
    public function __construct(
        Frontend_Response_Factory $responseFactory
    ) {

        $this->responseFactory = $responseFactory;
        
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
        
        return new Frontend_Action_Chain($request, $this->responseFactory);
        
    }
    
}
