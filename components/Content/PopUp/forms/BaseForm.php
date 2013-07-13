<?php

namespace Netstars\Media\Components\Content\PopUp;

class BaseForm extends \AdminModule\Forms\BaseForm {

    public function __construct($parent, $name) {
        parent::__construct($parent, $name);        
        
        $this->getElementPrototype()->class = 'ajax';
     }
    
}