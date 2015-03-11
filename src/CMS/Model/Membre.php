<?php

namespace CMS\Model;
use Arch\Connect\Entity;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Membre extends Entity{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $login;
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    
    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }
    
    public function getNom(){
        return $this->nom;
    }
    
    public function setPrenom($prenom){
        $this->prenom = $prenom;
        return $this;
    }
    
    public function getPrenom(){
        return $this->prenom;
    }
    
    public function setLogin($login){
        $this->login = $login;
        return $this;
    }
    
    public function getLogin(){
        return $this->login;
    }
    
    public static function getTableName() {
        return 'Membre';
    }
}

