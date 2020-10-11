<?php

include 'html_Generator.php';
include 'html_User.php';
include 'html_Admin.php';
include 'html_Search.php';

//session_start();


class Redirect {
	
	var $debugging;
	var $html_gen; 
	var $html_user;  
	var $html_admin;
	var $html_search;

	public function __construct( ){ 
		$this->html_gen = new HTML_Generator();
		$this->html_user = new HTML_User();
		$this->html_admin = new HTML_Admin();
		$this->html_search = new HTML_Search();
		$this->debugging = false;
	 }

	public function Go_to_HOME_Page(){
		if($this->debugging === true){ echo " Go_to_HOME_Page ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_gen->GiveMe_HomeSection();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();	
	}
	public function Go_to_Registration()
	{
		if($this->debugging === true){ echo " Go_to_Registration ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_gen->GiveMe_registerForm();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}
	public function Go_to_Login()
	{
		if($this->debugging === true){ echo " Go_to_Login ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_gen->GiveMe_login();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}
	public function Go_to_Upload()
	{
		if($this->debugging){ echo " Go_to_Upload ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_user->GiveMe_Upload();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}
	public function Go_to_User_All_Posts()
	{
		if($this->debugging){ echo " Go_to_User_All_Posts ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_user->GiveMe_myallpost();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}
	public function Go_to_myProfile()
	{
		if($this->debugging === true){ echo " Go_to_myProfile ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_user->GiveMe_myprofile();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}
	public function Go_to_ADdetail($advertiseID)
	{
		if($this->debugging === true){ echo " Go_to_ADdetail ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_gen->GiveMe_ADdetail($advertiseID);
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}
	public function Go_to_ADedit($advertiseID)
	{
		if($this->debugging === true){ echo " Go_to_ADedit ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_user->GiveMe_ADedit($advertiseID);
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}
	public function singleuserPosts()
	{
		if($this->debugging === true){ echo " Go_to_singleuserPosts ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_admin->GiveMe_seeOneuserPosts();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();
	}

	public function Go_to_WebInfo(){
		if($this->debugging === true){ echo " Go_to_Categories ";} 
		$this->html_gen->GiveMe_headerSection();
		$this->html_admin->GiveMe_WEB_INFO();
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();	
	}

 

//--------- Saerch Functions
	 
	public function Go_to_Search_Results($variable_Value, $value){
		//echo "Search Results function with value : " .$variable_Value ; 
		$this->html_gen->GiveMe_headerSection();
		$this->html_search->Get_Search_Category($variable_Value, $value);
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();	
	}
	public function Go_to_SearchBar_Results($variable_Value){
		//echo "Search Results function with value : " .$variable_Value ; 
		$this->html_gen->GiveMe_headerSection();
		$this->html_search->Get_SearchBar_HTML($variable_Value);
		$this->html_gen->GiveMe_aside();
		$this->html_gen->GiveMe_footerSection();	
	}


} // end of Redirect class

?>