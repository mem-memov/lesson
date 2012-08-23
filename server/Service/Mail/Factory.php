<?php
/**
 * Фабрика рассыльщиков почты
 */
class Service_Mail_Factory {
    
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
    
    public function makeSwiftMailerAdapter() {
        
        require_once( dirname(__FILE__).'/Swift-4.2.1/lib/swift_required.php' );
        
        $server = $this->configuration['SMTP']['server'];
        $port = $this->configuration['SMTP']['port'];
        $user = $this->configuration['SMTP']['user'];
        $password = $this->configuration['SMTP']['password'];
        
        $transport = Swift_SmtpTransport::newInstance($server, $port)
            ->setUsername($user)
            ->setPassword($password)
        ;
        
        $mailer = Swift_Mailer::newInstance($transport);
        
        return new Service_Mail_SwiftMailer_Adapter($mailer);
        
    }
    
}