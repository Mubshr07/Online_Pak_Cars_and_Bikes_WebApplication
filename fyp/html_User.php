<?php

class HTML_User {

	public $baseurl; 

	public $myallpost;
	public $myprofile;
	
	public $uploadSection;
	public $db_Obj;
	public $userProfile;
	public $category;

	public $brandss;
	public $enginee;

	public function __construct()
	{
		$this->baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";

		$this->db_Obj = new DB_Class();
		$this->brandss = $this->db_Obj->Get_Brandss();
		$this->enginee = $this->db_Obj->Get_EngineCapacity();

		if(isset($_SESSION['userid']))
		{
			$this->userProfile = $this->db_Obj->Get_UserProfile($_SESSION['userid']);  
		}


		$this->uploadSection = '';
		$this->uploadSection = '<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box"> Create New Ad </div>
		</div>
		<div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		<center><p style="font-size:20px; font-weight:700; color:white; text-decoration:underline;"> Enter valid information only.</p></center>

		<form method="post" name="form_upload" id="form_upload">

		<div class="form-group row">
		<label for="title" class="col-sm-3 col-form-label"> Ad Title <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="title"  name="title" maxlength="220" placeholder="Ad Title" required>
		</div></div>

		<div class="form-group row">
		<label for="price" class="col-sm-3 col-form-label"> Fix Price (Pak Ruppees)<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="price" name="price"  maxlength="220" min="1" max="100000000"  placeholder="Your Final Price in Pak Ruppees"  required>
		</div> </div>

		<div class="form-group row">
		<label for="contactNo" class="col-sm-3 col-form-label"> Contact Number <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="tel" class="form-control" id="contactNo" name="contactNo" value="+92-3"  maxlength="220" min="1" max="100000000"   placeholder="123-456-1234567"  required>
		</div> </div>

		<div class="form-group row">
		<label for="type" class="col-sm-3 col-form-label">Vehicle Type</label>
		<div class="col-sm-9">
			<select name="type" class="select-field custom-select" id="type"  required>
				<option value="Bike">Bike</option>
				<option value="Car">Car</option> 
				<option value="Jeep">Jeep</option> 
			</select>
		</div> </div>

		<div class="form-group row">
		<label for="Brand" class="col-sm-3 col-form-label">Brand Name</label>
		<div class="col-sm-9">
		<select name="Brand" class="select-field custom-select" id="Brand"  required>';
		if(!empty($this->brandss))
		{
			foreach ($this->brandss as $key) {
				$this->uploadSection .= '<option value="'.$key['brandName'].'">'.$key['brandName'].'</option>';
			}
		}else{
			$this->uploadSection .= '<option value="Toyota">Toyota</option>
			<option value="Suzuki">Suzuki</option> ';
		}
		$this->uploadSection .= '</select>
		</div> </div>

		<div class="form-group row">
		<label for="model" class="col-sm-3 col-form-label">Model Name<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="model" name="model"  maxlength="220"  placeholder="Model Full Name"  required>
		</div> </div>


		<div class="form-group row">
		<label for="makeYear" class="col-sm-3 col-form-label">Make Year<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="month" class="form-control" id="makeYear" name="makeYear"  maxlength="220"  placeholder="Year of Make"  required>
		</div> </div>

		<div class="form-group row">
		<label for="engine" class="col-sm-3 col-form-label">Engine Capacity</label>
		<div class="col-sm-9">
		<select name="engine" class="select-field custom-select" id="engine"  required>';
		if(!empty($this->enginee))
		{
			foreach ($this->enginee as $key) {
				$this->uploadSection .= '<option value="'.$key['capacity'].'">'.$key['capacity'].'</option>';
			}
		}else{
			$this->uploadSection .= '<option value="660">660</option>
			<option value="1000">1000</option> ';
		}
		$this->uploadSection .= '</select>
		</div> </div> 

		<div class="form-group row">
		<label for="seating" class="col-sm-3 col-form-label">Seating Capacity <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="seating" name="seating"  maxlength="220"  placeholder="Seating Capacity" min="1" max="50" required>
		</div> </div>

		<div class="form-group row">
		<label for="bodyType" class="col-sm-3 col-form-label">Body Type <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="bodyType" name="bodyType"  maxlength="220"  placeholder="Body Type"  required>
		</div> </div>

		<div class="form-group row">
		<label for="conditionType" class="col-sm-3 col-form-label">Condition Type</label>
		<div class="col-sm-9">
			<select name="conditionType" class="select-field custom-select" id="conditionType"  required>
				<option value="Second-Hand">Second Hand</option>
				<option value="Brand-New">Brand New</option> 
				<option value="donot-Know">Donot Know</option> 
			</select>
		</div> </div>

		<div class="form-group row">
		<label for="condition" class="col-sm-3 col-form-label">condition out of 10 <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="condition" name="condition"  maxlength="220" min="1" max="10"  placeholder="max 10"  required>
		</div> </div>

		<div class="form-group row">
		<label for="registered" class="col-sm-3 col-form-label">Registered ?</label>
		<div class="col-sm-9">
			<select name="registered" class="select-field custom-select" id="registered"  required>
				<option value="registered">Yes Registered</option>
				<option value="Not-registered">Not Registered Yet</option>  
			</select>
		</div> </div>
		
		<div class="form-group row">
		<label for="registrationCity" class="col-sm-3 col-form-label">Registration City <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="registrationCity" name="registrationCity"  maxlength="220"  placeholder="City Name or Vehicle Number"  required>
		</div> </div>

		<div class="form-group row">
		<label for="mileage" class="col-sm-3 col-form-label">Driven Km <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="mileage" name="mileage"  maxlength="220" min="1" max="100000000"  placeholder="Already Driven in Kilometers"  required>
		</div> </div>

		<div class="form-group row">
		<label for="file" class="col-sm-3 col-form-label">Vehicle Images<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="file" multiple name="file1" id="file1" accept="image/png, image/jpeg" onchange="return fileValidation()" style="width:100%">
		</div> </div> 

		<div class="form-group row">
		<label for="remarks" class="col-sm-3 col-form-label">Your Remarks about it </label>
		<div class="col-sm-9">
		<textarea class="form-control" id="remarks" name="remarks"  maxlength="220"  placeholder="Your Remarks about file"></textarea>
		</div>  </div>

		<input type="hidden"  class="hidden" name="fileUpload" value="fileUpload"> 
		<div>
		<input type="button" value="Upload" onclick="Upload(this)"  class="btn btn-primary btn-lg btn-block" />
		</div>
		<br>
		<div id="upload_responseDiv" style="display:none">
		<span>Uploading Progress :  </span>
		<progress id="progressBar" value="0" max="100" style="width:60%;"></progress>
		<h3 id="status">status</h3>
		<p id="loaded_n_total"> loaded </p>
		</div>
		<div id="output"></div>

		</form>
		</div> </div></div></div>';


		$this->myprofile = '	<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">My Profile</div>
		</div>
		<div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">

		<form method="post" name="form_myprofile" id="form_myprofile">
		<div class="form-group row">
		<label for="username" class="col-sm-3 col-form-label">Username</label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="username" readonly value="'.$this->userProfile["username"].'">
		</div></div>

		<div class="form-group row">
		<label for="firstName" class="col-sm-3 col-form-label">First Name</label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="firstName" name="firstName" value="'.$this->userProfile["firstName"].'" maxlength="20" required>
		</div></div>

		<div class="form-group row">
		<label for="lastName" class="col-sm-3 col-form-label">Last Name</label>
		<div class="col-sm-9">
		<input type="phone" class="form-control" id="lastName" name="lastName" value="'.$this->userProfile["lastName"].'" maxlength="20" required>
		</div></div>

		<div class="form-group row">
		<label for="mobile" class="col-sm-3 col-form-label">Mobile Number</label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="mobile" name="mobile" value="'.$this->userProfile["mobile"].'" maxlength="20" required>
		</div></div>

		<div class="form-group row">
		<label for="email" class="col-sm-3 col-form-label">Email</label>
		<div class="col-sm-9">
		<input type="email" class="form-control" id="email"  value="'.$this->userProfile["email"].'" readonly>
		</div></div>
		 

		<div class="form-group row">
		<label for="date_Join" class="col-sm-3 col-form-label"> Date of Joining </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="date_Join"  value="'.$this->userProfile["date_of_join"].'" readonly>
		</div></div>

		<div class="form-group row">
		<label for="date_login" class="col-sm-3 col-form-label"> Date of Last Login </label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="date_login"  value="'.$this->userProfile["last_login"].'" readonly>
		</div></div>


		<input type="hidden"id="userID" name="userID"  value="'.$this->userProfile["id"].'" readonly>

		<input type="hidden"  class="hidden" name="myprofile" value="myprofile">

		<input type="button" onclick="MyProfile(this)" class="btn btn-primary btn-lg btn-block" value="Update">
		</form><br>
		<div id="output"></div>
		</div>
		<hr>
 
		<div class="agileits-top">

		<form method="post" name="form_myprofilePassChange" id="form_myprofilePassChange">
		 
		<div class="form-group row">
		<label for="oldPass" class="col-sm-3 col-form-label">Old Password</label>
		<div class="col-sm-9">
		<input type="password" class="form-control" id="oldPass" name="oldPass"  maxlength="30" required>
		</div></div>

		<div class="form-group row">
		<label for="newPass" class="col-sm-3 col-form-label">New Password</label>
		<div class="col-sm-9">
		<input type="password" class="form-control" id="newPass" name="newPass"  maxlength="30" required>
		</div></div>
 
		<div class="form-group row">
		<label for="newPassRepeat" class="col-sm-3 col-form-label">Repeat New Password</label>
		<div class="col-sm-9">
		<input type="password" class="form-control" id="newPassRepeat" name="newPassRepeat"  maxlength="30" required>
		</div></div> 

		<input type="hidden" id="usrID" name="usrID"  value="'.$this->userProfile["id"].'" readonly>

		<input type="hidden"  class="hidden" name="passwordChange" value="passwordChange">

		<input type="button" onclick="MyProfileChangePassword(this)" class="btn btn-primary btn-lg btn-block" value="Change PassWord">
		</form><br>
		<div id="output2"></div>
		</div> 

		</div></div></div>';
		

		$this->myallpost = '<div id="content_wrapper">
		<div class="featured_image">
		<div class="head_box">Managing my All Posts</div>
		</div><div >
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">

		<form method="post" name="form_signup" id="form_signup">
		<div class="form-group">
		<label for="username">Song Name</label>
		<input type="text" class="form-control" id="username" placeholder="username" required="">
		</div>

		<input type="hidden"  class="hidden" name="signup" value="signup">

		<input type="button" id="sub" class="btn btn-primary btn-lg btn-block" value="SIGNUP">
		</form><br>
		<div id="output"></div>
		</div></div></div></div> ';

	} // end of contructor


