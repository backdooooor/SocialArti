<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of talks
 *
 * @author backdoor
 */
class Talks extends Model  {
/*
 * table talks
 * id_talk  айди топика
 * id_user  айди юзера
 * text   текст сообщения
 * title  - название темы
 * id_main - айди  главной темы
 * id_group -айди группы
 * 
 */
    function add($id_user,$id_main=0,$id_group=0,$text,$title=""){
     // echo $id_user.",".$id_main.",".$id_group.",".$text.",".$title;
        if($id_user=="" or $id_user==null or !(int)$id_user) return false;
             if($id_group=="" or $id_group==null or !(int)$id_group) return false;
            
             $data = array(
               'id_user' => $id_user ,
                'id_main' => $id_main ,
               'title' => $title,
                 'text'=>$text,
                 'id_group'=>$id_group
            );
    $this->db->insert('talks', $data);
    return $this->db->insert_id();
    }
    function get($id_group){
           $this->db->select("users.profile,users.id,talks.id_talk,talks.text,talks.title");
           $this->db->from('talks');
            $this->db->join('users', 'users.id = talks.id_user');
         $this->db->where('id_main','0');
         $this->db->where('id_group',$id_group);
        $query = $this->db->get();
        return $query->result();
    }
    function getTalks($id_talks){
        $this->db->select("users.profile,users.id,talks.id_talk,talks.text,talks.title,talks.id_group");
           $this->db->from('talks');
            $this->db->join('users', 'users.id = talks.id_user');
         $this->db->where('id_talk',$id_talks);
         $this->db->or_where('id_main',$id_talks);
         $this->db->order_by("data", "ASC");
        $query = $this->db->get();
        
        return $query->result();
    }


}
?>
