<?php
class Data_Access_Account extends Data_Access_Abstract {
    
    public function create() {
        
        $state = $this->stateFactory->makeState();
        
        $this->storage->query('
            
        ');
        
        
    }
    
    public function read(Data_State_Account $state);
    
    public function update(Data_State_Account $state);
    
    public function delete(Data_State_Account $state);
    
}
