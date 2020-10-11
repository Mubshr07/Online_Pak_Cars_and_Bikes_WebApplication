<?php

class DB_Class{
	
	public $host = "localhost";
	public $user = "root";
	public $pass = "";
  public $db = "audiocloud";
  public $db_opcb = "opcb_database";

	public $userTable = "user";

  protected $conn ; // = new mysqli("localhost", "root", "", "audiocloud");
  protected $conn_opcb ; 


	public function __construct( ){  
    $this->conn_opcb = new mysqli($this->host, $this->user, $this->pass, $this->db_opcb);
		if ($this->conn_opcb->connect_error) {
      echo '<h1> Connection with Data is not configured. </h1>  <p> Possible reasons is you did not have a database named opcb_database. (make a database exactly same name and import data from availabe database file. </p>';
      die("Connection failed: " . $this->conn_opcb->connect_error);
    } 
	} // end of __construct

  public function Login_Credential($uuser, $ppass)
  {
    $sql = "SELECT * FROM $this->userTable WHERE username='$uuser'";
    
    // Set the default error reporting level
    error_reporting(0);
    $result = mysqli_query($this->conn_opcb, $sql);

    if(!empty($result))
    {
      $rr = mysqli_fetch_array($result); 
      $hash = $rr['password'];
      if( password_verify( $ppass , $hash ) ) {
        $newDate = date('Y-m-d H:i:s', time());
        $sql = "UPDATE user SET last_login = '$newDate' WHERE id = ".$rr['id']; 
        $update_result = mysqli_query($this->conn_opcb, $sql); 
        
        error_reporting(1);
        return $rr;
      }
      else
      {
          return NULL; // array('error' => "else statement");
      }
    }
    else
    {
                  return NULL;
    }
	} // end of Login_Credentials

  public function Register_New_User($username, $email, $firstName, $lastName, $password )
  {
    $verifyHash = md5( rand(0,1000) );
    $hash_pass = password_hash($password,PASSWORD_BCRYPT);
    $sqlt = "INSERT INTO user (username, firstName, lastName, email, password, hash ) VALUES ('$username', '$firstName', '$lastName', '$email', '$hash_pass','$verifyHash' )";
    $err = error_reporting(0);

    /* here goes you buggy code */
    
    $flag =  mysqli_query($this->conn_opcb, $sqlt);

    if($flag){
      $baseurl = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/";
      $subject = 'Signup | Verification'; // Give the email a subject 
      $message = '
                  Thanks for signing up!
                  Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
                   
                  ------------------------
                  Username: '.$username.'
                  ------------------------
                   
                  Please click this link to activate your account:
                  '.$baseurl.'?emailVerify='.$verifyHash.'
                   <br><br><br><br><br>
                  '; // Our message above including the link
                           
      $headers = 'From:noreply@audiocloud.com' . "\r\n"; // Set from headers
      mail($email, $subject, $message, $headers); // Send our email

    // Set the default error reporting level
    error_reporting($err);
      return $flag;
    }else{
      return $flag;
    }
	} // end of Login_Credentials

	public function Get_UserProfile($userid)
	{
    $sql = "SELECT * FROM $this->userTable WHERE id='$userid'";
    $result=mysqli_query($this->conn_opcb, $sql);

    if(!empty($result))
    {
      return mysqli_fetch_array($result);
    }
    else
    {
      return null;
    }
	} // end of GiveMe_UserProfile

  public function Update_UserProfile($userID, $firstName, $lastName, $mobile)
  {
    $sql = "UPDATE user SET firstName = '$firstName' , lastName = '$lastName' , mobile = '$mobile' WHERE id = ".$userID; 
    return mysqli_query($this->conn_opcb, $sql); 
  } // end of Execute_this
  
  public function Update_Password($userID, $oldPass, $newPass, $newPassRepeat)
  {  
    $sql = "SELECT * FROM $this->userTable WHERE id='$userID'";
    
    // Set the default error reporting level
    error_reporting(0);
    $result = mysqli_query($this->conn_opcb, $sql);

    if(!empty($result))
    {
      $rr = mysqli_fetch_array($result); 
      $hash = $rr['password'];
      if( password_verify( $oldPass , $hash ) ) {
        $newDate = date('Y-m-d H:i:s', time());
        $hash_pass = password_hash($newPass,PASSWORD_BCRYPT);
        $sql = "UPDATE user SET password = '$hash_pass', last_login = '$newDate' WHERE id = ".$rr['id']; 
        $update_result = mysqli_query($this->conn_opcb, $sql); 
        
        error_reporting(1);
        return $update_result;
      }
      else
      {
          return NULL; // array('error' => "else statement");
      }
    }
    else
    {
                  return NULL;
    }


	} // end of Update_Password

