<?php
class Frontend_Processor {
    
    private $requestFactory;
    private $responseFactory;
    private $actionFactory;
    private $global_arrays;
    
    public function __construct(
        Frontend_Request_Factory $requestFactory,
        Frontend_Response_Factory $responseFactory,
        Frontend_Action_Factory $actionFactory
    ) {
        
        $this->requestFactory = $requestFactory;
        $this->responseFactory = $responseFactory;
        $this->actionFactory = $actionFactory;
        $this->global_arrays = array();
        
    }
    
    public function respond(
        Frontend_Input_ServerInterface $server,
        Frontend_Input_KeyValueInterface $get,
        Frontend_Input_KeyValueInterface $post,
        Frontend_Input_FilesInterface $files,
        Frontend_Input_CookieInterface $cookie
    ) {
        
        $request = $this->requestFactory->makeHtmlRequest($server, $get, $post, $files, $cookie);
        $actionChain = $this->actionFactory->makeChain($request);
        $response = $actionChain->linkStart()->run();
        $response->appear();

    }

}
