<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article
 *
 * @author backdoor
 */
class Article  extends Model{
    //таблица article
    //id_article айди статьи
    //id_user  айди юзверя
    //title  название статьи 
    //text сам текст статьи
    
    function add($id_user,$title,$text){
        if($id_user=="" or $id_user==null or !(int)$id_user) return false;
        if($text=="" or $text==null) return false;
           if($title=="" or $title==null) return false;
         $data = array(
            'id_user' => $id_user,
            'text' => $text,
             'title'=>$title
            );

$this->db->insert('article', $data);
return true;
    }
    function get($id_user){
        if($id_user=="" or $id_user==null or !(int)$id_user) return false;
          $this->db->select('article.id_article,article.title,users.nick,users.id,users.profile');
$this->db->from('article');
$this->db->join('users', 'users.id = article.id_user','right inner');
$this->db->where("article.id_user",$id_user);
$this->db->order_by("article.id_article", "desc");
$query = $this->db->get();
return $query->result();
    }
    function getArticle($id_article){
        if($id_article=="" or $id_article==null or !(int)$id_article) return false;
            $this->db->select('article.id_article,article.title,article.text,users.nick,users.id,users.profile');
$this->db->from('article');
$this->db->join('users', 'users.id = article.id_user','right inner');
$this->db->where("article.id_article",$id_article);

$query = $this->db->get();
return $query->result();
    }
}
?>
