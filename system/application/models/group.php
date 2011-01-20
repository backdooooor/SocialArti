<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of group
 *
 * @author backdoor
 */
class Group  extends Model{
    //таблица group
    //id_group  айди группы
    //id_user основатель группы
    //ifo  серилизованный массив
    function add($id_user,$info){
        if($id_user==null or $id_user==""  or !(int)$id_user) return false;
        if($info==null or $info=="") return false;
         $data = array(
               'id_user' => $id_user ,
                'info' => $info 

            );
    $this->db->insert('group', $data);
        return $this->db->insert_id();
    }
    function edit($id_group,$info){
          if($id_group==null or $id_group=="" or !(int)$id_group) return false;
       if($info==null or  $info=="") return false;
       $data = array(
               'info' => $info

            );

$this->db->where('id_group', $id_group);
$this->db->update('group', $data);
return true;
    }
    function  get($id_group){
      $this->db->select('users.nick,users.id,users.profile,group.id_group,group.info');
      $this->db->from('group');
      $this->db->join('users', 'users.id = group.id_user');
      $this->db->where('id_group', $id_group);

      $query = $this->db->get();
      return $query->result();
    }
    function isPartipiants($id_group,$id_user){
        $this->db->select('users.nick,users.id,users.profile,group.id_group,group.info');
      $this->db->from('group');
      $this->db->join('users', 'users.id = group.id_user');
      $this->db->where('id_group', $id_group);

      $query = $this->db->get();
      foreach($query->result() as $row){
           $masive=unserialize($row->info);
           $new_str=str_replace($id_user.",", "", $masive["participants_id"]);
           if($masive["participants_id"]==$new_str){
 return  false;
}else {
    return true;
}
      }
    }
    
    function isCreated($id_group,$id_user){
        if($id_group==null or $id_group==""  or  !(int)$id_group) return false;
        if($id_user==null or $id_user==""  or  !(int)$id_user) return false;
        $this->db->from('group');
        $this->db->where("id_group",$id_group);
        $this->db->where("id_user",$id_user);
         $query = $this->db->get();
         if($query->num_rows()>0){
             return true;
         } else {
             return false;
         }
         }

    
    
}
?>
