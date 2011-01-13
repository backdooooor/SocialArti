<?
class Search extends Model {

    function doSearch($str){
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

    
}