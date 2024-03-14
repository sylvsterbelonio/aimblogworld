<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//$route['default_controller'] = "main";
//$route[':any/shop']="ctrlMainBlog/shop";
$route['default_controller'] = "ctrlMainBlog";//HOME PAGE//

//////ABOUT MODULES//
$route['company'] = "ctrlBlog_About/company";
$route['company/event/getData'] = "ctrlBlog_About/getData";
$route[':any/company'] = "ctrlBlog_About/company";

$route['board-of-directors']="ctrlBlog_About/board_of_directors";
$route[':any/board-of-directors'] = "ctrlBlog_About/board_of_directors";
$route['business-partners']="ctrlBlog_About/company_partners";
$route[':any/business-partners'] = "ctrlBlog_About/company_partners";
$route['business-partners']="ctrlBlog_About/company_partners";
$route[':any/alive-foundation'] = "ctrlBlog_About/alive_foundation";
$route['alive-foundation'] = "ctrlBlog_About/alive_foundation";
$route[':any/tie-ups'] = "ctrlBlog_About/tie_ups";
$route['tie-ups'] = "ctrlBlog_About/tie_ups";
///////CUSTOMER MODULES//
$route['account/signout'] = "ctrlBlog_Customers/signOut";
$route['account/signin'] = "ctrlBlog_Customers/signIn";
$route['account/register'] = "ctrlBlog_Customers/register";
$route['account/verifyemail'] = "ctrlBlog_Customers/checkEmailExist";

$route['account/errors'] = "ctrlBlog_Customers/errors";


$route['hit/lovelike'] = "ctrlBlog_Customers/addLoveLike";
$route[':any/account/signout'] = "ctrlBlog_Customers/signOut";
$route[':any/account/signin'] = "ctrlBlog_Customers/signIn";
$route[':any/account/register'] = "ctrlBlog_Customers/register";
$route[':any/hit/lovelike'] = "ctrlBlog_Customers/addLoveLike";
///////SHOP MODULES//////
$route['shop']="ctrlBlog_Shop/shop";//SHOP MODULES//
$route[':any/shop']="ctrlBlog_Shop/shop";

$route['shop/event/typeview']="ctrlBlog_Shop/setViewType"; //SEARCHING VIEW TYPE - GRID||LIST
$route['shop/event/navigationFooter']="ctrlBlog_Shop/setNavigationFooter";

    //////CATEGORY PRODUCTS//
    
    $route['shop/aimworldproducts']="ctrlBlog_Shop/link_categories";    
    $route['shop/burn']="ctrlBlog_Shop/link_categories";      
    $route['shop/functionalbeverages']="ctrlBlog_Shop/link_categories";     
    $route['shop/naturalceuticals']="ctrlBlog_Shop/link_categories";        
    $route['shop/nutritionalcosmeceuticals']="ctrlBlog_Shop/link_categories";      
    $route['shop/nutritionalsupport']="ctrlBlog_Shop/link_categories";  
    $route['shop/services']="ctrlBlog_Shop/link_categories";     
    $route['shop/globalpackages']="ctrlBlog_Shop/link_categories";             
    $route[':any/shop/aimworldproducts']="ctrlBlog_Shop/link_categories";
    $route[':any/shop/burn']="ctrlBlog_Shop/link_categories";   	
    $route[':any/shop/functionalbeverages']="ctrlBlog_Shop/link_categories";	
    $route[':any/shop/naturalceuticals']="ctrlBlog_Shop/link_categories";     
    $route[':any/shop/nutritionalcosmeceuticals']="ctrlBlog_Shop/link_categories";
    $route[':any/shop/nutritionalsupport']="ctrlBlog_Shop/link_categories";
    $route[':any/shop/services']="ctrlBlog_Shop/link_categories";
    $route[':any/shop/globalpackages']="ctrlBlog_Shop/link_categories";      

