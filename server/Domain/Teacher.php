<?php
class Domain_Teacher {

    /**
     * Сосояние
     * @var Data_State_Item_User 
     */
    private $state;
    
    /**
     * Счёт
     * @var Domain_Account 
     */
    private $account;
    
    /**
     * Коллекция уроков
     * @var Domain_Collection_Lesson
     */
    private $lessonCollection;
    
    public function __construct(
        Data_State_Item_User $state,
        Domain_Account $account,
        Domain_Collection_Lesson $lessonCollection
    ) {
        
        $this->state = $state;
        $this->account = $account;
        $this->lessonCollection = $lessonCollection;
        
    }
    
    
    public function teach($lesson) {
        
        
        
    }
    
    public function prepare(array $lessonArray) {
        
        if (array_key_exists('part', $lessonArray)) {
            
            return $this->preparePart($lessonArray);
            
        } else {
            
            return $this->prepareLesson($lessonArray);
            
        }

    }

    public function canWithdraw($amount) {
        
        return $this->account->canDecrease($amount);
        
    }
    
    public function withdraw($amount) {
        
        $this->account->decrease($amount);
        
    }
    
    private function deposit($amount) {
        
        $this->account->increase($amount);
        
    } 
    
    private function prepareLesson(array $lessonArray) {
        
        
        if ($lessonArray['id'] < 1) {
            
            // создаём новй урок
            
            $lesson = $this->lessonCollection->create(
                $lessonArray['title'], 
                $lessonArray['description'],
                $this->state->getId()
            );
            
            $this->lessonCollection->update($lesson);
            
        }

        
        return $lesson;
        
    }
 
    private function preparePart(array $lessonArray) {
        
        $lesson = $this->lessonCollection->readUsingId($lessonArray['id']);

        $lesson->appendPart($lessonArray['part']);
        
        return $lesson;
        
    }
 
}
