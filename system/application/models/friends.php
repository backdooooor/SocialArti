<?
class Friends extends Model {

function doAdd($id_from,$id_to,$text=""){
    if($id_from==null or !(int)$id_from or $id_to==null or !(int)$id_to) return "0";
    $data = array(
               'id_from' => $id_from ,
                'id_to' => $id_to ,
               'text' => $text
            );
    $this->db->insert('friends', $data);
    return "1";
}
function doEdit($id_zapr,$bool){
    if($id_zapr==null or !(int)$id_zapr) return false;
    if($bool==0){

        $this->db->delete('friends', array('id' => $id_zapr));
    }else {

        $data = array(
             'accept' => 1
            );

$this->db->where('id_zapr', $id_zapr);
$this->db->update('friends', $data);
    }

}
function getFriends($id_user){
 if($id_user==null or !(int)$id_user)   return "";
 $this->db->select('users.nick,users.id,users.profile');
$this->db->from('friends');
$this->db->join('users', 'users.id = friends.id_to or  users.id=friends.id_from');
//$this->db->join('users usr', 'usr.id = friends.id_from');
$this->db->where('accept', 1);
$this->db->where('id_to', $id_user);
$this->db->or_where('id_from', $id_user);

$query = $this->db->get();
return $query->result();
}
function  getRequest($id_user){
 if($id_user==null or !(int)$id_user)   return "";
 $this->db->select('users.nick,users.id,users.profile,friends.text,friends.id_zapr');
$this->db->from('friends');
$this->db->join('users', 'users.id = friends.id_from ');
//$this->db->join('users usr', 'usr.id = friends.id_from');
$this->db->where('id_to', $id_user);
$this->db->where('accept', 0);
$query = $this->db->get();
return $query->result();
}
function isFriends($id_from,$id_to){
    $this->db->from('friends');
    $this->db->where('id_to', $id_to);
    $this->db->where('id_from', $id_from);
    $this->db->or_where('id_from', $id_to);
    $this->db->where('id_to', $id_from);
    $query = $this->db->get();
    if($query->num_rows()==0) return false;
    else return true;
}


}