  public function Get_Brandss()
  {
    $sql = "SELECT * FROM brands "; // ORDER BY id DESC";
    $result=mysqli_query($this->conn_opcb, $sql);

    if(!empty($result)){
      return ($result);
    }else{
      return null;
    }
  } // end of Get_Brandss
  public function Get_EngineCapacity()
  {
    $sql = "SELECT * FROM enginecapacity  ORDER BY id DESC";
    $result=mysqli_query($this->conn_opcb, $sql);

    if(!empty($result)){
      return ($result);
    }else{
      return null;
    }
  } // end of Get_EngineCapacity
  public function Execute_this($query)
  {
    $result = null;
    if(!empty($query))
    {
      $result=mysqli_query($this->conn_opcb, $query); 
      return mysqli_fetch_array($result); 
    }
    else
    {
      return null;
    }
  } // end of Execute_this
  
  public function Get_ADdetail_this($id)
  {
    $sql = "SELECT * FROM advertisement WHERE id='$id' ";
    $result = null;
    $result = mysqli_query($this->conn_opcb, $sql);

    if(!empty($result)){
      return $result;
    }else{
      return null;
    }
  } // end of Get_ADdetail_this
 
  public function Secure_This_String($str)
  {
    $string = preg_replace("/\%/", "\%", $str);
    $string = preg_replace("/\_/", "\_", $string);

    return mysqli_real_escape_string($this->conn_opcb,trim($string));
  } // end of Secure_This_String

  public function Insert_NewAdvertisement($userID, $title, $price , $contactNo , $type , $Brand , $model , $makeYear , $engine , $seating , $bodyType , $conditionType , $condition , $registered , $registrationCity, $mileage , $remarks , $destinationPath )
  {
    $title = $this->Secure_This_String($title );
    $model = $this->Secure_This_String( $model);
    $bodyType = $this->Secure_This_String($bodyType ); 
    $remarks = $this->Secure_This_String($remarks );
    $registrationCity = $this->Secure_This_String($registrationCity );
     
    $newDate = date('Y-m-d H:i:s', time()); 

    $sql = "INSERT INTO advertisement (userID, title, type, brandName, modelName, makeYear, engineCapacity, seatingCapacity, bodyType, conditionType, condition_is, registered, registrationCity, mileageDriven, price, pics, ownerRemarks, contactNo , updatingDate) "
    . "VALUES ('$userID', '$title', '$type', '$Brand', '$model', '$makeYear', '$engine', '$seating', '$bodyType' , '$conditionType' , '$condition' , '$registered' , '$registrationCity' , '$mileage' , '$price' , '$destinationPath', '$remarks', '$contactNo', '$newDate')";

    return mysqli_query($this->conn_opcb, $sql); 
  }
  
  public function updateAdvertisement($ID, $title, $price , $contactNo , $type , $Brand , $model , $makeYear , $engine , $seating , $bodyType , $conditionType , $condition , $registered , $registrationCity, $mileage , $remarks , $destinationPath ,  $movedd)
  {
    $title = $this->Secure_This_String($title );
    $model = $this->Secure_This_String( $model);
    $bodyType = $this->Secure_This_String($bodyType ); 
    $remarks = $this->Secure_This_String($remarks );
    $registrationCity = $this->Secure_This_String($registrationCity );
    
    $newDate = date('Y-m-d H:i:s', time()); 
     
    if($movedd)
    {
      $sql = "UPDATE advertisement SET  title='$title', type='$type', brandName='$Brand', modelName='$model', makeYear='$makeYear', engineCapacity='$engine', seatingCapacity='$seating', bodyType='$bodyType', 
      conditionType='$conditionType', condition_is='$condition', registered='$registered', registrationCity='$registrationCity', mileageDriven='$mileage', price='$price', pics='$destinationPath', ownerRemarks='$remarks', contactNo='$contactNo', updatingDate='$newDate' WHERE id = ".$ID ;
    }
    else
    {
      $sql = "UPDATE advertisement SET  title='$title', type='$type', brandName='$Brand', modelName='$model', makeYear='$makeYear', engineCapacity='$engine', seatingCapacity='$seating', bodyType='$bodyType', 
      conditionType='$conditionType', condition_is='$condition', registered='$registered', registrationCity='$registrationCity', mileageDriven='$mileage', price='$price' , ownerRemarks='$remarks', contactNo='$contactNo', updatingDate='$newDate' WHERE id='$ID' " ;
    }

      //$sql = "UPDATE advertisement SET  title='$title', type='$type', brandName='$Brand', modelName='$model', makeYear='$makeYear', engineCapacity='$engine', seatingCapacity='$seating', bodyType='$bodyType', conditionType='$conditionType', condition_is='$condition', registered='$registered', registrationCity='$registrationCity', mileageDriven='$mileage', price='$price' , ownerRemarks='$remarks', contactNo='$contactNo',  updatingDate = '$newDate' WHERE id='$ID' " ;


    return mysqli_query($this->conn_opcb, $sql); 
  }

