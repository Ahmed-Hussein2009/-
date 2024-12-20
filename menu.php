<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


require_once("include/dbcommon.php");
require_once('classes/menupage.php');


Security::processLogoutRequest();
if( !isLogged() || isLoggedAsGuest() ) 
{
	Security::tryRelogin();
}

if( !isLogged() )
{
	HeaderRedirect("login");
	return;
}


if (($_SESSION["MyURL"] == "") || (!isLoggedAsGuest())) {
	Security::saveRedirectURL();
}


require_once('include/xtempl.php');
require_once(getabspath("classes/cipherer.php"));

include_once(getabspath("include/product_events.php"));
$tableEvents["product"] = new eventclass_product;
include_once(getabspath("include/company_events.php"));
$tableEvents["company"] = new eventclass_company;
include_once(getabspath("include/dep_events.php"));
$tableEvents["dep"] = new eventclass_dep;
include_once(getabspath("include/maindp_events.php"));
$tableEvents["maindp"] = new eventclass_maindp;
include_once(getabspath("include/grouppro_events.php"));
$tableEvents["grouppro"] = new eventclass_grouppro;
include_once(getabspath("include/inpro_events.php"));
$tableEvents["inpro"] = new eventclass_inpro;
include_once(getabspath("include/outpro_events.php"));
$tableEvents["outpro"] = new eventclass_outpro;
include_once(getabspath("include/lostpro_events.php"));
$tableEvents["lostpro"] = new eventclass_lostpro;
include_once(getabspath("include/in_events.php"));
$tableEvents["in"] = new eventclass_in;
include_once(getabspath("include/out_events.php"));
$tableEvents["out"] = new eventclass_out;
include_once(getabspath("include/lost_events.php"));
$tableEvents["lost"] = new eventclass_lost;
include_once(getabspath("include/stock_users_events.php"));
$tableEvents["stock_users"] = new eventclass_stock_users;
include_once(getabspath("include/inexpire_events.php"));
$tableEvents["inexpire"] = new eventclass_inexpire;
include_once(getabspath("include/inexpireweak_events.php"));
$tableEvents["inexpireweak"] = new eventclass_inexpireweak;
include_once(getabspath("include/in1_events.php"));
$tableEvents["in1"] = new eventclass_in1;
include_once(getabspath("include/inexpire3month_events.php"));
$tableEvents["inexpire3month"] = new eventclass_inexpire3month;
include_once(getabspath("include/product1_events.php"));
$tableEvents["product1"] = new eventclass_product1;
include_once(getabspath("include/inpro1_events.php"));
$tableEvents["inpro1"] = new eventclass_inpro1;
include_once(getabspath("include/outpro1_events.php"));
$tableEvents["outpro1"] = new eventclass_outpro1;
include_once(getabspath("include/in2_events.php"));
$tableEvents["in2"] = new eventclass_in2;
include_once(getabspath("include/out1_events.php"));
$tableEvents["out1"] = new eventclass_out1;
include_once(getabspath("include/lostpro1_events.php"));
$tableEvents["lostpro1"] = new eventclass_lostpro1;
include_once(getabspath("include/lost1_events.php"));
$tableEvents["lost1"] = new eventclass_lost1;
include_once(getabspath("include/product2_events.php"));
$tableEvents["product2"] = new eventclass_product2;

$xt = new Xtempl();

//array of params for classes
$params = array();
$params["id"] = postvalue_number("id"); 
$params["xt"] = &$xt;
$params["tName"] = GLOBAL_PAGES;
$params["pageType"] = PAGE_MENU;
$params["isGroupSecurity"] = $isGroupSecurity;
$params["needSearchClauseObj"] = false;
$params["pageName"] = postvalue("page"); 

$pageObject = new MenuPage($params);
$pageObject->init();

$pageObject->process();
?>