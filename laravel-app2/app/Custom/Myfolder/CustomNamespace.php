<?php 

namespace App\Custom\Myfolder;

class CustomNamespace {
    private $name = 'Custom Namespace name';
    private $secondName = "This is second namespace name";
    public function getNameSpace() {
        echo $this->name;
    }

    public function newFunction() {
        echo $this->secondName;
    }

    public static function testStatic() {
        echo "namespace Static method";
    }
}




?>