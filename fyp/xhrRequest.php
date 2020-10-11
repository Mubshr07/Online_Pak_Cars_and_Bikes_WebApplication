<?php
include 'DB_Class.php';
include 'ADProperties.php';
include 'Users_Posts_Class.php';

session_start();
/**
 * 
 */
class XhrRequest // extends AnotherClass
{

    public $login_username = "";
    public $login_password = "";
    public $json_Msg = [];
    public $current_user;


    public $registerObj;

 
    public $I_SOLD_IT;
    public $I_DELETE_IT;
   
    public $get_userPostsObj;
    public $add_audioObj;
    public $add_NewCategoryObj;
    public $delete_CategoryObj;
 

    public $db_obj;

    function __construct()
    {
        $this->db_obj = new DB_Class();

        $this->login_username = "";
        $this->login_password = "";
        $this->current_user = "";

        $this->registerObj = new RegistrationNew();
 
        $this->I_SOLD_IT = new I_SOLD_IT();
        $this->I_DELETE_IT = new I_DELETE_IT();
   
        $this->get_userPostsObj = new Get_UserPosts();
  
 
    }

    public function Run()
    {

        //var_dump($_POST);
        if (!empty($_POST)) {

            if (isset($_POST['login'])) {
                $this->login_username =  $_POST['login_username'];
                $this->login_password =  $_POST['login_password'];
                $this->login_username  = $this->db_obj->Secure_This_String($this->login_username);
                $this->login_password = $this->db_obj->Secure_This_String($this->login_password);
                $this->current_user = $this->db_obj->Login_Credential($this->login_username, $this->login_password);


                if (!empty($this->current_user)) {
                    $this->json_Msg["login"] = TRUE;
                    $this->json_Msg["username"] = "mubssi"; //$this->current_user['username'];
                    $this->json_Msg["fullname"] = $this->current_user['firstName'] . ' ' . $this->current_user['lastName'];
                    //$this->json_Msg["usertype"] = $this->current_user['type'];
                    $this->json_Msg["log"] =  TRUE;
                    $this->json_Msg["login_success"] = TRUE;

                    $_SESSION["userid"] = $this->current_user['id'];
                    $_SESSION["username"] = $this->current_user['username'];
                    $_SESSION["fullname"] = $this->current_user['firstName'] . ' ' . $this->current_user['lastName'];
                    //$_SESSION["password"] = $this->current_user['password'];
                    $_SESSION["usertype"] = $this->current_user['type'];
                    $_SESSION["approved"] = $this->current_user['user_Approval'];
                    $_SESSION["log"] =  TRUE;

                    $_SESSION["last_login"] =  date('m/d/Y H:i:s', time());
                } else {
                    $this->json_Msg["error"] = "Please Check your Username/Email or Password";
                    $this->json_Msg["login_success"] = FALSE;
                }

                echo json_encode($this->json_Msg);
            } // end of login form

            else if (isset($_POST['signup'])) {
                $this->json_Msg = $this->registerObj->Register($_POST);
                echo json_encode($this->json_Msg);
            } // $_POST['signup']

            else if (isset($_POST['myprofile'])) {

                //$db_obj = new DB_Class();
                $this->json_Msg["myprofile"] = true;

                if (isset($_POST['userID'])) {
                    $userID = $this->db_obj->Secure_This_String($_POST['userID']);
                }
                if (isset($_POST['firstName'])) {
                    $firstName = $this->db_obj->Secure_This_String($_POST['firstName']);
                }

                if (isset($_POST['lastName'])) {
                    $lastName = $this->db_obj->Secure_This_String($_POST['lastName']);
                }

                if (isset($_POST['mobile'])) {
                    $mobile = $this->db_obj->Secure_This_String($_POST['mobile']);
                }

                if (!empty($userID) &&  !empty($firstName) &&  !empty($lastName)) {
                    $updateResult = $this->db_obj->Update_UserProfile($userID, $firstName, $lastName, $mobile);
                    if ($updateResult) {
                        $this->json_Msg["myprofile_success"] = true;
                        $this->json_Msg["successMsg"] =  " Profile Updated ";
                    } else {
                        $this->json_Msg["myprofile_success"] = FALSE;
                        $this->json_Msg["successMsg"] =  "Please Contact to the admin, you are not updated your profile . ";
                    }
                } else {
                    $this->json_Msg["myprofile_success"] = FALSE;
                    $this->json_Msg["successMsg"] =  " Some Fields are empty . ";
                }

                echo json_encode($this->json_Msg);
            } // end of myprofile form request 

            else if (isset($_POST['passwordChange'])) {
                
                $this->json_Msg["passwordChange"] = TRUE;

                if (isset($_POST['usrID'])) {
                    $userID = $this->db_obj->Secure_This_String($_POST['usrID']);
                }
                if (isset($_POST['oldPass'])) {
                    $oldPass = $this->db_obj->Secure_This_String($_POST['oldPass']);
                }

                if (isset($_POST['newPass'])) {
                    $newPass = $this->db_obj->Secure_This_String($_POST['newPass']);
                }

                if (isset($_POST['newPassRepeat'])) {
                    $newPassRepeat = $this->db_obj->Secure_This_String($_POST['newPassRepeat']);
                }

                if (!empty($userID) &&  !empty($oldPass) &&  !empty($newPass) && ( $newPass == $newPassRepeat)) {
                    $updateResult = $this->db_obj->Update_Password($userID, $oldPass, $newPass, $newPassRepeat);
                    if ($updateResult) {
                        $this->json_Msg["myprofile_success"] = true;
                        $this->json_Msg["successMsg"] =  " Password Updated ";
                    } else {
                        $this->json_Msg["myprofile_success"] = FALSE;
                        $this->json_Msg["successMsg"] =  " Your Password Did not changed. ";
                    }
                } else {
                    $this->json_Msg["myprofile_success"] = FALSE;
                    $this->json_Msg["successMsg"] =  " Some Fields are empty or New Password and repeat password not matched. ";
                }

                echo json_encode($this->json_Msg);
            } // end of myprofile form request 

            else if (isset($_POST['fileUpload'])) {
                $output_dir = __DIR__ . "\\advertisementBank\\"; 

                if (isset($_FILES["file1"]) && isset($_POST["title"]) && isset($_POST['price']) && isset($_POST['contactNo']) && isset($_POST['type']) && isset($_POST['Brand']) && isset($_POST['model']) && isset($_POST['makeYear']) && isset($_POST['engine'])  && isset($_POST['seating']) && isset($_POST['bodyType']) && isset($_POST['conditionType']) && isset($_POST['condition']) && isset($_POST['registered']) && isset($_POST['registrationCity']) && isset($_POST['mileage'])  && isset($_POST['remarks'])) {
                    if ($_FILES["file1"]["error"] > 0) {
                        $this->json_Msg["successMsg"] = "Error: " . $_FILES["file1"]["error"] . " GOt it...... <br>";
                    } else {
                        $file_tempN = $_FILES["file1"]["tmp_name"];
                        $file_realN = $_FILES["file1"]["name"];
                        $file_realN = $this->db_obj->Secure_This_String($file_realN);
                        $file_time = time() . "_" .  $file_realN;

                        $destinationPath = $output_dir . $file_time;

                        //$allowed =  array('png', 'jpg', 'jpeg');
                        $allowed = array('jpeg','jpg','png','gif','PNG','JPEG','JPG');
                        $ext = pathinfo($file_realN, PATHINFO_EXTENSION);
                        if (in_array($ext, $allowed) && isset($_SESSION["userid"]) && isset($_SESSION["username"])) {
                            $movedd = @move_uploaded_file($file_tempN, $destinationPath);
                            if ($movedd) {
                                $destinationPath =   $file_time;
                                $this->json_Msg["destinationPath"] = $destinationPath;
                                $insertBool = $this->db_obj->Insert_NewAdvertisement($_SESSION["userid"], $_POST["title"], $_POST['price'], $_POST['contactNo'], $_POST['type'], $_POST['Brand'], $_POST['model'], $_POST['makeYear'], $_POST['engine'], $_POST['seating'], $_POST['bodyType'], $_POST['conditionType'], $_POST['condition'], $_POST['registered'], $_POST['registrationCity'], $_POST['mileage'], $_POST['remarks'], $destinationPath);
                                $this->json_Msg["form"] = $_POST;
                                $this->json_Msg["upload_success"] = $insertBool;
                                $this->json_Msg["successMsg"] = " File Uploaded Successfully ";
                            } else {
                                $this->json_Msg["upload_success"] = false; 
                                $this->json_Msg["successMsg"] = " File not moved. May be file is corrupted. Select another file.";
                            }
                        } else {
                            $this->json_Msg["successMsg"] = " file extension is : " . $ext . " which is not allowed ";
                        }
                    } // end of else statement
                } // end of isset()
                else {
                    $this->json_Msg["successMsg"] =  " Some Fields are empty 4. ";
                    $this->json_Msg["data"] = $_POST;
                }
                //$this->json_Msg["successMsg"] =  " Some Fields are empty . ";
                echo json_encode($this->json_Msg);
            } // end of isset( fileUpload )


            else if (isset($_POST['adUpdate'])) {

                $output_dir = __DIR__ . "\\advertisementBank\\";
                if (isset($_FILES["file1"]) && isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST['price']) && isset($_POST['contactNo']) && isset($_POST['type']) && isset($_POST['Brand']) && isset($_POST['model']) && isset($_POST['makeYear']) && isset($_POST['engine'])  && isset($_POST['seating']) && isset($_POST['bodyType']) && isset($_POST['conditionType']) && isset($_POST['condition']) && isset($_POST['registered']) && isset($_POST['registrationCity']) && isset($_POST['mileage'])  && isset($_POST['remarks'])) 
                { 

                        $fielReceived = TRUE;
                        if ($_FILES["file1"]["error"] > 0) {
                            $this->json_Msg["successMsg"] = "Error: " . $_FILES["file1"]["error"] . "File Not received. Please select a file";
                            $fielReceived = FALSE;
                        }
                        $movedd = FALSE;

                        $destinationPath = "";
                        $file_time = "";

                        if ($fielReceived) {
                            $file_tempN = $_FILES["file1"]["tmp_name"];
                            $file_realN = $_FILES["file1"]["name"];
                            $file_realN = $this->db_obj->Secure_This_String($file_realN);
                            $file_time = time() . "_" .  $file_realN;
                            $destinationPath = $output_dir . $file_time;
                            $allowed =  array('png', 'jpg', 'jpeg');
                            $ext = pathinfo($file_realN, PATHINFO_EXTENSION);
                            if (in_array($ext, $allowed) && isset($_SESSION["userid"]) && isset($_SESSION["username"])) {
                                $movedd = @move_uploaded_file($file_tempN, $destinationPath);
                            } else {
                                $this->json_Msg["successMsg"] = " file extension is : " . $ext . " which is not allowed ";
                            }
                        }

                        $destinationPath =   $file_time;
                        //$this->json_Msg["destinationPath"] = $destinationPath;
                        $insertBool = $this->db_obj->updateAdvertisement($_POST["id"], $_POST["title"], $_POST['price'], $_POST['contactNo'], $_POST['type'], $_POST['Brand'], $_POST['model'], $_POST['makeYear'], $_POST['engine'], $_POST['seating'], $_POST['bodyType'], $_POST['conditionType'], $_POST['condition'], $_POST['registered'], $_POST['registrationCity'], $_POST['mileage'], $_POST['remarks'], $destinationPath,  $movedd);

                        if ($insertBool) {
                            $this->json_Msg["update_success"] = $insertBool;
                            $this->json_Msg["successMsg"] = "File Uploaded Successfully ";
                            $this->json_Msg["adID"] = "val=ADedit&ID=".  $_POST["id"];
                        } else {
                            $this->json_Msg["form"] = $_POST;
                            $this->json_Msg["update_success"] = $insertBool;
                            $this->json_Msg["successMsg"] = "Failed to Update fields in database. ";
                        }
                } // end of isset()
                else {
                    $this->json_Msg["update_success"] = false;
                    $this->json_Msg["successMsg"] =  "Some Fields are empty 4. ";
                    $this->json_Msg["data"] = $_POST;
                }
                //$this->json_Msg["successMsg"] =  " Some Fields are empty . ";
                echo json_encode($this->json_Msg);
            } // end of isset( fileUpload )

            else if (isset($_POST['oneUserPosts'])) {
                $this->json_Msg = $this->get_userPostsObj->userPosts($_POST['userid']);
                echo json_encode($this->json_Msg);
            } // end of oneUserPosts form request

            else if (isset($_POST['SOLD'])) {
                $this->json_Msg = $this->I_SOLD_IT->Sold($_POST['SOLD_id']);
                echo json_encode($this->json_Msg);
            } // end of like form request

            else if (isset($_POST['deleteThisAD'])) {
                $this->json_Msg = $this->I_DELETE_IT->Delete_This($_POST['delete_id']);
                echo json_encode($this->json_Msg);
            } // end of dislike form request

            else {
                $this->json_Msg["Msg"] =  " XhrRequest PHP :  POST has something else. ";
                $this->json_Msg["Form"] = $_POST;
                echo json_encode($this->json_Msg);
            }
        } // end of if $_POST is not empty
        else {
            echo json_encode("Error received from xhr_Request php file");
        }
    } // end of function run
} // end of class

$xhr = new XhrRequest();
$xhr->Run();
