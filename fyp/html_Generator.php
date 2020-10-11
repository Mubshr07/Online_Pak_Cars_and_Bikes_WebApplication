<?php
//session_start();
include 'DB_Class.php';

class HTML_Generator {


	public $baseurl;
	public $headSection;
	public $footer;

	public $loginSection;
	public $registerSection; 
	public $db_Obj;

	public function __construct()
	{
		$this->db_Obj = new DB_Class();
		$this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";

		$this->headSection = '<!DOCTYPE html>
		<html lang="en" nighteye="active" style="background-image: none !important;" ne="0.32044710471749926">
		<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="bootstrap.css" type="text/css">
		<script type="text/javascript" src="jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
  		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<title> OPCB Project </title>
		</head>
		<body>
		<header>
		<nav class="navbar">
		<div class="main_search row" style="margin-left:60%;"> 
			<span class=""> 

			<form class="form-inline" name="form_searchBar">  
				<div class="input-group mb-2 mr-sm-2"> 
					<input type="search" class="form-control" id="searchBar" name="searchBar" placeholder="Search..">
				</div> 
				<button type="submit" class="btn btn-primary mb-2" onclick="Search_Bar(this)" > Search </button>
		    </form>

			<script>
				var input = document.getElementById("searchBar");
				input.addEventListener("keyup", function(event) {
						if (event.keyCode === 13) {
							event.preventDefault();
							document.getElementById("searchBarBtn").click();
						}
					});
			</script>
 
		
			</span>		
		</div>
			<div class="nav_brand align-content-center"><div id="logo"><a href="'. $this->baseurl .'?val=home"> <img  class="align-self-center" src="assets/images/logo/Logo.png" width="350" height="145" > </a></div>
		</div>
		</nav>
		</header> <div class="main_wrapper"><div id="content">';
 
		$this->loginSection = '	<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box" >Login Form</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		<form name="formlogin" id="formlogin" method="post">
		<div class="form-group">
		<label for="username">Username or Email Addess</label>
		<input type="text" class="form-control" id="username" placeholder="Email Enter Here" name="login_username"  maxlength="20"  required>
		</div>
		<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" placeholder="Your password here" name="login_password" maxlength="20" required>
		</div>
		<input type="hidden"  class="hidden" name="login" value="login">
		<input type="button" onclick="Login(this)" class="btn btn-primary btn-lg btn-block" value="LOGIN">
		</form><br>
		<p>Don\'t have an Account? <a style="color:black; font-weight:800; font-size:16px;" href="'.$this->baseurl.'?val=registor"> Registor Now!</a></p>

		<div id="output"></div>

		</div>

		</div></div></div>';


		$this->registerSection = ' <div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">Register Form</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		<form method="post" name="form_signup" id="form_signup">
		<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" id="username"  name="username" placeholder="username" required="">
		</div>
		<div class="form-group">
		<label for="firstName">First Name</label>
		<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required="">
		</div>
		<div class="form-group">
		<label for="lastName">Last Name</label>
		<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required="">
		</div>
		<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required="">
		</div>
		<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" name="password" placeholder="Your password here" required="">
		</div>
		<div class="form-group">
		<label for="repassword">Password</label>
		<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re-enter password here" required="">
		</div>
		<input type="hidden"  class="hidden" name="signup" value="signup">

		<input type="button" class="btn btn-primary btn-lg btn-block" value="SIGNUP" onclick="Register(this)">
		</form><br>
		<p> Want to <a style="color:black; font-weight:800; font-size:16px;" href="'. $this->baseurl . '?val=login"> Login!</a></p>
		<div id="output"></div>
		</div>
		</div></div></div> ';




		$this->footer = ' <!-- Modal -->
		<div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalCenteredLabel">Modal title</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body" id="modal-body" >
		<span class="w-100" id="abcc"> </span>

		<br> 
		<div  id="modaltable">  
		</div> 


		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
		</div>
		</div>
		</div> ';
		$this->footer .= '<script type="text/javascript" src="JS_form.js"></script>
						  	<script type="text/javascript" src="assets/bootstrap/js/jquery.min.js"></script>
  							<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
							</div> <br> <footer> Copyright © OPCB </footer> </div> </body></html>';



	}

	

	public function GiveMe_headerSection()
	{ 
		//setcookie ("username", 'username' ,time()+ (10 * 365 * 24 * 60 * 60));  
    	//setcookie ("password", 'password' ,time()+ (10 * 365 * 24 * 60 * 60));
		
		echo $this->headSection;
	}
	public function GiveMe_footerSection()
	{
		echo $this->footer;
	}

