<?php
class Frontend_Action_Payment extends Frontend_Action_Abstract {
    
    public function run() {

        $studentId = $this->request->getUserId();
        $school = $this->domainFactory->makeSchool();
        
        if ($this->request->hasParameter('amount')) {
            $amount = $this->request->getParameter('amount');
            $accountPresentation = $school->receiveTuition($studentId, $amount);
        } else {
            $accountPresentation = $school->receiveTuition($studentId); //odd thing
        }

        $accountData = $accountPresentation->toArray();
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/Payment/form.php',
            array(
                'amount' => $accountData['amount']
            ),
            array(),
            array()
        );
        
    }
    
}