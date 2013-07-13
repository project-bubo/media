<?php

namespace Netstars\Media\Components\Content\PopUp;

use Utils;

class EditImageTitlesForm extends BaseForm {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);
        $media = $this->lookup('Netstars\\Media');
        
        $langs = $this->presenter->langManagerService->getLangs();
        
        $config = $media->getConfig();
        
//        dump($media->getConfig());
//        die();
        
        $allTitles = $this->addContainer('titles');
        
        foreach ($langs as $code => $langTitle) {
            
            $langContainer = $allTitles->addContainer($code);
            
            foreach ($config['titles'] as $titleName => $title) {
                
                switch ($title['control']) {
                    case 'text':
                        $langContainer->addText($titleName, $title['title']);
                        break;
                    case 'textArea':
                        $langContainer->addTextArea($titleName, $title['title']);
                        break;
                }
                
            }
            
        }
        
        $file = $this->presenter->mediaManagerService->getFile($this->parent->id);
        
        $defaults = array('titles' => Utils\Multivalues::unserialize($file['ext']));
        
        
        if ($defaults['titles']) $this->setDefaults((array) $defaults);

        $this->addHidden('fileId', $this->parent->id);

        $this->addSubmit('send', 'Uložit');
        $this->onSuccess[] = array($this, 'formSubmited');
       
        
        $this->getElementPrototype()->class = 'ajax';
        
        $this['send']->getControlPrototype()->class = "submit";
    }

    public function formSubmited($form) {
        $formValues = $form->getValues();
        
//        dump($formValues);
//        die();
        
        $media = $this->lookup('Netstars\\Media');
        
        $this->presenter->mediaManagerService->saveImageTitles($formValues['titles'], $formValues['fileId']);
        
        //$this->parent->view = NULL;
        $media->invalidateControl();
        
//        dump($formValues);
//        die();
//        try{
//            $this->presenter->virtualDriveService->setPathByFolderId($this->parent->fid);
//            $r = $this->presenter->virtualDriveService->addFiles($data['upload']);
//            $this->parent->handleSetView('default', 0, $this->parent->fid);
//        }catch(\Exception $e){
//            $this->parent->flashMessage($e->getMessage());
//            $this->parent->handleSetView('default', 0, $this->parent->fid);
//        }
    }
}