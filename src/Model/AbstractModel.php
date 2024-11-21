<?php
namespace App\Model;

abstract class AbstractModel {
    protected $id;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id): void {
        $this->id = $id;
    }
}