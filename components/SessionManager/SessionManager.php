<?php

namespace Netstars\Media\Components;

use Nette, Netstars, Nette\Utils\Html;

class SessionManager extends Netstars\Components\RegisteredControl {   
 
    const MEDIA_SESSION_NAMESPACE = 'media';
    
    public $sessionSectionName = 'default';
    
    public function __construct($parent, $name) {
        parent::__construct($parent, $name);
    }

    public function createComponentPasteBin($name) {
        return new SessionManager\PasteBin($this, $name);
    }
    
    public function getSessionSection() {
        $session = $this->presenter->context->session;
        return $session->getSection(self::MEDIA_SESSION_NAMESPACE . '-' . $this->sessionSectionName);
    }
    
}
