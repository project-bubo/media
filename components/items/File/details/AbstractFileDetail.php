<?php

namespace Netstars\Media\Components\Items\File\Details;

use Netstars;

class AbstractFileDetail extends Netstars\Components\RegisteredControl {   
    
    public function getId() {
        $file = $content = $this->lookup('Netstars\\Media\\Components\\Items\\File');
        return $file->id;
    }
    
}
