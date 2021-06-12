<?php 

/* Go to "https://sandbox.africastalking.com/_/" create an account then activate it
 * In your sandbox account,configure your callback url e.g www.example.com/folder_name/ussd_Edutele.php
  *From your sandbox account, Configure a service code such as *384# and a channel e.g 500 so that it becomes *384*500#
  *Happy Coding!!!!
*/

 // Print the response as plain text so that the gateway can read it
 header('Content-type: text/plain');

 /* Configure Database */
  $conn = 'mysql:dbname=id16969491_eduteledb;host=localhost;'; //database name
  $user = 'id16969491_edutele'; // your mysql user 
  $password = 'hZKd^Rt(sHyK$v8rO5x1'; // your mysql password
  //  Create a PDO instance that will allow you to access your database
  try {
  $db = new PDO($conn, $user, $password);
  }

 catch(PDOException $e) {
 //var_dump($e);
 echo("PDO error occurred");
 }

 catch(Exception $e) {
 //var_dump($e);
 echo("Error occurred");
 }

 
    //for africastalking  
    $phone = $_POST['phoneNumber'];
    $session_id = $_POST['sessionId'];
    $service_code = $_POST['serviceCode'];
    $ussd_string= $_POST['text'];
      
    
    // When working from a live server change the GET[] method to POST[] (that is how africastalking do their stuff) 

    $level =0;  
      

      if($ussd_string != ""){  
        $ussd_string= str_replace("#", "*", $ussd_string);  
        $ussd_string_explode = explode("*", $ussd_string);  
        $level = count($ussd_string_explode);  
        }    //The count tells us what level the user is at i.e how many times the user has responded
   
     
     
     //$level=0 means the user hasnt replied.We use levels to track the number of user replies
     if($level == 0){
      displayMenu(); // show the home/first menu
     }
   
    if ($level>0){  
           switch ($ussd_string_explode[0]) {  
               // If user selected 1 send them to the fee balance menu
                case 1:  
                fee_balance($ussd_string_explode,$phone,$db);  
                break; 
               
               // If user selected 2 send them to the exam results menu
                case 2: 
                exam_results($ussd_string_explode,$phone,$db);  
                break;  
               
               // If user selected 3 send them to the events menu
                case 3:  
                info_at_school($ussd_string_explode,$phone,$db);  
                break; 
               // If user selected 4 send them to the fee structure menu
                case 4:  
                fee_structure($ussd_string_explode,$phone);  
                break; 
               // If user selected 5 send them to the lipa na mpesa menu
                case 5:  
                lipa_na_mpesa($ussd_string_explode,$phone,$db);  
                break; 
                case 6:  
                register($ussd_string_explode,$phone,$db);  
                break; 

                 }  
             }  
       
       
    //This is the home menu function
    function displayMenu(){
    $ussd_text ="Welcome to Edutele\n 1. Fee Balance \n 2. Exam Results \n 3. Upcoming Events \n 4. Fee Structure \n 5. Pay Fees\n "; 
    ussd_proceed($ussd_text);
    }
        
    /* The ussd_proceed function appends CON to the USSD response your application gives.
     * This informs Africa's Talking USSD gateway and consecuently Safaricom's
     * USSD gateway that the USSD session is till in session or should still continue
     * Use this when you want the application USSD session to continue
     */
     
    function ussd_proceed($ussd_text){
    echo "CON $ussd_text";
    }
 
    /* This ussd_stop function appends END to the USSD response your application gives.
     * This informs Africa's Talking USSD gateway and consecuently Safaricom's
     * USSD gateway that the USSD session should end.
     * Use this when you to want the application session to terminate/end the application
     */
     
    function ussd_stop($ussd_text){
    echo "END $ussd_text";
    }
    
    
    function fee_balance($details,$phone,$db){  
      
         if (count($details)==1)
          {  
            $ussd_text="Check Fee Balance \n Enter admission Number";  
            ussd_proceed($ussd_text);  
          }  
          
        if(count($details)== 2)
         {
             if (empty($details[0])){
                $ussd_text = "Sorry we do not accept blank values";
                ussd_proceed($ussd_text);
               }

            else {  
            $admNo=$details[1]; 

            $stmt = $db->query("SELECT * FROM fee_balances WHERE adm_no='".$admNo."'");
            $stmt->execute();

            if($stmt->rowCount() > 0)
             {
                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                 extract($row);
                 $date=$row['date'];
                 $phpdate=strtotime($date);
                 $new_date=date("d/m/Y", $phpdate);

                 echo "END Fee Balance for " .$row['student_name']." as at ".$new_date." is Ugx.".$row['fee_balance']; 
             }
          }

         else {

            echo "END Fee Balance not available at \n the moment or wrong admission number" ;
       
            }
     
           

        }  
      }  
}
    

        
      
