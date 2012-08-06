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
        array $server,
        array $get,
        array $post,
        array $files,
        array $cookie
    ) {
        
        $this->eliminateGlobalArrays();
        
        $request = $this->requestFactory->makeHtmlRequest($server, $get, $post, $files, $cookie);
        $actionChain = $this->actionFactory->makeChain($request);
        $response = $actionChain->linkStart();

        $response->appear();
        
        $this->recoverGlobalArrays();
        
    }
    
    /**
     * The method prevents using global predefined arrays inside controllers.
     * The request object must be used instead.
     * It is accessible inside every container.
     *
     */
    protected function eliminateGlobalArrays() {

            $this->global_arrays = array(
                    'server' => $_SERVER,
                    'get' => $_GET,
                    'post' => $_POST,
                    'files' => $_FILES
            );

            unset($_SERVER);
            unset($_GET);
            unset($_POST);
            unset($_FILES);

    }
    
    /**
     * The method restores the global predefined arrays.
     */
    protected function recoverGlobalArrays() {

            $_SERVER = $this->global_arrays['server'];
            $_GET = $this->global_arrays['get'];
            $_POST = $this->global_arrays['post'];
            $_FILES = $this->global_arrays['files'];

    }
    
}
