<?php
namespace App\Traits;

trait DefaultImages{
    public function getImage($name=""){
        if(!$this->logoImg){
            if($name != ""){
                $name= "&name=" . $name;
            }else{
                $name = "&name=S+D";
            }
            return "https://ui-avatars.com/api/?size=128&rounded=true$name";
        }else{
            return "../public/uploads/$this->logoImg";
        }

    }
}