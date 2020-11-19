<?php
namespace App\Controllers;

class AdminController extends BaseController{
    public function indexAction(){
        return $this->renderHTML('admin.twig');
    }
}
