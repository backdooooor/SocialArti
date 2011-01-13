<?
class Comments extends Model {
/*
 * таблица comments
 * id_comment   айди комментария
 * id_mnews  - айди микроновости  к которой писался комментарий
 * id_user  - айди юзера который писал комментарий!
 * text -  собственно сам текст комментария!
 */
    function add($id_mnews,$id_user,$text){
        if($id_mnews=="" or $id_mnews==null  or !(int)$id_mnews) return false;
        if($id_user=="" or $id_user==null or  !(int)$id_user) return false;
        if($text==null or $text=="") return false;
        $data = array(
               'id_mnews' => $id_mnews ,
               'id_user' => $id_user ,
               'text' => $text
            );

$this->db->insert('comments', $data);
 return true;
    }
    function get($id_mnews){
           if($id_mnews==null or !(int)$id_mnews or $id_mnews=="") return false;
           
 $this->db->select('comments.id_comment,comments.text,users.nick,users.id,users.profile,comments.data');
$this->db->from('comments');
$this->db->join('users', 'users.id = comments.id_user','right outer');
$this->db->where('comments.id_mnews', $id_mnews);
$this->db->order_by("comments.data", "ASC");

$query = $this->db->get();
return $query->result();
    }
}

