<?

class Content extends Model {

    
   function getType($url){
    $result = strpos($url, "mp3");
    if($result>0){
       return "audio"; 
    }
     $result = strpos($url, "gif");
     if($result>0){
       return "image"; 
    }
     $result = strpos($url, "jpg");
     if($result>0){
       return "image"; 
    }
     $result = strpos($url, "png");
     if($result>0){
       return "image"; 
    }
    $result = strpos($url, "vkontakte.ru");
     if($result>0){
       return "video"; 
    }
      $result = strpos($url, "youtube");
     if($result>0){
       return "video"; 
    }
    return "";
   }
   function getVideo($url){
      if($this->getType($url)!="video") return ""; 
       $result = strpos($url, "vkontakte.ru");
       
     if($result>0){
      return  $this->doCodeVkontakte($url); 
    }
      $result = strpos($url, "youtube");
     if($result>0){
      
       return $this->doCodeYoUTube($url);
   }
   }
   function getAudio($url){
     if($this->getType($url)!="audio") return ""; 
    return  '<object type="application/x-shockwave-flash" data="http://flv-mp3.com/i/pic/ump3player_500x70.swf" height="70" width="300"><param name="wmode" VALUE="transparent" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="movie" value="http://flv-mp3.com/i/pic/ump3player_500x70.swf" /><param name="FlashVars" value="way='.$url.'&amp;swf=http://flv-mp3.com/i/pic/ump3player_500x70.swf&amp;w=470&amp;h=70&amp;time_seconds=0&amp;autoplay=0&amp;q=&amp;skin=white&amp;volume=70&amp;comment=" /></object>';
   }
   function getImage($url){
   if($this->getType($url)=="image") {
   return  "<br><a href='".$url."'><img src='".$url."'  width=200px height=200px /></a>";    }
return "";
   }
   function doCodeVkontakte($url){

$data=explode("_",$url);
$id=$data[1];
$data=explode(".ru/video",$data[0]);
$oid=$data[1];
$code='<iframe  id="vk" src="http://vkontakte.ru/video_ext.php?oid='.$oid.'&id='.$id.'&hash=0210d732b45e93d7" width="320" height="180" frameborder="1"></iframe>';
return $code;

   }
   function doCodeYoUTube($url){
    $data=explode("watch?v=",$url);
    $newstr=explode("&",$data[1]);
    $data[1]=$newstr[0];
    $id_video=$data[1];
   

    $code='<object   id="vk" width="200" height="200"><param name="movie" value="http://www.youtube.com/v/'.$id_video.'=1&amp;hl=ru_RU"></param><param name="wmode" value="opaque" /><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$id_video.'?fs=1&amp;hl=ru_RU" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="200" height="200"></embed></object>';
   
    return $code;

   }
   function doContent($url,$type){
    $filter=$this->getType($url);
  
    if($filter=="image")  return $this->getImage($url);
    if($filter=="video") return $this->getVideo($url);
    if($filter=="audio") return $this->getAudio($url);  
    return "";
        
        
    
   }

}

?>