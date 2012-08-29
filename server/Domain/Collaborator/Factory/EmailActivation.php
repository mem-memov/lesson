<?php
class Domain_Collaborator_Factory_EmailActivation {
    
    public function make($userId, $email) {
        
        return new Domain_Collaborator_Item_EmailActivation($userId, $email);
        
    }
    
}