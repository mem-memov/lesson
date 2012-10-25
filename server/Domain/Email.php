<?php
/**
 * Почтовый адрес
 */
class Domain_Email
implements
    Domain_CanBePresented
{
    
    /**
     * Состояние
     * @var Data_State_Item_Email
     */
    private $state;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Email_Factory 
     */
    private $messageFactory;

    /**
     * Почтовый рассыльщик
     * @var Service_Mailer_Interface
     */
    private $mailer;
    
    public function __construct(
        Data_State_Item_Email $state,
        Domain_Message_Email_Factory $messageFactory,
        Service_Mailer_Interface $mailer
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        $this->mailer = $mailer;
      
    }
    
    public function bePresented() {
        /*
        $parts = $this->partCollection->readUsingLessonId( $this->state->getId() );
        
        $partInspector = $this->partInspectorFactory->makeMessage();
        
        foreach ($parts as $part) {
            $part->beInspected($partInspector);
        }
        
        return $this->presentationFactory->makeMessage(
            $this->state->getId(), 
            $this->state->getTitle(), 
            $this->state->getDescription(),
            $partInspector->getPartIds(),
            $partInspector->getTotalPrice()
        );
        */
    }
    
    public function beInspected(
        Domain_Message_Email_Request_EmailInspector $emailInspector
    ) {
        
        $emailInspector->addEmail( $this->state->getEmail() );
        
    }
    
    public function exceptMessage( 
        Domain_Message_Email_Request_MailRequest $mailRequest
    ) {
        
        $this->mailer->send(
            array( $this->state->getEmail() ), 
            $mailRequest->getLetterTemplateName(),
            $mailRequest->getData()
        );
        
    }
    
    public function beConfirmed() {
        
        $this->state->setIsConfirmed(true);
        
    }

}
