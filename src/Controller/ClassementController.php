<?php
namespace App\Controller;

class ClassementController extends BaseController
{
    public function index() {
        header('Location: index.php?page=details'); // TODO a supprimer plus tard
    }
}