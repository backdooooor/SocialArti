<?
class User extends Model {
//модель для работы с пользовательскими данными
   function doRegister($email,$password,$profile){
//       echo $profile;
//if($profile=="" or $profile==null) return "0";
   if($email=="" or $email==null or $password==null or $password=="") return "0";
$new_password=md5($password);
$data = array(
               'email' => $email,
               'password' => $new_password,
               'profile'=>$profile
            );

$this->db->insert('users', $data);

return "1";
   }
   function  doAuth($email,$password){
if($email=="" or $email==null or $password==null or $password=="") return false;

           $this->load->database();
           $this->load->library('session');
           
    $query = $this->db->get_where('users', array("email" => $email, 'password' => md5($password)), 1);

    if ($query->num_rows()==1)  //авторизация пройдена
    {
        $data = $query->row_array();
        unset($data['password']); //уберем из данных пользователя пароль, он хоть и зашифрован, но там совершенно не нужен.
        $data['logged_in']  =  TRUE;                  //флаг того, что авторизирован для сессии
        $this->db->update('users', array('last_login' => time()), array('id' => $data['id']));  //устанавливаем последним входом текущую дату
        $this->session->set_userdata($data);
        return "1";            //говорим что все ок
    }
    else                        //авторизация не пройдена
        return "0";
   }
   function checkAuth(){
$this->load->library('session');

    if ($this->session->userdata('logged_in'))
        return "1";
    else
        return "0";
   }
   function getID($nick){
       $this->db->where("nick",$nick);
     $query = $this->db->get('users');
     $row = $query->row();
     
return  $row->id;
   }
   function getProfile($var,$opt="id"){
if($var==null or $var=="") return "";
 $this->db->where($opt,$var);
$query = $this->db->get('users');
return $query->result();
       
   }
   function updateProfile($id_user,$profile){
       if($id_user==null or $id_user=="" or !(int)$id_user) return false;
       if($profile==null or  $profile=="") return false;
       $data = array(
               'profile' => $profile

            );

$this->db->where('id', $id_user);
$this->db->update('users', $data);
return true;
   }

}


?>