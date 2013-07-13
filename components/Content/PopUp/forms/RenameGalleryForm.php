<?php

namespace Netstars\Media\Components\Content\PopUp;

use Nette;

class RenameGalleryForm extends BaseForm {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);        
        
        $folderId = $this->parent->getId();
        
        
        $folder = $this->presenter->mediaManagerService->getFolder($folderId);
        
       
        //$currentSection = $this->parent->getCurrentSection();
        
        $this->addText('folderName', 'Nový název galerie')
                        ->setDefaultValue($folder['name'])
                        ->setRequired('Zadejte název galerie');
        
        $this->addSubmit('send', 'OK');
        
        $this->addHidden('folderId', $folderId);
        //$this->addHidden('currentSection', $currentSection);
        
        $this->onSuccess[] = array($this, 'formSubmited');  
    
        //$this['send']->getControlPrototype()->class = "submit";
    }

    
    public function formSubmited($form) {
        
        $values = $form->getValues();
        
//        dump($values);
//        die();
        try {
            $folderName = $values['folderName'];
            $folderId = $values['folderId'];
            
            $this->presenter->mediaManagerService->renameFolder($folderName, $folderId);
        } catch (Nette\InvalidStateException $ex) {
            $this->presenter->flashMessage($ex->getMessage(), 'error');
            $this->presenter->invalidateControl();
        }
        
        $p = $this->lookup('Netstars\\Media');
        $p->invalidateControl();
        
    }
    
}