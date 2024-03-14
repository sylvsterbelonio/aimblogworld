<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Number {

    public function formatNumber($value)
        {
        $strvar = (string) $value;
        $length = strlen($strvar);
        
        $html="";
        
        $reverse="";
        //REVERSE DIGIT FIRST//
        for($i=$length;$i>=0;$i--)
            {
            $reverse.=substr($strvar,$i,1);
            }
        
        //ADDING A COMMA HERE//
        for($i=0;$i<$length;$i++)
            {
            if($i % 3 == 0)
                {
                if($i!=$length) $html.=",".substr($reverse,$i,1);
                }
            else
                {
                $html.=substr($reverse,$i,1);
                }
            }
        //BACK TO NORMAL DIGITS
        $normal="";
        $length = strlen($html);
        for($i=$length;$i>=0;$i--)
            {
            $normal.=substr($html,$i,1);
            }            
            
            
        return substr($normal,0,$length-1);
        }

}

?>
