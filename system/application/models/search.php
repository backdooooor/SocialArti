<?
class Search extends Model {

    function doSearch($str){
  $CI =& get_instance();
        $CI->load->model('Filter');
        $str=$CI->Filter->doHTML($str);
         if((int)$this->session->userdata('id')){
             $id_user=(int)$this->session->userdata('id');
             $str="%".$str."%";
          $sql = "SELECT *
          FROM users
          WHERE  profile LIKE  ?   and  id!=?";
     
    $query = $this->db->query($sql, array($str, $id_user));
    return $query->result();
     }
     else {
      return false;
     }
        

    }

    
}