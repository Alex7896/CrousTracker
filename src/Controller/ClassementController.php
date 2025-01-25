<?php

namespace App\Controller;

class ClassementController extends BaseController
{
    public function index() {
        $this->renderView('infoCrous/avis.twig');
    }
}