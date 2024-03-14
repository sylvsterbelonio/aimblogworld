<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Youtube {

  function getVideo($data)
        {        
        $html='<style>.video-container {position:relative;padding-bottom:56.25%;padding-top:30px;height:0;overflow:hidden;}.video-container iframe, .video-container object, .video-container embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';        
        $html.='<div class="video-container"><iframe  src="//www.youtube.com/embed/'.$data.'?modestbranding=1&amp;rel=0&amp;showinfo=0" frameborder="0" allowfullscreen="0"></iframe></div>';
        return $html;
        }

}
?>
