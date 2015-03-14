<?php
namespace CMS\Controller;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class ForumController extends \Arch\Controller{
    public function indexAction($request){
        $subForums = $this->getDatabaseManager()->getFinder('CMS\Model\SubForum')->getBy(array(), ' WHERE id_parentForum IS NULL '  );
        return $this->render('Forum/index.html.twig', array('subForums' => $subForums, 'topics' => array()));
    }
    
    
    public function subForumAction($request,$arg){
        $subForums = $this->getDatabaseManager()->getFinder('CMS\Model\SubForum')->getBy(array('id_parentForum' => $arg['id']));
        return $this->render('Forum/index.html.twig', array('subForums' => $subForums, 'topics' => array()));
    }
}