	public function GiveMe_Upload()
	{
		echo $this->uploadSection;
	} 
 
	public function GiveMe_managePost()
	{
		echo $this->managePost;
	}
 
	public function GiveMe_myallpost ()
	{ 
		$rows = $this->db_Obj->Get_myAllPosts($_SESSION['userid']);
		echo  '<div id="content_wrapper"> 
							<div class="featured_image"> <div class="head_box"> My All Ads </div> </div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 5px; padding-right: 10px; padding-bottom: 5px; padding-left: 20px; ">
		 <div class="agileits-top">';

		if(!empty($rows))
		{ 
			echo ' <div id="audioDetails">
			<div class="container custmhome">
			<div class="row">
			<div class="col-md-12"> 
			<div class="row">';
			foreach ($rows as $row)
			{   
					if($row['soldDelete'] == 0)
					{
						echo ' <div class="col-md-3"> <div class="adBtn" > <a href="'. $this->baseurl.'?val=ADedit&ID='.$row['id'].'">  
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
	}

	public function GiveMe_myprofile ()
	{
		echo $this->myprofile;
	}
 
	public function GiveMe_ADedit ($advertiseID)
	{
		$rowss = $this->db_Obj->Get_ADdetail_this($advertiseID);
		$rows = $rowss->fetch_array();

		echo '<div id="content_wrapper">

		<div class="featured_image">
		<div class="head_box"> Edit your Ad </div>
		</div>
		<div>
		<div class="main-agileinfo" style="background-color:#9aa48e; width:100%; height:100%;  padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 50px; ">
		<div class="agileits-top">
		
		
		<div class="adImageDetail" > <img style="max-width:auto; max-height:250px; margin:0 auto; " src="advertisementBank/'. $rows['pics'].'" title="'.$rows['title'].'" > </div>
					
		<form method="post" name="form_update" id="form_update">
		
		<input type="hidden"  class="hidden" name="id" value="'.$rows['id'].'"> 

		<div class="form-group row">
		<label for="title" class="col-sm-3 col-form-label"> Ad Title <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="title"  name="title" maxlength="220" value="'.$rows['title'].'"  required>
		</div></div>

		<div class="form-group row">
		<label for="price" class="col-sm-3 col-form-label"> Fix Price (Pak Ruppees)<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="price" name="price"  maxlength="220" min="1" max="100000000"  value="'.$rows['price'].'"  required>
		</div> </div>

		<div class="form-group row">
		<label for="contactNo" class="col-sm-3 col-form-label"> Contact Number <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="tel" class="form-control" id="contactNo" name="contactNo" value="'.$rows['contactNo'].'"   maxlength="220" min="1" max="100000000"   placeholder="123-456-1234567"  required>
		</div> </div>

		<div class="form-group row">
		<label for="type" class="col-sm-3 col-form-label">Vehicle Type</label>
		<div class="col-sm-9">
			<select name="type" class="select-field custom-select" id="type"  required>';
				if( $rows['type'] == 'Bike')
				{ 
					echo '<option selected value="Bike">Bike</option>';
				}
				else{
					echo '<option value="Bike">Bike</option>';
				}
				if( $rows['type'] == 'Car')
				{
					echo '<option selected value="Car">Car</option> ';
				}
				else{
					echo '<option value="Car">Car</option> ';
				}
				if( $rows['type'] == 'Jeep')
				{
					echo '<option selected value="Jeep">Jeep</option> ';
				}
				else{
					echo '<option value="Jeep">Jeep</option> ';
				}

			echo '</select>
		</div> </div>

		<div class="form-group row">
		<label for="Brand" class="col-sm-3 col-form-label">Brand Name</label>
		<div class="col-sm-9">
		<select name="Brand" class="select-field custom-select" id="Brand"  required>';
		if(!empty($this->brandss))
		{
			foreach ($this->brandss as $key) {
				echo '<option value="'.$key['brandName'].'">'.$key['brandName'].'</option>';
			}
		}else{
			echo '<option value="Toyota">Toyota</option> <option value="Suzuki">Suzuki</option> ';
		}
		echo '</select>	</div> </div>

		<div class="form-group row">
		<label for="model" class="col-sm-3 col-form-label">Model Name<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="model" name="model"  maxlength="220" value="'.$rows['modelName'].'" required>
		</div> </div>


		<div class="form-group row">
		<label for="makeYear" class="col-sm-3 col-form-label">Make Year<span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="month" class="form-control" id="makeYear" name="makeYear"  maxlength="220"   value="'.$rows['makeYear'].'"  required>
		</div> </div>

		<div class="form-group row">
		<label for="engine" class="col-sm-3 col-form-label">Engine Capacity</label>
		<div class="col-sm-9">
		<select name="engine" class="select-field custom-select" id="engine"  required>';
		if(!empty($this->enginee))
		{
			foreach ($this->enginee as $key) {
				echo '<option value="'.$key['capacity'].'">'.$key['capacity'].'</option>';
			}
		}else{
			echo '<option value="660">660</option>
			<option value="1000">1000</option> ';
		}
		echo '</select>
		</div> </div>


		<div class="form-group row">
		<label for="seating" class="col-sm-3 col-form-label">Seating Capacity <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="seating" name="seating"  maxlength="220"  value="'.$rows['seatingCapacity'].'" min="1" max="50" required>
		</div> </div>

		<div class="form-group row">
		<label for="bodyType" class="col-sm-3 col-form-label">Body Type <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="bodyType" name="bodyType"  maxlength="220"  value="'.$rows['bodyType'].'"  required>
		</div> </div>

		<div class="form-group row">
		<label for="conditionType" class="col-sm-3 col-form-label">Condition Type</label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="conditionType" name="conditionType" value="'.$rows['conditionType'].'" maxlength="220" required>
		</div> </div>

		<div class="form-group row">
		<label for="condition" class="col-sm-3 col-form-label">condition out of 10 <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="condition" name="condition" min="1" max="10"   value="'.$rows['condition_is'].'"  required>
		</div> </div>

		<div class="form-group row">
		<label for="registered" class="col-sm-3 col-form-label">Registered ?</label>
		<div class="col-sm-9">
			<select name="registered" class="select-field custom-select" id="registered"  required>';
				
			if( $rows['registered'] == 'registered')
				{ 
					echo '<option value="registered" selected>Yes Registered</option>';
				}
				else{
					echo '<option value="registered">Yes Registered</option>';
				}
				if( $rows['registered'] =='Not-registered')
				{
					echo '<option value="Not-registered" selected>Not Registered Yet</option>';
				}
				else{
					echo '<option value="Not-registered">Not Registered Yet</option>';
				}
				echo ' </select>
		</div> </div>
		
		<div class="form-group row">
		<label for="registrationCity" class="col-sm-3 col-form-label">Registration City <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="text" class="form-control" id="registrationCity" name="registrationCity"  maxlength="220"  value="'.$rows['registrationCity'].'"  required>
		</div> </div>

		<div class="form-group row">
		<label for="mileage" class="col-sm-3 col-form-label">Driven Km <span style="color:red"> *</span></label>
		<div class="col-sm-9">
		<input type="number" class="form-control" id="mileage" name="mileage"  maxlength="220" min="1" max="100000000"  value="'.$rows['mileageDriven'].'"  required>
		</div> </div>

		<div class="form-group row">
		<label for="file" class="col-sm-3 col-form-label">Vehicle Images </label>
		<div class="col-sm-9">
		<input type="file" multiple name="file1" id="file1" accept="image/png, image/jpeg" onchange="return fileValidation()" style="width:100%">
		</div> </div>

		<div class="form-group row">
		<label for="remarks" class="col-sm-3 col-form-label">Your Remarks about it </label>
		<div class="col-sm-9">
		<textarea class="form-control" id="remarks" name="remarks"  maxlength="220"  > '.$rows['ownerRemarks'].'</textarea>
		</div>  </div>

		<input type="hidden"  class="hidden" name="adUpdate" value="adUpdate"> 
		<div>
		<input type="button" value="Update Ad" onclick="form_updateAd(this)"  class="btn btn-primary btn-lg btn-block" />
		</div>
		<br>
		<div id="upload_responseDiv" style="display:none">
		<span>Uploading Progress :  </span>
		<progress id="progressBar" value="0" max="100" style="width:60%;"></progress>
		<h3 id="status">status</h3>
		<p id="loaded_n_total"> loaded </p>
		</div>
		<div id="output"></div>

		</form>
		</div>
		
		<hr><hr>
		
		<div>				
		<form method="post" name="form_SOLD" id="form_SOLD">
		<input type="hidden"  class="hidden" name="SOLD" value="SOLD">  
		<input type="hidden"  class="hidden" name="SOLD_id" value="'.$rows['id'].'"> 
		<div>
			<input type="button" value="Make this ad as sold ad." onclick="I_SOLD_THIS(this)"  class="btn btn-primary btn-lg btn-block" />
		</div>
		</form>
		</div>

		<hr><hr>
		
		<div>				
		<form method="post" name="form_deleteThisAD" id="form_deleteThisAD">
		<input type="hidden"  class="hidden" name="deleteThisAD" value="deleteThisAD">  
		<input type="hidden"  class="hidden" name="delete_id" value="'.$rows['id'].'"> 
		<div>
			<input type="button" value="Delete This Ad." onclick="I_DELETE_THIS(this)"  class="btn btn-primary btn-lg btn-block" />
		</div>
		</form>
		</div>
		


		
		
		
		
		</div></div></div>';

	}


} // end of class
