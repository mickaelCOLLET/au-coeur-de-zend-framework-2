<?php

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use Application\Form\Element\Personnal;

class WebIdentityFieldset extends AbstractFieldset
{
    public function __construct($name = null)
    {
        parent::__construct('web_identity');
        $this->add(new Personnal\Firstname());
        $this->add(new Personnal\Name());
        $this->add(new Personnal\Email());
    }
}
