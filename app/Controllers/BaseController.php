<?php 
namespace App\Controllers;

use Zend\Diactoros\Response\HtmlResponse;

class BaseController{
    protected $templateEngine; 

    public function __construct(){
         $loader = new \Twig\Loader\FilesystemLoader('../views');
         $this->templateEngine = new \Twig\Environment($loader, array(
            'debug' => true,
            'cache' => false
        ));
        $this->templateEngine->addExtension(new \Twig\Extension\DebugExtension());
    }
    public function renderHTML($fileName, $data=[]){
        return $this->templateEngine->render($fileName, $data);
    }
}