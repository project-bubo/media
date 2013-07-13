<?php

namespace Netstars\Media\Components\Content\PopUp;

use Nette;

class RenameFileForm extends BaseForm {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);        
        
        $fileId = $this->parent->getId();
        
        
        $file = $this->presenter->mediaManagerService->getFile($fileId);
        
       
        //$currentSection = $this->parent->getCurrentSection();
        
        $this->addText('fileName', 'Nový název souboru')
                        ->setDefaultValue($file['name'])
                        ->setRequired('Zadejte název souboru');
        
        $this->addSubmit('send', 'OK');
        
        $this->addHidden('fileId', $fileId);
        //$this->addHidden('currentSection', $currentSection);
        
        $this->onSuccess[] = array($this, 'formSubmited');  
    
        //$this['send']->getControlPrototype()->class = "submit";
    }

    
    public function formSubmited($form) {
        
        $values = $form->getValues();

        try {
            $fileName = $values['fileName'];
            $fileId = $values['fileId'];

            $this->presenter->mediaManagerService->renameFile($fileName, $fileId);
        } catch (Nette\InvalidStateException $ex) {
            $this->presenter->flashMessage($ex->getMessage(), 'error');
            $this->presenter->invalidateControl();
        }
        
        $p = $this->lookup('Netstars\\Media');
        $p->invalidateControl();
        
    }
    
}