	public function GiveMe_HomeSection()
	{ 
		$rows = $this->db_Obj->Get_NewUpdates();

		echo  '<div id="content_wrapper"> 
							<div class="featured_image"> <div class="head_box"> Recently Ads </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 5px; padding-right: 10px; padding-bottom: 5px; padding-left: 20px; ">
		 <div class="agileits-top">';

		if(!empty($rows))
		{
			$ro = $rows->fetch_array();
			echo ' <div id="audioDetails">
			<div class="container custmhome">
			<div class="row">
			<div class="col-md-12"> 
			<div class="row">';
 			foreach ($rows as $row)
			{  
				if($row['soldDelete'] == 0)
				{
					echo ' <div class="col-md-3"> <div class="adBtn" > <a href="'. $this->baseurl.'?val=ADdetail&ID='.$row['id'].'">  
						<div class="adImage" >   <img style="max-width:100%; max-height:100%; margin:0 auto;  "  src="advertisementBank/'. $row['pics'].'" title="'.$row['title'].'" > </div>
						<div class=" block-ellipsis"> <span class="font-weight-bold text-break text-lg-left block-ellipsis">'.$row['title'].'</span> </div> ';
					echo '<span class="text-muted" style="font-size:12px; margin:0; padding:0; color:black;"> <span class="block-ellipsis" style=" font-size:12px; color:black;">Price '.$row['price'].' pkr</span>'
					.' Dated : <span class="font-italic " style=" font-size:12px; color:black;">'.$row['uploadingDate'].'</span>  </span> </div>  </a> </div>';
				}
		    } // end of foreach loop
			echo '</div></div></div></div> </div>';

		} // end of if empty($rows)
		else
		{
			echo ' From General-HTML No Songs are available in DataBase. Please upload some files. ';
		}
		echo ' </div> </div> </div> ';

	} // end of Get_NewUpdates
	public function GiveMe_login()
	{
		echo $this->loginSection;
	} // end of GiveMe_login
	public function GiveMe_registerForm()
	{
		echo $this->registerSection;
	} // end of GiveMe_registerForm


