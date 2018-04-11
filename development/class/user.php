<?php


 /*
  * Every registration form needs basic inputs, username password and all inputs need to be validated
  * and inserted finally into a database, therefore class allows oops functionality
  */
 class Users {
        public $id = null;
        public $username = null;
        public $email = null;
        public $password = null;
        public $confirm = null;
        public $fullname = null;
        public $errmsg_arr = array();
        public $expiry_interval = null;
     private $salt=null;

        private $table = U_TABLE;
         
	 
		 
	 public function __construct( $data = array() ) {
       
       /* $this->email =  !is_null( $data['email'] )? stripslashes( strip_tags( $data['email'])) : '';
        $this->password =  !is_null( $data['password'] )? stripslashes( strip_tags( $data['password'])) : '';
        $this->confirm =  !is_null( $data['conpassword'] )? stripslashes( strip_tags( $data['conpassword'])) : '';
        $this->fullname =  !is_null( $data['fullname'] )? stripslashes( strip_tags( $data['fullname'])) : '';
        $this->expiry_interval =  !is_null( $data['interval'] )? stripslashes( strip_tags( $data['interval'])) : -1;
        */
        if( isset( $data['username'] ) ) $this->username = ( ( $data['username'] ) );
        if( isset( $data['email'] ) ) $this->email = ( ( $data['email'] ) );
        if( isset( $data['password'] ) ) $this->password = ( ( $data['password'] ) );
        if( isset( $data['conpassword'] ) ) $this->confirm = ( ( $data['conpassword'] ) );
        if( isset( $data['fullname'] ) ) $this->fullname = ( ( $data['fullname'] ) );
        if( isset( $data['interval'] ) ) $this->expiry_interval = (intval( $data['interval'] ));
        
           
	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters 

		$this->__construct( $params ); 
	 }


	 public function userLogin() {
              
		 try{
                     
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT * FROM $this->table WHERE username = :username  LIMIT 1"; //send all data if valid
                      
			 
			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );


            $stmt->execute();
            if ($stmt->rowCount() == 0)
                return "bad username";
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
             if(!password_verify($this->password,$data['password']))
                return "bad password ".$data['password'];
             else
                 return $data;//"Password Error, try again".$this->password;

		 }catch (PDOException $e) {
			  echo( $e->getMessage()." userLogin".$this->username);
			                 
            //return "Login error something went wrong".$e->getMessage().$stmt->queryString;
		 }
	 }
     
     public function getPassword() {

        return $this->password;
     }
     public function getEmail() {

        return $this->email;
     }
     public function getExpiryDate($token)
     {
         if ($token) {
             try {
                 $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
                 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $sql = "SELECT expiry_date FROM $this->table WHERE token = :token && expiry_interval > 0 LIMIT 1";


                 $stmt = $con->prepare($sql);
                 $stmt->bindValue("token", $token, PDO::PARAM_STR);
                 $stmt->execute();
                 $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                 return $rows['expiry_date'];

             } catch (PDOException $e) {
                 echo $e->getMessage() . " getExpiryDate";
                 return false;
             }

         }
         return false;
     }
     public function getFirsttime($email)
     {
         if ($email) {
             try {
                 $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
                 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $sql = "SELECT firsttime FROM $this->table WHERE email = :email LIMIT 1";


                 $stmt = $con->prepare($sql);
                 $stmt->bindValue("email", $email, PDO::PARAM_STR);
                 $stmt->execute();
                 $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                return $rows['firsttime'];


             } catch (PDOException $e) {
                 return $e->getMessage() . " get firsttime";

             }

         }
         return false;
     }
     public function setFullname($email, $newname)
     {
         if ($newname) {
             try {
                 $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
                 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $sql = "Update $this->table set fullname=:fullname WHERE email =:email LIMIT 1";


                 $stmt = $con->prepare($sql);
                 $stmt->bindValue( "email", $email, PDO::PARAM_STR );
                 $stmt->bindValue( "fullname", $newname, PDO::PARAM_STR );
                 $stmt->execute();
                     return $stmt->rowCount();


             } catch (PDOException $e) {
                 return $e->getMessage() . " setFullname";

             }

         }
         return false;
     }
    
     public function updateCurrentlogin($token)
     {
         if ($token) {
             try {
                 $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
                 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $query = "select currentlogin from users where token =:token";
                 $stmt2 = $con->prepare($query);
                 $stmt2->bindValue("token", $token, PDO::PARAM_STR);
                 $stmt2->execute();
                 $row = $stmt2->fetch(PDO::FETCH_ASSOC);

                 $currentlogin = $row['currentlogin'];
                $sql = "Update ".  $this->table." set lastlogin='".$currentlogin."',currentlogin=now() WHERE token = :token ";
                
                $stmt = $con->prepare($sql);
                 $stmt->bindValue("token", $token, PDO::PARAM_STR);
                 $stmt->execute();
                 $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                 return $rows['currentlogin'];

             } catch (PDOException $e) {
                 echo $e->getMessage() .'updateCurrentLogin '.$currentlogin.' '.$stmt->queryString;
                 return false;
             }

         }
         return false;
     }
     public function getPastHash()
     {

             try {
                 $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
                 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $sql = "SELECT past_hash FROM $this->table WHERE email = :email LIMIT 1";


                 $stmt = $con->prepare($sql);
                 $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
                 $stmt->execute();
                 $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                 return $rows['past_hash'];

             } catch (PDOException $e) {
                 echo $e->getMessage() . " getpasthash";
                 return false;
             }


         return false;
     }
    public function checkemail()
    {

     try {
         $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "SELECT email FROM $this->table WHERE email = :email LIMIT 1";


         $stmt = $con->prepare($sql);
         $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
         $stmt->execute();


         $num_rows = $stmt->rowCount();
         if ($num_rows > 0)
             return "Username," . $this->email . ", already exists";
        else 
            return false;//$this->email;


     } catch (PDOException $e) {
         echo $e->getMessage() . " validate email";
         return false;
     }
    }
    public function checkusername()
    {

     try {
         $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "SELECT username FROM $this->table WHERE username = :username LIMIT 1";


         $stmt = $con->prepare($sql);
         $stmt->bindValue("username", $this->username, PDO::PARAM_STR);
         $stmt->execute();


         $num_rows = $stmt->rowCount();
         if ($num_rows > 0)
             return "Username," . $this->username . ", already exists";
        else 
            return false;//$this->email;


     } catch (PDOException $e) {
         echo $e->getMessage() . " validate email";
         return false;
     }
    }

     public function validate(){
           
             try{
			    $pwd = $this->password;
                     
                if (strlen($pwd) < 8) {
                   $this->errmsg_arr[] = "Password too short! Minimum of 8 characters ";                }


                if (!preg_match("#[0-9]+#", $pwd)) {
                   $this->errmsg_arr[] = "Password must include at least one number! " ;
                }

                if (!preg_match("#[a-zA-Z]+#", $pwd)) {
                   $this->errmsg_arr[] = "Password must include at least one letter! ";
                }
                if (!preg_match("#[A-Z]+#", $pwd)) {
                 $this->errmsg_arr[] = "Password must include at least one <b>Upper Case</b> letter! ";
                }
                if (!preg_match("#[a-z]+#", $pwd)) {
                    $this->errmsg_arr[] = "Password must include at least one <b>Lower Case</b> letter! ";
                }
                if (!$this->has_specialchar($pwd))
                    $this->errmsg_arr[] = "Password must include at least one special character! ";

                //check password match
                if( $pwd != $this->confirm ) {
                //echo "Password and Confirm password not match";
                       $this->errmsg_arr[] = "Password and Confirm password not match " ;
                }               
                      
                return $this->errmsg_arr;            
             
                    
             }catch (PDOException $e) {
			  echo $e->getMessage()." validate password";
                    return false;
		 }    
              
             
     }


	 public function register() {
           
            /*
            * Generate auto password, make user change it on first login
            * (numChar,howmany,options[lower,upper,num,symbols])
            */
          $my_password = ''.implode($this->randomPassword(8,1,"lower_case,upper_case,numbers,special_symbols"));
          

        try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "INSERT INTO $this->table(username, email,  password, temppass, fullname, joined, currentlogin, lastlogin, firsttime/*, expiry_interval, expiry_date*/) VALUES(:username, :email,  :password, :temppass, :fullname, now(), now(), now(), :firsttime/*, :expiry_interval, now() + INTERVAL ".$this->expiry_interval." DAY*/)";

            $password_hash = password_hash($my_password, PASSWORD_BCRYPT);

			$stmt = $con->prepare( $sql );
            $stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
            $stmt->bindValue( "email", $this->email, PDO::PARAM_STR );

			$stmt->bindValue( "password", $password_hash, PDO::PARAM_STR );
            $stmt->bindValue( "temppass", $my_password, PDO::PARAM_STR );
            $stmt->bindValue( "fullname", $this->fullname, PDO::PARAM_STR );
            $stmt->bindValue( "firsttime", 'true');
            //$stmt->bindValue( "expiry_interval", $this->expiry_interval, PDO::PARAM_INT );

            $stmt->execute();
             //return password for Administrator to see and save and email
            $this->password=$my_password;

              return true;
                        
		 }catch (PDOException $e) {
			//echo $e->getMessage();
            //echo $e->getCode();
            $this->password=false;
                  return $e->getMessage().' Err: :User::register() '.$e->getMessage().$stmt->queryString;
                       
		 }
          return false;
	 }
     public function checkNewPassword( $data = array() ) {
         $temp = null;
         $confirm=null;
         $new=null;
         $user=null;
         if( isset( $data['username'] ) ) $this->username = stripslashes( strip_tags( $data['username'] ) );
         if( isset( $data['temppass'] ) ) $temp =  $data['temppass'] ;
         if( isset( $data['newpass'] ) ) $this->password = $data['newpass'];
         if( isset( $data['confirmpass'] ) ) $this->confirm = $data['confirmpass'] ;
         try{
             $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
             $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
             $sql = "SELECT username, password, count('username') max FROM $this->table WHERE username = :username LIMIT 1";


             $stmt = $con->prepare( $sql );
             $stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
             $stmt->execute();

             $rows = $stmt->fetch(PDO::FETCH_ASSOC);
             if ($rows['max'] < 0 ) {
                 $this->errmsg_arr[] = "Username," . $this->email . ",incorrect username address";
                 return $this->errmsg_arr;
             }
             else if (!password_verify($temp, $rows['password'])) {
                $this->errmsg_arr[] = "For Username," . $this->email . " incorrect password ";
                 return $this->errmsg_arr;
            }
            return $this->validate();

             
             //return $this->errmsg_arr; 
                     

             


         }catch (PDOException $e) {
             echo $e->getMessage() . " check new password";
             return $this->errmsg_arr;
         }


     }

     public   function addNewPassword(){
         try{
             $hash = password_hash($this->password, PASSWORD_BCRYPT);


             $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
             $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
             $sql = "Update $this->table set password = :password, firsttime=:firsttime, temppass=:temppass, past_hash=:past_hash where username = :username;";
             $stmt = $con->prepare( $sql );
             $stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
             $stmt->bindValue( "password", $hash, PDO::PARAM_STR );
             $stmt->bindValue( "firsttime", 'false', PDO::PARAM_STR );
             $stmt->bindValue( "temppass", '', PDO::PARAM_STR );
             $stmt->bindValue( "past_hash", $this->pastHash(), PDO::PARAM_STR );

             if ($stmt->execute())
                 return true;//"db updated";
             else
                 return false;//"db error check sql".$stmt->queryString;



         }catch (PDOException $e) {
             //echo $e->getMessage();
             //echo $e->getCode();
             return $e->getMessage().' Err:addNewPassword(); '.$e->getCode();

         }
         return false;

 }
 
    
     public   function expiredPassword(){
         try {
             $hash = password_hash($this->password, PASSWORD_BCRYPT);

             $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
             $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $query = "select expiry_interval from $this->table where email=:email";
             $stmt2 = $con->prepare($query);
             $stmt2->bindValue("email", $this->email, PDO::PARAM_STR);
             $stmt2->execute();
             $rows = $stmt2->fetch(PDO::FETCH_ASSOC);
             $expiry_interval = $rows['expiry_interval'];

             $sql = "Update $this->table set password = :password, past_hash=:past_hash, expiry_date=  now() + INTERVAL " . $expiry_interval . "  DAY where email = :email;";

             $stmt = $con->prepare($sql);
             $stmt->bindValue("email", $this->email, PDO::PARAM_STR);

             $stmt->bindValue("password", $hash, PDO::PARAM_STR);
             $stmt->bindValue("past_hash", $this->pastHash(), PDO::PARAM_STR);


             if ($stmt->execute())
                 return true;
             else
                 return "db error check sql" . $stmt->queryString;




         }catch (PDOException $e) {
             //echo $e->getMessage();
             //echo $e->getCode();
             return $e->getMessage().$stmt->queryString;

         }
         return false;

     }
     public   function updateToken($token){
         try{

             $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
             $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
             $sql = "Update $this->table set token = :token where email = :email;";
             $stmt = $con->prepare( $sql );
             $stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
             $stmt->bindValue( "token", $token, PDO::PARAM_STR );

             if ($stmt->execute()){
                 $this->updateCurrentlogin($token);
                 return "db updated";
             }

             else
                 return"db error addToken".$stmt->queryString;



         }catch (PDOException $e) {
             //echo $e->getMessage();
             //echo $e->getCode();
             return $e->getMessage().' Err:addToken(); '.$e->errorInfo;

         }
         return false;

     }

    private function randomPassword($length,$count, $characters) {

    // $length - the length of the generated password
    // $count - number of passwords to be generated
    // $characters - types of characters to be used in the password

    // define variables used within the function
        $symbols = array();
        $passwords = array();
        $used_symbols = '';
        $pass = '';

    // an array of different character types
        $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols["numbers"] = '1234567890';
        $symbols["special_symbols"] = '!?~@#-_+<>[]{}';

        $characters = explode(",",$characters); // get characters types to be used for the passsword

        foreach ($characters as $key=>$value) {
            $used_symbols .= $symbols[$value]; // build a string with all characters
        }
        $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1

        for ($p = 0; $p < $count; $p++) {
            $pass = '';
            for ($i = 0; $i < $length; $i++) {
                $n = rand(0, $symbols_length); // get a random character from the string with all characters
                $pass .= $used_symbols[$n]; // add the character to the password string
            }
            $passwords[] = $pass;
        }

        return $passwords; // return the generated password
    }
    private  function has_specialchar($x,$excludes=array()){
     if (is_array($excludes)&&!empty($excludes)) {
         foreach ($excludes as $exclude) {
             $x=str_replace($exclude,'',$x);
         }
     }
     if (preg_match('/[^a-z0-9 ]+/i',$x)) {
         return true;
     }
     return false;
    }
     public    function pastHash(){
         $arr = null;
         try{

             $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
             $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
             $sql = "SELECT past_hash, password FROM $this->table WHERE email = :email LIMIT 1";
             $stmt = $con->prepare( $sql );
             $stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             $arr=$row['password'];

             if (isset($row['past_hash']) && sizeof($row['past_hash']) >= 2){
                  $past_hash = explode(',',$row['past_hash']);
                  $arr .=','.$past_hash[0].','.$past_hash[1];
             }
             if (isset($row['past_hash']) && sizeof($row['past_hash']) == 1){
                $past_hash = explode(',',$row['past_hash']);
                $arr .=','.$past_hash[0];
            }
            

            
             return  $arr;


         }catch (PDOException $e) {
             //echo $e->getMessage();
             //echo $e->getCode();
             return $e->getMessage().' Err:pastHash(); '.$e->getCode();

         }
         return false;


     }
     public function getErrorMsg(){
         return $this->errmsg_arr;
     }

     public function getUserInfo($token)
     {
         if ($token) {
             try {
                 $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
                 $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $sql = "SELECT fullname, email,joined,lastlogin,firsttime,expiry_interval,expiry_date FROM $this->table WHERE token = :token LIMIT 1";


                 $stmt = $con->prepare($sql);
                 $stmt->bindValue("token", $token, PDO::PARAM_STR);
                 $stmt->execute();
                 $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                 return $rows;

             } catch (PDOException $e) {
                 echo $e->getMessage() . " getUserInfo";
                 return false;
             }

         }
         return false;
     }
     /*private function my_password_hash($password){
         $this->salt =  mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
         $options = [
             'cost' => 11,
             'salt' => $this->salt,
         ];

         return password_hash($password, PASSWORD_BCRYPT, $options);
     }
     */
     public function verifyPassword($password)
     {
         try {
             $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
             $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

             $sql = "SELECT password FROM $this->table WHERE email = :email LIMIT 1";
             $stmt = $con->prepare($sql);
             $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
             $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);

             //verify temp password or previous password
             if (password_verify($password,$row['password']))
                 return true;
             else
                 return false;


         } catch (PDOException $e) {
             return $e->errorInfo();
         }
     }
     public function sendemail($temppass, $email){
         // the message
            $msg = "This is your temporary password. \r\n".$temppass." \r\nLogin to Swachen Admin with this password and change it to a new password immediately";

            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);
            $headers = 'From: info@swachen.co.tz' . "\r\n" .
    'Reply-To: info@swachen.co.tz' . "\r\n";

            // send email
            mail($email,"Swachen Temp Pass",$msg);

     }


 }
 
?>