<?
class Filter extends Model {

   function doHTML($str)
{
     $str=htmlspecialchars($str);
     return $str;    
   }







}