	public function GiveMe_ADdetail ($advertiseID)
	{
		$rowss = $this->db_Obj->Get_ADdetail_this($advertiseID);
		$rows = $rowss->fetch_array();
		echo '<div id="content_wrapper">
			<div class="featured_image">
			<div class="head_box"> Ad Details </div>
			</div>
		<div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">  
		
		<div class="adImageDetail" > <img style="max-width:auto; max-height:250px; margin:0 auto; " src="advertisementBank/'. $rows['pics'].'" title="'.$rows['title'].'" > </div>
					
		<div class="form-group row">
		<label for="title" class="col-sm-3 col-form-label"> Title  </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="title"  name="title" value="'.$rows['title'].'" readonly>
		</div></div>

		<div class="form-group row">
		<label for="price" class="col-sm-3 col-form-label"> Fix Price (Pak Ruppees) </label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="price" name="price"   value="'.$rows['price'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="contactNo" class="col-sm-3 col-form-label"> Contact Number  </label>
		<div class="col-sm-9">
		<input type="tel" class="form-control" id="contactNo" name="contactNo"  value="'.$rows['contactNo'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="type" class="col-sm-3 col-form-label">Vehicle Type</label>
		<div class="col-sm-9">
			<input type="text" class="form-control"  value="'.$rows['type'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="Brand" class="col-sm-3 col-form-label">Brand Name</label>
		<div class="col-sm-9">
		<input type="text" class="form-control"  value="'.$rows['brandName'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="model" class="col-sm-3 col-form-label">Model Name </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="model" name="model"  value="'.$rows['modelName'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="makeYear" class="col-sm-3 col-form-label">Make Year  </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="makeYear" name="makeYear"  value="'.$rows['makeYear'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="engine" class="col-sm-3 col-form-label">Engine Capacity</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="'.$rows['engineCapacity'].'" readonly>
		</div> </div>


		<div class="form-group row">
		<label for="seating" class="col-sm-3 col-form-label">Seating Capacity </label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="seating" name="seating"   value="'.$rows['seatingCapacity'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="bodyType" class="col-sm-3 col-form-label">Body Type  </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="bodyType" name="bodyType"  value="'.$rows['bodyType'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="conditionType" class="col-sm-3 col-form-label">Condition Type</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" value="'.$rows['conditionType'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="condition" class="col-sm-3 col-form-label">condition out of 10 </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="condition" name="condition"   value="'.$rows['condition_is'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="registered" class="col-sm-3 col-form-label">Registered ?</label>
		<div class="col-sm-9">
			<input type="text"class="form-control"  value="'.$rows['registered'].'" readonly>
		</div> </div>
		
		<div class="form-group row">
		<label for="registrationCity" class="col-sm-3 col-form-label">Registration City </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="registrationCity" name="registrationCity"  value="'.$rows['registrationCity'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="mileage" class="col-sm-3 col-form-label">Driven Km </label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="mileage" name="mileage"   value="'.$rows['mileageDriven'].'" readonly>
		</div> </div>

		<div class="form-group row">
		<label for="remarks" class="col-sm-3 col-form-label"> Your Remarks about it </label>
		<div class="col-sm-9">
		<textarea class="form-control" id="remarks" name="remarks" readonly> '.$rows['ownerRemarks'].' </textarea>
		</div>  </div>

		<div class="form-group row">
		<label for="date" class="col-sm-3 col-form-label"> Advertisement Date </label>
		<div class="col-sm-9"> 
		<input type="text" class="form-control" id="updatingDate" name="updatingDate"  value="'.$rows['updatingDate'].'" readonly>
		</div>  </div>
  
		<br> 
		</div> </div></div></div>';
	}





public function GiveMe_aside ($user = false, $admin = false)
{ 
		echo '<aside>'; 
		if(isset($_SESSION["log"]) && isset($_SESSION["usertype"]) )
		{
			if($_SESSION["log"])
			{
				if(isset($_SESSION["fullname"]) && isset($_SESSION["usertype"])){
					echo '<div class="box-head"> Welcome '. $_SESSION["usertype"] . '  ' . $_SESSION["fullname"] . '</div>';
				}else{
					echo '<div class="box-head"> Links </div>';
				}

				echo '<div id="categoriesContent">
				<ul>
				<li><a href="'; echo $this->baseurl; echo '?val=myprofile">My Profile</a></li>
				<li><a href="'; echo $this->baseurl; echo '?val=upload"> New Ad </a></li>
				<li><a href="'; echo $this->baseurl; echo '?val=myAllPosts">My Ads</a></li>';

				if(isset($_SESSION["usertype"])){
					if($_SESSION["usertype"] == "admin"){
						//echo '<li><a href="'; echo $this->baseurl; echo '?val=appNewUser"> Approve New Users </a></li>';
						//echo '<li><a href="'; echo $this->baseurl; echo '?val=appNewPost"> Approve New Posts</a></li>';
						//echo '<li><a href="'; echo $this->baseurl; echo '?val=mgmtUser"> Manage Users</a></li>';
						//echo '<li><a href="'; echo $this->baseurl; echo '?val=mgmtPost"> Manage Posts</a></li>';
						echo '<li><a href="'; echo $this->baseurl; echo '?val=singleuserPosts"> Search User Ads</a></li>';
						echo '<li><a href="'; echo $this->baseurl; echo '?val=webinfo"> Web Info </a></li>';
					}
				}
				echo ' <li><a href="'; echo $this->baseurl; echo '?val=logout" >Logout</a></li> </ul></div>';
			}
		} // end of if(isset($_COOKIE["log"]) && isset($_COOKIE["usertype"]) && $_COOKIE["log"] )

		//------------------------------------------
				
				if(!isset( $_SESSION["log"])){
					echo '<div class="box-head"> Links </div>
							<div id="categoriesContent">
							 <ul>
								<li><a href="'; echo $this->baseurl; echo '?val=login">Login</a></li>
								<li><a href="'; echo $this->baseurl; echo '?val=registor">Register Yourself</a></li>
							</ul> </div> ';
				}
		//------------------------------------------
		
		echo '<div class="box-head"> Vehicle Type </div>
				<div id="categoriesContent">
				<ul>
					<li><a href="'. $this->baseurl .'?search=Type&searchVal=Bike"> Bike </a></li>
					<li><a href="'. $this->baseurl .'?search=Type&searchVal=Car"> Car </a></li>
					<li><a href="'. $this->baseurl .'?search=Type&searchVal=Jeep"> Jeep </a></li>
				</ul></div> ';
		//------------------------------------------

				echo '<div class="box-head">Brands </div>
				<div id="categoriesContent"> <ul>';
		
				$categories = $this->db_Obj->Get_Brandss();
				if(!empty($categories)){
					foreach ($categories as $category ) {
						echo '<li><a href="'. $this->baseurl .'?search=Brand&searchVal='.$category['brandName'].'">'.$category['brandName'].'</a></li>';	
					}
				}
				else
				{
					echo '<li> Donot have any categories </li>';	
				}
				
				echo '</ul></div>';
				
				echo ' <br> </aside>';

	} // end of GiveMe_aside




} // end of class


?>