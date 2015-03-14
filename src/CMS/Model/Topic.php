<?php

namespace CMS\Model;
use Arch\Connect\Entity;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Topic extends Entity{
    protected $id;
    protected $title;
    protected $dateTopic;
    protected $lastUpdateTopic;
    protected $id_forum;
    protected $id_user;
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function setDateTopic($dateTopic){
        $this->dateTopic = $dateTopic;
        return $this;
    }
    
    public function getDateTopic(){
        return $this->dateTopic;
    }
    
    public function setLastUpdateTopic($dateTopic){
        $this->lastUpdateTopic = $lastUpdateTopic;
        return $this;
    }
    
    public function getLastUpdateTopic(){
        return $this->lastUpdateTopic;
    }
    
    public function setId_forum($id_forum){
        $this->id_forum = $id_forum;
        return $this;
    }
    
    public function getId_forum(){
        return $this->id_forum;
    }
    
    
    public function setId_user($id_user){
        $this->id_user = $id_user;
        return $this;
    }
    
    public function getId_user(){
        return $this->id_user;
    }
    
    public static function getTableName() {
        return 'Topic';
    }
}

