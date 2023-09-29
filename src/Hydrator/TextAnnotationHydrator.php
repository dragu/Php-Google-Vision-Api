<?php

namespace Vision\Hydrator;

use Laminas\Hydrator\ClassMethodsHydrator;

class TextAnnotationHydrator extends ClassMethodsHydrator
{
    public function __construct()
    {
        parent::__construct(false);

        $this->addStrategy('pages', new Strategy\PagesStrategy());
    }
}
