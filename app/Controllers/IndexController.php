<?php

namespace App\Controllers;


class IndexController extends BaseController{
    public function indexAction(){
               
               $name = 'Alexandro Giles';

               return $this->renderHTML('home.twig' ,[
                   'job' => 'jobe',
                   'name' => $name               ]);

               
    }
    
    
}