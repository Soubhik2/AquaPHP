<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth{
    private $database;
    private $table;
    private $email;
    private $password;

    public function __construct($database, $table='users', $email='email', $password='password') {
        $this->database = $database;
        $this->table = $table;
        $this->email = $email;
        $this->password = $password;
    }

    public function isLoggedin(){
        if (isset($_SESSION['loggedin']) and $_SESSION['loggedin']==true) {
            return true;
        }else{
            return false;
        }
    }

    public function getUser(){
        return $_SESSION['user_log'];
    }

    public function signUp($email, $password, $arr=null, $emailVerify=true, $passwordVerify=true){
        if ((strpos($email, "@") and strpos($email, ".com")) or !$emailVerify) {
            if ((strlen($password) >= 6) or !$passwordVerify) {

                $spec = array('!','@','#','$','%','^','&','*');

                foreach ($spec as $key => $value) {
                    if (strpos($password, $value)) {
                        $pass_v = true;
                        break;
                    }else{
                        $pass_v = false;
                    }
                }

                if ($pass_v or !$passwordVerify) {
                    try {
                        // $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `user` = '$email'");
                        // $numExistRow = mysqli_num_rows($result);

                        // $numExistRow = $this->database->where('email',$email)->get($this->table)->count();
                        $numExistRow = $this->database->select($this->table,['email'=>$email])->count();
                        // $numExistRow = 0;
                        // echo '<pre>';
                        // echo $this->database->where($this->email,$email)->get($this->table)->get_query();
                        // echo '</pre>';
                
                        if ($numExistRow > 0) {
                        //   echo "Username Already Exists";
                            return (object) array("error"=>1, "error_mess"=>"Username Already Exists", "error_code"=>"ERROR: numExistRow ". $numExistRow. " it is grater then 0");
                        }else{
                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            $arr[$this->email] = $email;
                            $arr[$this->password] = $hash;
                            // echo '<pre>';
                            // print_r($arr);
                            // echo '</pre>';
                            // return "in";
                            // $sql = "INSERT INTO `users` (`sno`, `user`, `password`, `date`) VALUES (NULL, '$email', '$hash', current_timestamp())";
                            try {
                                // $result = mysqli_query($conn, $sql);
                                // if ($result) {
                                if ($this->database->insert('users', $arr)) {
                                    return (object) array("error"=>0, "error_mess"=>"Successfully Signed in", "error_code"=>"auth - signed in");
                                }
                            } catch (Exception $e) {
                                //throw $th;
                                return (object) array("error"=>1, "error_mess"=>"Network connect problem", "error_code"=>"ERROR: ".$e);
                            }
                        }
                    } catch (Exception $e) {
                        //throw $th;
                        return (object) array("error"=>1, "error_mess"=>"Network connect problem", "error_code"=>"ERROR: ".$e);
                    }
                }else{
                    return (object) array("error"=>1, "error_mess"=>"Password have minmum 1 special character", "error_code"=>"ERROR: password no special character found");
                }

            }else{
                return (object) array("error"=>1, "error_mess"=>"Password have minmum 6 digit", "error_code"=>"ERROR: password lenth is ".strlen($password). ". This smaller than 6");
            }
        }else{
            return (object) array("error"=>1, "error_mess"=>"This email is badly formated", "error_code"=>"ERROR: ". $email ." this email id is not formated like '@', '.com' ");
        }
    }

    public function signIn($email, $password){
        try {
            // $User_result = mysqli_query($conn, "SELECT * FROM `users` WHERE `user` = '$userid'");
            // $num_rows = mysqli_num_rows($User_result);
            // $query = $this->database->where($this->email, $email)->get($this->table);
            $query = $this->database->select($this->table,['email'=>$email]);
            if ($query->count() == 1) {
                $user = $query->get(fn($v)=>(array)$v)[0];
                if (password_verify($password, $user[$this->password])) {
                  $_SESSION['loggedin'] = true;
                  $user['password'] = null;
                  $_SESSION['user_log'] = (object) $user;
                  return (object) array("error"=>0, "error_mess"=>"Successfully Signed in", "error_code"=>"auth - signed in");
                }else{
                  return (object) array("error"=>1, "error_mess"=>"Invalid Password", "error_code"=>"ERROR: auth - sign account password is not match");
                }
            }else{
              return (object) array("error"=>1, "error_mess"=>"Invalid User", "error_code"=>"ERROR: auth - sign account user is not found");
            }
        } catch (Exception $e) {
            return (object) array("error"=>1, "error_mess"=>"Network connect problem", "error_code"=>"ERROR: ".$e);
        }
    }

    public function logout(){
        session_unset();
        session_destroy();
    }

    public function setTableName($table){
        $this->table = $table;
    }

    public function setEmailName($email){
        $this->email = $email;
    }

    public function setPasswordName($password){
        $this->password = $password;
    }
}
