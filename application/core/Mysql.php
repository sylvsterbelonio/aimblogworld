<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mysql{

    protected $CI;
    
    public $table="";
    
    public function __construct()
    {
     $this->CI =& get_instance();
    }
    
    public function setTable($tablename)
    {
    $table=$tablename;
    }


}

?>