function info_at_school($details,$phone,$db) {  
           
           $stmt = $db->query("SELECT * FROM upcoming_events WHERE start_date >='".date("Y/m/d")."'");
           $stmt->execute();

            if($stmt->rowCount() > 0)
             {

                echo "END <ol>";
                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                 extract($row);
                 $date=$row['start_date'];
                 $phpdate=strtotime($date);
                 $new_date=date("d/m/Y", $phpdate);
               
                echo "<li>".$row['event_name']. " is on ".$new_date."</li><br>"; 
               
             }
              echo "</ol>";
          }
          
         else {

            echo "END No event is available at the moment" ;
       
            }
            
            
         
}  


function fee_structure($details,$phone) {  

         if(count($details) == 1){  
         $ussd_text = "Choose Class \n 1. Form 1 \n 2. Form 2 
                       3. Form 3 \n 4. Form 4\n "; 

         ussd_proceed($ussd_text);  
        }  

        else if(count($details) == 2){  
                $classChoice=$details[1]; 

            if($classChoice=="1"){  
                $total_fee="Ugx. 22,000";
                echo "END Total fee for Form 1 is " .$total_fee;

            }else if($classChoice=="2"){  
                $total_fee="Ugx. 23,000";
                echo "END Total fee for Form 2 is " .$total_fee;

            }else if($classChoice=="3"){  
                $total_fee="Ugx. 24,000";
                echo "END Total fee for Form 3 is " .$total_fee;

            }else if($classChoice=="4"){  
                $total_fee="Ugx. 25,000";
                echo "END Total fee for Form 4 is " .$total_fee;
            } 

        }  

     else {  
            $ussd_text = "Your session is over";  
                ussd_proceed($ussd_text);       
          }  
}

function lipa_na_mpesa($details,$phone,$db){

      if (count($details)==1){
        $ussd_text="Enter your first name";
        ussd_proceed($ussd_text);
        }

      else if(count($details) == 2){
      $ussd_text = "Enter your last name";
      ussd_proceed($ussd_text);
       }

      else if(count($details) == 3){
        $class=$details[1]; 
      echo  "CON Select Class \n 1. Form 1 \n 2. Form 2 \n
      3. Form 3 \n 4. Form 4 \n";

        if($class=="1"){
            $class="Form 1";

        }else if($class=="2"){
        $class="Form 2";

        }else if($class=="3"){
        $class="Form 3";

        }else if($class=="4"){
        $class="Form 4";
       }

       
      }
       
     else if (count($details)==4){
       $ussd_text="Enter paybill number";
       ussd_proceed($ussd_text);
       }

    else if(count($details) == 5){
       $ussd_text = "Enter the Amount";
       ussd_proceed($ussd_text);
       }

    else if(count($details) == 6){
        $admNo=$details[0];
        $fName=$details[1];
        $lName=$details[2];
        $class=$details[3];
        $paybill_number=$details[4];
        $amount=$details[5];  
 
        echo  "CON Confirm\n 1. Accept \n 2. Cancel \n
        Admission number: " . $admNo . "\n" .
        "Fullnames: " . $fName. " " . $lName . "\n" .
        "Form: " . $class . "\n" .
        "Paybill Nunber: " . $paybill_number . "\n".
        "Amount: " . $amount . "\n" ;

        }

        else if(count($details) == 7){ 
          $admNo=$details[0];
          $fName=$details[1];
          $lName=$details[2];
          $class=$details[3];
          $paybill_number=$details[4];
          $amount=$details[5]; 
        $acceptDeny=$details[6]; 

       if($acceptDeny=="1"){  
          $stmt = $db->prepare("INSERT INTO payment_details 
              (adm_no, first_name, last_name,class,paybill_number,amount,date_paid) VALUES('$admNo','$fName','$lName','$class','$paybill_number','$amount',NOW())");

        //execute insert query   
        $stmt->execute();
        if($stmt->errorCode() == 0) {
            echo "END Thank you ".$fName." Payment was successful. You have paid Ugx ".$amount." to paybill number  ".$paybill_number;
             
          } else {
            $errors = $sth->errorInfo();
         }
      }

     }

    else{//Choice is cancel  
      echo "END Your session is over";  
       
       }  
}   



// Function that handles Registration menu
function register($details,$phone, $dbh){
  if(count($details) == 2)
  {
      
      $ussd_text = "CON Please enter your Full Name and Email, each seperated by commas:";
      echo $ussd_text; // ask user to enter registration details
  }
  if(count($details)== 3)
  {
      if (empty($details[1])){
              "Sorry we do not accept blank values";
              ussd_proceed($ussd_text);
      } else {
      $input = explode(",",$details[1]);//store input values in an array
      $full_name = $input[0];//store full name
      $email = $input[1];//store email
      $phone_number =$phone;//store phone number 

      // build sql statement
      $sth = $dbh->prepare("INSERT INTO customers (full_name, email, phone) VALUES('$full_name','$email','$phone_number')");
      //execute insert query   
      $sth->execute();
      if($sth->errorCode() == 0) {
          $ussd_text = $full_name." your registration was successful. Your email is ".$email." and phone number is ".$phone_number;
          ussd_proceed($ussd_text);
      } else {
          $errors = $sth->errorInfo();
      }
  }
}
}



  # close the pdo connection  
   $db = null;

 ?>