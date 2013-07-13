<?php

namespace Netstars\Media\Components\Content\PopUp;

class AddGalleryForm extends BaseForm 
{

    public function __construct($parent, $name) 
    {
        parent::__construct($parent, $name);        
        
        $parentFolderId = $this->parent->getFolderId();
        $currentSection = $this->parent->getCurrentSection();
        
        $this->addText('folderName', 'Název galerie')
                        ->setRequired('Zadejte název galerie');
        
        $this->addSubmit('send', 'OK');
        
        $this->addHidden('parentFolderId', $parentFolderId);
        $this->addHidden('currentSection', $currentSection);
        
        $this->onSuccess[] = array($this, 'formSubmited');  
    
        //$this['send']->getControlPrototype()->class = "submit";
    }

    
    public function formSubmited($form) 
    {
        $values = $form->getValues();
        
        $this->presenter->mediaManagerService->createGallery($values);
        
        $p = $this->lookup('Netstars\\Media');
        $p->invalidateControl();
    }
    
}