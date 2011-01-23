<?
class Filter extends Model {

   function doHTML($str)
{

     $str=htmlspecialchars($str);
     $str=str_replace("\n", "<br>", $str);
     return $str;    
   }







}