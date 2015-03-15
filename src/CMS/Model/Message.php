<?php

namespace CMS\Model;
use Arch\Connect\Entity;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Message extends Entity{
    protected $id;
    protected $contentMessage;
    protected $dateMessage;
    protected $lastUpdateMessage;
    protected $id_user;
    protected $id_topic;
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    
    public function setContentMessage($contentMessage){
        $this->contentMessage = $contentMessage;
        return $this;
    }
    
    public function getContentMessage(){
        return $this->contentMessage;
    }
    
    public function setDateMessage($dateMessage){
        $this->dateMessage = $dateMessage;
        return $this;
    }
    
    public function getDateMessage(){
        return $this->dateMessage;
    }
    
    public function setLastUpdateMessage($lastUpdateMessage){
        $this->lastUpdateMessage = $lastUpdateMessage;
        return $this;
    }
    
    public function getLastUpdateMessage(){
        return $this->lastUpdateMessage;
    }
    
    public function setId_user($id_user){
        $this->id_user = $id_user;
        return $this;
    }
    
    public function getId_user(){
        return $this->id_user;
    }
    
    public function setId_topic($id_topic){
        $this->id_topic = $id_topic;
        return $this;
    }
    
    public function getId_topic(){
        return $this->id_topic;
    }
    
    
    public static function getTableName() {
        return 'Message';
    }
}

