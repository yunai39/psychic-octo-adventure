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
        $db = $this->getDatabaseManager()->getConnect();
        $sql = <<<EOF
            SELECT 
                t.id as `id`, 
                t.title as `title`, 
                t.dateTopic as `dateTopic`, 
                t.lastUpdateTopic as `lastUpdateTopic`, 
                u.id as `user_id`, 
                u.username as `username` 
            FROM 
                Topic t inner join User u 
                    on u.id = t.id_user  
            WHERE 
                t.id_forum is NULL
            ORDER BY t.dateTopic ASC
EOF;
        $query = $db->prepare($sql); 
        $result = $query->execute();
        $topics = $query->fetchAll();
        return $this->render('Forum/index.html.twig', array('subForums' => $subForums, 'topics' => $topics));
    }
    
    
    public function subForumAction($request,$arg){
        $id = $arg['id'];
        
        $subForums = $this->getDatabaseManager()->getFinder('CMS\Model\SubForum')->getBy(array('id_parentForum' => $arg['id']));
        
        $db = $this->getDatabaseManager()->getConnect();
        $sql = <<<EOF
            SELECT 
                t.id as `id`, 
                t.title as `title`, 
                t.dateTopic as `dateTopic`, 
                t.lastUpdateTopic as `lastUpdateTopic`, 
                u.id as `user_id`, 
                u.username as `username` 
            FROM 
                Topic t inner join User u 
                    on u.id = t.id_user  
            WHERE 
                t.id_forum = :id
            ORDER BY t.dateTopic ASC
EOF;
        $query = $db->prepare($sql); 
        $result = $query->execute(array('id' => $id));
        $topics = $query->fetchAll();
        return $this->render('Forum/index.html.twig', array('subForums' => $subForums, 'topics' => $topics));
    }
    
    public function displayTopicAction($request,$arg){
        // Test pour l'id 
        
        $id = $arg['id'];
        
        $db = $this->getDatabaseManager()->getConnect();
        $sql = <<<EOF
            SELECT 
                m.id as `id`, 
                m.contentMessage as `contentMessage`, 
                m.dateMessage as `dateMessage`, 
                m.lastUpdateMessage as `lastUpdateMessage`, 
                u.id as `user_id`, 
                u.username as `username` 
            FROM 
                Message m inner join User u 
                    on u.id = m.id_user  
            WHERE 
                m.id_topic= :id
            ORDER BY m.dateMessage ASC
EOF;

        $query = $db->prepare($sql); 
        $result = $query->execute(array('id' => $id));
        return $this->render("Forum/topic.html.twig", array('messages' => $query->fetchAll()));
    
    }
}