<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

        function __construct() { 
        parent::__construct();
        
        $this->load->model('mdlSystemuser');
        $this->load->model('mdlAdmin');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session'));	
        $this->load->database();
        
        }
	
        public function index()
        {   
///////////////////////////////////////////////////////  
//LOG IN PURPOSE/////////////////////////////////////// 
            $data['ftxtusername'] = array(
            'name' => 'username',
            'id' => 'txtusername',
            'size' => '16',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all'
            );
            
            $data['ftxtpassword'] = array(
            'name' => 'password',
            'id' => 'txtpassword',
            'size' => '16',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all'
            );
            
            $data['fcmdlogin'] = array(
            'id' => 'cmdLogIn',
            'class'=> 'ui-state-default ui-corner-all',
            'content'=>'Log In'
            );
            
            $data['fchkKeepLoggedIn'] = array(
            'id'=>'chkKeepLoggedIn',
            'style' => 'width:10px;height:10px',
            'class' =>'ui-checkbox'
            );
///////////////////////////////////////////////////////  
//CREATE ACCOUNT///////////////////////////////////////
            $data['ftxtfirstname'] = array(
            'title'=>'Firstname',
            'name' => 'firstname',
            'id' => 'txtfirstname',
            'size' => '23',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all ui-textbox-watermark'
            );
            $data['ftxtlastname'] = array(
            'title'=>'Lastname',
            'name' => 'lastname',
            'id' => 'txtlastname',
            'size' => '24',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all ui-textbox-watermark'
            );
            $data['ftxtemail'] = array(
            'title'=>'Email or Mobile Number',
            'name' => 'email',
            'id' => 'txtemail',
            'size' => '54',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all ui-textbox-watermark'
            ); 
            $data['ftxtremail'] = array(
            'title'=>'Re enter Email or Mobile Number',
            'name' => 'remail',
            'id' => 'txtremail',
            'size' => '54',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all ui-textbox-watermark'
            ); 
            $data['ftxtnpassword'] = array(
            'title'=>'Password',
            'name' => 'npassword',
            'id' => 'txtnpassword',
            'size' => '54',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all ui-textbox-watermark'
            );      
            
            $data['fcbolstMonth'] = array(
            '0'         => 'Month',
            '1'           => 'Jan',
            '2'         => 'Feb',
            '3'        => 'Mar',
            '4'        => 'Apr',
            '5'           => 'May',
            '6'         => 'Jun',
            '7'        => 'Jul',
            '8'        => 'Aug',
            '9'           => 'Sep',
            '10'         => 'Oct',
            '11'        => 'Nov',
            '12'        => 'Dec'
            );
            $data['fcboMonth']=array(
            'name'=>'cboMonth',
            'id'=>'cboMonth',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-state-default ui-corner-all'
            );
            
            $data['fcbolstDay'] = array(
            '0'         => 'Day'
            );
            $day = 1;
            while ($day<=31) {
            array_push($data['fcbolstDay'],$day);
            $day+=1;
            }
            
            $data['fcboDay']=array(
            'name'=>'cboDay',
            'id'=>'cboDay',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-state-default ui-corner-all'
            );            
            
            $data['fcbolstYear'] = array(
            '0'=>'Year'
            );
            
            $year = date('Y');
            while ($year>=1905) {
            array_push($data['fcbolstYear'],$year);
            $year-=1;
            }
            $data['fcboYear']=array(
            'name'=>'cboYear',
            'id'=>'cboYear',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-state-default ui-corner-all'
            ); 
            
            $data['foptM']=array(
            'id'=>'optM',
            'name'=>'gender'

            );

            $data['foptF']=array(
            'id'=>'optF',
            'name'=>'gender'
            );            
            
            $data['ftxtaccountID'] = array(
            'title'=>'Account ID',
            'name' => 'naccountid',
            'id' => 'txtaccountid',
            'size' => '54',
            'value'=>'',
            'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all ui-textbox-watermark'
            );  
            
            $data['ftxtsecuritycode'] = array(
            'title'=>'Security Code',
            'name' => 'nsecuritycode',
            'id' => 'txtsecuritycode',
            'size' => '54',
            'value'=>'',
              'style'=>'padding:5px 10px',
            'class'=> 'ui-widget-content ui-corner-all ui-textbox-watermark'
            );
            
            $data['fcmdcreate'] = array(
            'id' => 'cmdCreate',
            'class'=> 'ui-button ui-corner-all',
            'content'=>'Create'
            );
          
                                             
        $data['title'] = 'Aim Global Alliance Personal Blog Site';
            
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $data['errorLogIn']='';

        $this->load->view('header/header',$data);   
                if ($this->form_validation->run() == FALSE)
                {

                       $this->load->view('body/loginpage', $data);
                }
                else
                {
                      $ret1 = $this->mdlSystemuser->retrieve_user($_POST['username']);
              	          if($ret1)
                            {
              		            $ret = $this->mdlSystemuser->validate_user($_POST['username'], $_POST['password']);
                        			if($ret)
                                  {                                 
                                  $value = $this->mdlSystemuser->get_current_user_info($_POST['username'], $_POST['password']);
                                  $val = explode("~",$value);
                                  $data['PIID']= $val[0];
                                  $data['name']= $val[1];
                                  $data['userLevel']= $val[2];
                                  $data['emailAddress']= $val[3];
                                  $data['desc']= $val[4]; 
                                  
                                  //Populate Accordion based on the userlevel entry menu//
                                  if($data['PIID']!="0"){
                                  $data['accordionMenu'] = $this->mdlAdmin->getAccordionMenu($data['userLevel'],$data['PIID']);                                  
                        				  $this->load->view('body/myadmin', $data);	                                                                    
                                  }
                                  else
                                  {
                                  echo "Error Load Website".$data['PIID'];
                                  }
                        					}
                        			else
                        					{
                        		$data['errorLogIn']= "Username and Password does not match.";	
                            $this->load->view('body/loginpage', $data);						
                        					}
                        		}
                        	else
                            {
                        		$data['errorLogIn']= "Username does not exist";	
                            $this->load->view('body/loginpage', $data);			 
                            }
                }
         $this->load->view('footer/footer');
            
        }

        public function logIn()
        {

        }
        
        
        function confirm_login()
        {
            $ret1 = $this->mdlSystemuser->retrieve_user($_POST['username']);
	          if($ret1)
              {
		            $ret = $this->mdlSystemuser->validate_user($_POST['username'], $_POST['password']);
          			if($ret)
                    {
          				  echo "ok";
          					}
          			else
          					{
          					echo "Error Password";						}				
          					}
          	else
              {
          		echo "Username does not exist";				 
              }

        }
}









?>
