<?php
namespace CMS\Controller;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use CMS\Model\Message;
use CMS\Model\Topic;

class ForumController extends \Arch\Controller{
    
    public function indexAction($request,$arg){
        $id = $arg['id'];
        if($id == NULL){
            $id = -1;
        }
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
EOF;
        if($id == -1){
            $sql .= <<<EOF
                    t.id_forum is NULL
                ORDER BY t.dateTopic ASC
EOF;
            $query = $db->prepare($sql); 
            $result = $query->execute();
            $subForums = $this->getDatabaseManager()->getFinder('CMS\Model\SubForum')->getBy(array(), ' WHERE id_parentForum IS NULL '  );
        }else {
            $sql .= <<<EOF
                t.id_forum = :id
            ORDER BY t.dateTopic ASC
EOF;
            $query = $db->prepare($sql); 
            $result = $query->execute(array('id' => $id));
            $subForums = $this->getDatabaseManager()->getFinder('CMS\Model\SubForum')->getBy(array('id_parentForum' => $id)  );
        }
        $topics = $query->fetchAll();
        return $this->render('Forum/index.html.twig', array('subForums' => $subForums,'currentForum' => $id, 'topics' => $topics));
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
        $messages = $query->fetchAll();
        
        
        $sql = <<<EOF
            SELECT 
                t.id as `id`, 
                t.contentMessage as `contentMessage`, 
                t.dateTopic as `dateMessage`, 
                t.lastUpdateTopic as `lastUpdateMessage`, 
                u.id as `user_id`, 
                u.username as `username` 
            FROM 
                Topic t inner join User u 
                    on u.id = t.id_user  
            WHERE 
                t.id= :id
EOF;

        $query = $db->prepare($sql); 
        $result = $query->execute(array('id' => $id));
        $topic = $query->fetch();
        return $this->render("Forum/topic.html.twig", array('topic' => $topic,  'messages' => $messages, 'id_topic' => $id));
    
    }
    
    
    public function sendMessageAction($request){
        if($request->getMethod() == 'POST') {
            // Test
            /** TODO */
            $message = new Message();
            $date = date("Y-m-d H:i:s");  
            
            $message->setId_topic($request->get('id_topic'))
                    ->setId_user($this->getUser()->getId())
                    ->setContentMessage($request->get('contentMessage'))
                    ->setDateMessage($date  )
                    ->setLastUpdateMessage($date);
            
            $db = $this->getDatabaseManager();
            $db->add($message);
        }
        return $this->redirect('topic', array('id' => $request->get('id_topic')));
    }
    
    public function newTopicAction($request,$arg){
        if($request->getMethod() == 'POST') {
            // Test
            /** TODO */
            
            $db = $this->getDatabaseManager();
            $title = $request->get('title');
            $id_forum = $request->get('id_forum');
            $date = date("Y-m-d H:i:s");  
            $contentMessage = $request->get('contentMessage');
            $id_user = $this->getUser()->getId();
            $topic = new Topic();
            
            $topic->setDateTopic($date)
                  ->setId_forum($id_forum)
                  ->setId_user($id_user)
                  ->setTitle($title)
                  ->setContentMessage($contentMessage)
                  ->setLastUpdateTopic($date);
            
            $db->add($topic);
        }
        
        return $this->redirect('forum', array('id' => $request->get('id_forum') ));
    }
}