<?php

namespace Netstars\Media\Components\Content\PopUp;

class DeleteFolderForm extends BaseForm {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);        
        
        $media = $this->lookup('Netstars\\Media');
        
        $folderId = $this->parent->getId();
        $this->addSubmit('send', 'OK');
        
        $this->addHidden('folderId', $folderId);
        $this->addHidden('section', $media->getCurrentSection());
        
        $this->onSuccess[] = array($this, 'formSubmited');  
    }

    
    public function formSubmited($form) {
        
        $values = $form->getValues();
        
        $this->presenter->mediaManagerService->deleteFolder($values['folderId'], $values['section']);
        
        $p = $this->lookup('Netstars\\Media');
        $p->invalidateControl();
       
    }
    
}