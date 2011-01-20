<?
class Message extends Model {
 /*
  * таблица message
  * id_message  - айди сообщения
  * id_from  - от кого сообщение
  * id_to  - кому сообщение
  * text  -  сам текст сообщения
  * read - по умолчанию значение 0 
  */
function add($id_from,$id_to,$text){
  
 if($id_from==null or $id_from=="" or !(int)$id_from or $id_to==null or $id_to=="" or !(int)$id_to) return false;
  
 if($text==null or $text=="" ) return false;

 $data = array(
               'id_from' => $id_from ,
               'id_to' => $id_to ,
               'text' => $text
            );

$this->db->insert('message', $data);

        return true;
}
function addFast($id_from,$text){
     if($id_from==null or $id_from=="" or !(int)$id_from ) return false;

 if($text==null or $text=="" ) return false;

 $data = array(
               'id_from' => $id_from ,
               'id_to' => 0,
               'text' => $text
            );

$this->db->insert('message', $data);

        return true;
}
function remove($id_message){
    if($id_message==null or $id_message=="" or !(int)$id_message) return false;
    $this->db->delete('message', array('id_message' => $id_message));
    return true;
}
function doRead($id_message){
     if($id_message==null or $id_message=="" or !(int)$id_message) return false;
    $data = array(
               'read' => 1

            );

$this->db->where('id_message', $id_message);
$this->db->update('message', $data);
return true;
}
function   get($id_user){
     if($id_user==null or !(int)$id_user)   return "";
 $this->db->select('users.nick,users.id,users.profile,message.text,message.id_message,message.read,message.id_from');
$this->db->from('message');
$this->db->join('users', 'users.id = message.id_from');
//$this->db->join('users usr', 'usr.id = friends.id_from');
$this->db->where('id_to', $id_user);

$this->db->order_by("data", "desc");
$query = $this->db->get();
return $query->result();
}
function checkNewMessage($id_user){
    $this->db->from('message');
    $this->db->where('id_to', $id_user);
$this->db->where('read', 0);
$this->db->order_by("data", "desc");
$query = $this->db->get();
return $query->num_rows(); 
}
function getFast(){
     $this->db->select('users.nick,users.id,users.profile,message.text,message.id_message,message.read,message.id_from,message.data');
$this->db->from('message');
$this->db->join('users', 'users.id = message.id_from');

$this->db->where('id_to', 0);
$this->db->order_by("data", "desc");
//$this->db->limit(50);
$query = $this->db->get();

return $query->result();
}

}