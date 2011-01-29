<?
class Search extends Model {

    function doSearch($str,$opt){
 switch($opt){
 case "0":
    return  $this->doSearchPeople($str);
     break;
 case "1":
   return  $this->doSearchGroup($str);
     break;
  case "2":
   return  $this->doSearchTopic($str);
     break;
 case "3":
     return $this->doSearchApp($str);
     break;
 }

    }
        function doSearchApp($str){
         $CI =& get_instance();
        $CI->load->model('Filter');
        $str=$CI->Filter->doHTML($str);
       $mas_str=explode(" ",$str);

         if((int)$this->session->userdata('id')){
             $id_user=(int)$this->session->userdata('id');
             //$str="%".$str."%";
         // $sql = "SELECT *    FROM users    WHERE  profile LIKE  ?   and  id!=?";
     $this->db->from('flash');
     $i=0;
     while($mas_str[$i]!=null){
       $this->db->like('title', $mas_str[$i]);
       $this->db->or_like("description",$mas_str[$i]);

       $i++;
     }
$this->db->join('users', 'users.id = flash.id_user','right inner');
$this->db->where("public",1);
    $query = $this->db->get();

    //$query = $this->db->query($sql, array($str, $id_user));
    return $query->result();
     }
     else {
      return false;
     }
    }
    function  doSearchPeople($str){
         $CI =& get_instance();
        $CI->load->model('Filter');
        $str=$CI->Filter->doHTML($str);
       $mas_str=explode(" ",$str);

         if((int)$this->session->userdata('id')){
             $id_user=(int)$this->session->userdata('id');
             //$str="%".$str."%";
         // $sql = "SELECT *    FROM users    WHERE  profile LIKE  ?   and  id!=?";
     $this->db->from('users');
     $i=0;
     while($mas_str[$i]!=null){
       $this->db->like('profile', $mas_str[$i]);
       $i++;
     }

    $query = $this->db->get();

    //$query = $this->db->query($sql, array($str, $id_user));
    return $query->result();
     }
     else {
      return false;
     }

    }

    function doSearchGroup($str){
  $CI =& get_instance();
        $CI->load->model('Filter');
        $str=$CI->Filter->doHTML($str);
       $mas_str=explode(" ",$str);

         if((int)$this->session->userdata('id')){
             $id_user=(int)$this->session->userdata('id');
             //$str="%".$str."%";
         // $sql = "SELECT *    FROM users    WHERE  profile LIKE  ?   and  id!=?";
     $this->db->from('group');
     $i=0;
     while($mas_str[$i]!=null){
       $this->db->like('info', $mas_str[$i]);
       $i++;
     }

    $query = $this->db->get();

    //$query = $this->db->query($sql, array($str, $id_user));
    return $query->result();
     }
     else {
      return false;
     }


    }
    function doSearchTopic($str){
 $CI =& get_instance();
        $CI->load->model('Filter');
        $str=$CI->Filter->doHTML($str);
       $mas_str=explode(" ",$str);

         if((int)$this->session->userdata('id')){
             $id_user=(int)$this->session->userdata('id');
             //$str="%".$str."%";
         // $sql = "SELECT *    FROM users    WHERE  profile LIKE  ?   and  id!=?";
     $this->db->from('talks');
     $i=0;
     while($mas_str[$i]!=null){
       $this->db->like('title', $mas_str[$i]);
       $this->db->or_like('text', $mas_str[$i]);
       $i++;
     }
//$this->db->join('talks','talks.id_main=talks.id_talk','right inner');
$this->db->join('users', 'users.id = talks.id_user','right inner');
      $this->db->where('id_main',0);
    $query = $this->db->get();

    //$query = $this->db->query($sql, array($str, $id_user));
    return $query->result();
     }
     else {
      return false;
     }
    }
    function doSearchLink($text, $part="")
{
    $part = ($part) ? "?:(?!$part).)*(" : ".*?";
    $re = '/(([^\/]+)[\/][^\s">]+)[\s">]/is';
    preg_match_all($re, $text, $x);
 
    $i=0;
    $s="";
    foreach ($x[1] as $k => $v) {
        if ($v) {
            $s[$i] = $v;
        
        $i++;
        }
        
    }
    
    return $s;
}


    
}