  public function Get_NewUpdates()
  {
    $sql = "SELECT * FROM advertisement ORDER BY id DESC LIMIT 20 ";
    $result=mysqli_query($this->conn_opcb, $sql);

    if(!empty($result)){
      return ($result);
    }else{
      return null;
    }
  } // end of Get_NewUpdates

  public function Get_myAllPosts($id)
  {
    $sql = "SELECT * FROM advertisement WHERE userID='$id' ORDER BY id DESC ";
    $result = null;
    $result = mysqli_query($this->conn_opcb, $sql);

    if(!empty($result)){
      return $result;
    }else{
      return null;
    }
  } // end of Get_myAllPosts

  public function changeStatus_to_SOLD($id)
  { 
    $this->conn_opcb = new mysqli($this->host, $this->user, $this->pass, $this->db_opcb);
    $sql = "UPDATE advertisement SET  soldDelete = 1 WHERE id='$id'";
    $result = mysqli_query($this->conn_opcb, $sql);
    if(!empty($result)){
        return true; 
    }else{
      return null;
    }
  } // end of Increment_listenCount


  public function changeStatus_to_DELETE($id)
  { 
    $this->conn_opcb = new mysqli($this->host, $this->user, $this->pass, $this->db_opcb);
    $sql = "UPDATE advertisement SET  soldDelete = 2 WHERE id='$id'";
    $result = mysqli_query($this->conn_opcb, $sql);
    if(!empty($result)){
        return true; 
    }else{
      return null;
    }
  } // end of Increment_listenCount

  public function total_Users()
  {  
    $query = "SELECT *  FROM user ";       
    // Execute the query and store the result set 
    $result = mysqli_query($this->conn_opcb, $query);  
    if ($result) 
    { 
        // it return number of rows in the table. 
        $row = mysqli_num_rows($result); 
        mysqli_free_result($result); 
        return $row;
    } 
    return false; 
  }

  public function total_displayADs()
  {  
    $query = "SELECT * FROM advertisement WHERE soldDelete = 0 ";       
    // Execute the query and store the result set 
    $result = mysqli_query($this->conn_opcb, $query);  
    if ($result) 
    { 
        // it return number of rows in the table. 
        $row = mysqli_num_rows($result); 
        mysqli_free_result($result); 
        return $row;
    } 
    return false; 
  }
  public function total_ADs_SOLD()
  {  
    $query = "SELECT * FROM advertisement WHERE soldDelete = 1 ";       
    // Execute the query and store the result set 
    $result = mysqli_query($this->conn_opcb, $query);  
    if ($result) 
    { 
        // it return number of rows in the table. 
        $row = mysqli_num_rows($result); 
        mysqli_free_result($result); 
        return $row;
    } 
    return false; 
  }

  public function total_ADs_DELETE()
  {  
    $query = "SELECT * FROM advertisement WHERE soldDelete = 2 ";       
    // Execute the query and store the result set 
    $result = mysqli_query($this->conn_opcb, $query);  
    if ($result) 
    { 
        // it return number of rows in the table. 
        $row = mysqli_num_rows($result); 
        mysqli_free_result($result); 
        return $row;
    } 
    return false; 
  }
 
  public function Get_ADs_of_Brands($Brands)
  {  
    $query = "SELECT * FROM advertisement  WHERE brandName = '$Brands' ORDER BY id DESC ";     
    $result = mysqli_query($this->conn_opcb, $query);  

    if(!empty($result)){
      return $result;
    }else{
      return null;
    }
  } // end of Get_ADs_of_Brands

  
  public function Get_ADs_of_Types($types)
  {  
    $query = "SELECT * FROM advertisement  WHERE type = '$types' ORDER BY id DESC ";     
    $result = mysqli_query($this->conn_opcb, $query);  

    if(!empty($result)){
      return $result;
    }else{
      return null;
    }
  } // end of Get_ADs_of_Types

  public function Get_ADs_for_SearchBar($value)
  {   
    $query=" SELECT * FROM advertisement WHERE title like '%".$value."%'  OR type like '%".$value."%' OR brandName like '%".$value."%' OR modelName like '%".$value."%' OR engineCapacity like '%".$value."%' OR ownerRemarks like '%".$value."%' ORDER BY id DESC";
    $result = mysqli_query($this->conn_opcb, $query);  

    if(!empty($result)){
      return $result;
    }else{
      return null;
    }
  } // end of Get_ADs_for_SearchBar

  public function Get_insert_in_SearchTable ($value)
  {    
    $query = "INSERT INTO searchtable (searchText) VALUES ('$value')";

    $result = mysqli_query($this->conn_opcb, $query);  

  } // end of Get_insert_in_SearchTable




 

   


} // end of class

?>