<?php
namespace App\Controllers;

class PruebaController extends BaseController{
    public function getVar($request){
        //echo '<pre>';
        $idEquipo = $request->getAttribute('id');
        echo $id;
        $getData = $request->getParsedBody();
        
        //echo $request->getAttribute('id');
        //var_dump($request);
        //echo '</pre>';
        return $this->renderHTML('test.twig');
    }
}