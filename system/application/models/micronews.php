<?
class Micronews extends Model {
//table micronews
//id_mnews
//id_user  кого новость
//text  - сам текст новости
//data(timestamp(14)) дата....
    function add($id_user,$text){
        if($id_user==null or !(int)$id_user or $id_user=="") return false;
        if($text==null or $text=="") return false;
$data = array(
               'id_user' => $id_user ,
               'text' => $text
            );
echo "добавлено!";
$this->db->insert('micronews', $data);
return true;
   }
   function  getMNews($id_user){
    if($id_user==null or !(int)$id_user or $id_user=="") return false;
 $this->db->select('micronews.id_mnews,micronews.text,users.nick,users.id,users.profile,micronews.data');
$this->db->from('friends');
$this->db->join('micronews', 'micronews.id_user = friends.id_to or micronews.id_user=friends.id_from','right outer');
$this->db->join('users', 'users.id = micronews.id_user','right outer');
$this->db->where('friends.accept', 1);
$this->db->where('friends.id_to', $id_user);
$this->db->or_where('friends.id_from',$id_user);

$this->db->order_by("micronews.data", "desc");
$this->db->distinct();
$query = $this->db->get();
//$this->db->last_query(); вывод последнего  запроса.!
if($query->num_rows()!=0){
       return $query->result();
} else {
     $this->db->select('micronews.text,users.nick,users.id,users.profile,micronews.data');
$this->db->from('micronews');
$this->db->join('users', 'users.id = micronews.id_user','right outer');
$this->db->where('micronews.id_user', $id_user);

$this->db->order_by("micronews.data", "desc");

$query = $this->db->get();
return $query->result();
}
   }
}

