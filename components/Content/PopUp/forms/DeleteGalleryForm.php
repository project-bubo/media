<?php

namespace Netstars\Media\Components\Content\PopUp;

class DeleteGalleryForm extends BaseForm {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);        
        
        $galleryId = $this->parent->getId();
        $this->addSubmit('send', 'OK');
        
        $this->addHidden('galleryId', $galleryId);
        
        $this->onSuccess[] = array($this, 'formSubmited');  
    }

    
    public function formSubmited($form) {
        
        $values = $form->getValues();
        
        $this->presenter->mediaManagerService->deleteGallery($values['galleryId']);
        
        $p = $this->lookup('Netstars\\Media');
        $p->invalidateControl();
       
    }
    
}