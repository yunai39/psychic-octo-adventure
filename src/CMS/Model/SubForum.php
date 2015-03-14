<?php

namespace CMS\Model;
use Arch\Connect\Entity;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class SubForum extends Entity{
    protected $id;
    protected $nameForum;
    protected $description;
    protected $id_parentForum;
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    
    public function setNameForum($nameForum){
        $this->nameForum = $nameForum;
        return $this;
    }
    
    public function getNameForum(){
        return $this->nameForum;
    }
    
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setId_parentForum($id_parentForum){
        $this->id_parentForum = $id_parentForum;
        return $this;
    }
    
    public function getId_parentForum(){
        return $this->id_parentForum;
    }
    
    public static function getTableName() {
        return 'SubForum';
    }
}

