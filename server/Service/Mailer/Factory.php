<?php
/**
 * Фабрика рассыльщиков почты
 */
class Service_Mailer_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки сервисов
     *
     * @var array
     */
    private $configuration;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        array $configuration
    ) {

        $this->uniqueInstances = array();
        $this->configuration = $configuration;

    }
    
    /**
     * 
     * @return Service_Mail_SwiftMailer_Adapter
     */
    public function makeSwiftMailerAdapter() {
        
        require_once( dirname(__FILE__).'/SwiftMailer/Swift-4.2.1/lib/swift_required.php' );
        
        $server = $this->configuration['robot']['server'];
        $port = $this->configuration['robot']['port'];
        $user = $this->configuration['robot']['user'];
        $password = $this->configuration['robot']['password'];
        
        $transport = Swift_SmtpTransport::newInstance($server, $port)
            ->setUsername($user)
            ->setPassword($password)
        ;
        
        $templateDirectory = __DIR__.'/template';

        $mailer = Swift_Mailer::newInstance($transport);
        
        return new Service_Mailer_SwiftMailer_Adapter(
            $mailer,
            $this->configuration['robot']['sender_email'],
            $templateDirectory
        );
        
    }
    
}