//////////PRODUCTS//////////////////////////////////////////////////////////////
    $route['product']="ctrlBlog_Products";
    $route['product/event/quickview']="ctrlBlog_Products/quickview";
    $route['product/form/details']="ctrlBlog_Products/loadDialogDetails";
    
    $route['shop/burn/burncoffee']="ctrlBlog_Products/productFullDetails";
    $route['shop/nutritionalsupport/c247']="ctrlBlog_Products/productFullDetails";

    $route[':any/shop/burn/burncoffee']="ctrlBlog_Products/productFullDetails";
    $route[':any/shop/nutritionalsupport/c247']="ctrlBlog_Products/productFullDetails";
        
    $route['shop/event/searchYoutube'] = "ctrlBlog_Products/searchYoutube";


//////////LEARN MORE////////////////////////////////////////////////////////////
    $route['learnmore']="ctrlBlog_Learnmore";
    $route[':any/learnmore']="ctrlBlog_Learnmore";
    
    
    
    $route['learnmore/company-policies']="ctrlBlog_Learnmore/companypolicy";
    $route[':any/learnmore/company-policies']="ctrlBlog_Learnmore/companypolicy";
    $route['learnmore/product-presentation']="ctrlBlog_Learnmore/productPresentation";
    $route['learnmore/product-presentation/more']="ctrlBlog_Learnmore/getListMore";
    $route['learnmore/product-presentation/rightmore']="ctrlBlog_Learnmore/getRightListMore";
    $route['learnmore/product-presentation/search']="ctrlBlog_Learnmore/searchListMore";
    $route['learnmore/product-presentation/rightsearch']="ctrlBlog_Learnmore/searchRightListMore";
    $route[':any/learnmore/product-presentation']="ctrlBlog_Learnmore/productPresentation";      
    $route['learnmore/aim-trainings']="ctrlBlog_Learnmore/aim_trainings";
        
    $route['learnmore/company-policies/learn']="ctrlBlog_Learnmore/companypolicy";
    $route[':any/learnmore/company-policies/learn']="ctrlBlog_Learnmore/companypolicy";        
//////////CONTROLS//////////////////////////////////////////////////////////////
    $route['controls/bxslider']="ctrlControls/bxslider";
        
    
    $route['hi-admin']="ctrlBlog_Admin";
    
    
/////THIS IS FOR ADMIN/////////////
    $route['admin'] = "main";
    $route['login'] = "admin/confirm";
    $route['admin/accordionMenu'] = "admin/getAccordionMenu";
    $route['admin/:any'] = "main/login";
    
    $route['country/:any'] = "ctrlCountry/getListCountries";
    $route['countrylist/:any'] = "ctrlCountry/getListForm";
    $route['ctrlCountry'] = "ctrlCountry/uploadFlag";
    $route['ctrlCountry/:any'] = "ctrlCountry/getListForm";
    $route['bco/:any'] = "ctrlBCO/getListBCO";
    $route['ctrlBCO/:any'] = "ctrlBCO/getListForm";
    $route['operation/:any'] = "ctrlOperation/getListOperation";
    $route['ctrlOperation/:any'] = "ctrlOperation/getListForm";
    $route['pcategory/:any'] = "ctrlPCategory/getListPCategory";
    $route['ctrlPCategory/:any'] = "ctrlPCategory/getListForm";
    $route['product/:any'] = "ctrlProduct/getListProduct";
    $route['ctrlproduct/:any'] = "ctrlProduct/getListForm";
    $route['productdetails/:any'] = "ctrlProductDetails/getListPrice";
    $route['globalTestimony/:any'] = "ctrlProductDetails/getListGTestimony";
    $route['ctrlProductDetails/:any'] = "ctrlProductDetails/getListForm";
    $route['package/:any'] = "ctrlPackage/getListPackage";
    $route['itempackage/:any'] = "ctrlPackage/getListPackage_item";
    $route['ctrlpackage/:any'] = "ctrlPackage/getListForm";
    
    $route['ctrlTheme/:any'] = "ctrlTheme/getForm";
    
    $route['media/:any'] = "ctrlMedia/getListMedia";
    $route['ctrlMedia/:any'] = "ctrlMedia/getListForm";




$route[':any']="ctrlMainBlog";
$route['404_override'] = '';
$route['scaffolding_trigger'] = "";
