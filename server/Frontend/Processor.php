<?php
class Frontend_Processor {
    
    private $requestFactory;
    private $responseFactory;
    private $actionFactory;
    
    public function __construct(
        $requestFactory,
        $responseFactory,
        $actionFactory
    ) {
        
        $this->requestFactory = $requestFactory;
        $this->responseFactory = $responseFactory;
        $this->actionFactory = $actionFactory;
        
    }
    
    public function respond() {
        
        $action = $this->actionFactory->makeStartAction();
        $request = $this->requestFactory->makeHtmlRequest();
        $response = $this->responseFactory->makeHtmlResponse();
        $action->run($request, $response);

        $response->appear();
        
    }
    
}
