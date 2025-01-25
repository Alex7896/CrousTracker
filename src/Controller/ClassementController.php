<?php

namespace App\Controller;

class ClassementController extends BaseController
{
    public function index() {
        $this->renderView('classement.twig');
    }
}