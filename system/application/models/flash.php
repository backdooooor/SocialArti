<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of flash
 *
 * @author backdoor
 */
class Flash extends Model {
    //таблица flash
    // id_flash   айди флеш приложения(совпадает с названием файла)
    // id_user  айди юзера кто опубликовал приложение
    // title  название  флеш приложения
    //description описание флеш приложения
    function add($id_user,$title,$description){
       if($id_user==""  or $id_user==null or !(int)$id_user) return false;
       if($title=="" or $title==null) return false;
       if($description==null or $description=="") return "";

        $data = array(
            'id_user' => $id_user,
            'title' => $title ,
            'description' => $description

            );

$this->db->insert('flash', $data);
$this->db->insert_id();
    }
    function get(){
         $this->db->select('flash.id_flash,flash.title,users.nick,users.id,users.profile,flash.description');
$this->db->from('flash');
$this->db->join('users', 'users.id = flash.id_user','right inner');
$this->db->order_by("flash.id_flash", "desc");
$query = $this->db->get();
return $query->result();
    }
}
?>
