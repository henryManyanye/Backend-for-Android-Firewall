<?php 

    $ecocashUsername = $_POST["ecocashUsername"];
    $approvalCode = $_POST["approvalCode"];  

    //  $ecocashUsername = "Test Name";
    //  $approvalCode = "Test Code"; 


    // file_put_contents("message.txt",  $ecocashUsername); 
    // file_put_contents("message.txt",  $approvalCode); 


    $mysqli = new mysqli("localhost", "hman", "qsefthuko", "accountsDB");
    $result = $mysqli->query("SELECT balance FROM accountInfo WHERE ecocashUsername = '$ecocashUsername' AND approvalCode = '$approvalCode'");
    if(false == $result)
    {
         echo "FAILED $mysqli->query...";
    }else{

        /*************** EXPERIMENT *************************/
            if($result->num_rows == 0)
            {
                echo "Error: username and approval code not found in database. Enter correct details or retry later.";

            }else{
                $row = $result->fetch_row();
                $balance = $row[0];         
                
                /************** EXPERIMENT *******************/
                    $mysqli->query("DELETE FROM accountInfo WHERE ecocashUsername = '$ecocashUsername' AND approvalCode = '$approvalCode'");

                    if($mysqli->affected_rows > 0)
                    {
                        echo "Recharge successful. Recharge amount is $balance"; 
                    }
                /*********************************************/
               
                

                  
            }

        /****************************************************/

         
    }

    $result->free();
    $mysqli->close();


 ?>


 
