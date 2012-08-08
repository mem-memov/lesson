<?php
class Data_State_Factory_Part_Factory 
implements 
    Data_State_Factory_SwitchedFactoryInterface
{
    
    private $type;
    
    public function switchType($type) {
        
        $this->type = $type;
        
    }
    
    public function makeState() {
        
        switch($this->type) {
            
            case 'text':
                return new Data_State_Item_Part_Text();
                break;
            default:
                throw new Data_State_Factory_Part_Exception('Неизвестный тип: '.$this->type);
                break;
            
        }

    }
    
}