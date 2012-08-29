<?php
/**
 * Фабрика помошников
 */
class Domain_Collaborator_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct(

    ) {

        $this->uniqueInstances = array();

    }
    
    /**
     * @return Domain_Collaborator_Factory_EmailActivation
     */
    public function makeEmailActivationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collaborator_Factory_EmailActivation(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }

}