<?php require_once('inc/connection.php'); ?>
<?php 
    //check if the user selected
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        //prepare select query for get user details
        $select_user_query = "SELECT * FROM tbluser WHERE email='$email' LIMIT 1";
        $exc_select_user_query = mysqli_query($connection,$select_user_query);
        //if query success
        if(mysqli_num_rows($exc_select_user_query) != 0){
            $user = mysqli_fetch_assoc($exc_select_user_query);
            $userId = $user['userId'];
            //prapare select query for get user details
            $select_query = "SELECT * FROM tbluser WHERE userId='$userId' LIMIT 1";
            $exc_select_query = mysqli_query($connection,$select_query);
            //if query success
            if($exc_select_query){
                $records = mysqli_fetch_assoc($exc_select_query);
                //sanitize variables
                $firstName = $records['firstName'];
                $lastName = $records['lastName'];
                $email = $records['email'];
                $mobileNo = $records['mobileNo'];
                $nic = $records['NIC'];
                $address = $records['AddressOrZip'];
                $profetion = $records['userType'];
    
                $table = '<table id="tblCurrentUser" class="table">';
                $table .='<tbody>';
                $table .='<tr style="display:none;"><td class="text text-secondary">Id</td><td id="tdId">'.$userId.'</td></tr>';
                $table .='<tr><td class="text text-secondary">Full Name</td><td id="tdFullName">'.$firstName.' '.$lastName.'</td></tr>';
                $table .='<tr><td class="text text-secondary">Email</td><td id="tdEmail">'.$email.'</td></tr>';
                $table.='<tr><td class="text text-secondary">Mobile No</td><td id="tdMobileNo">'.$mobileNo.'</td></tr>';
                $table.='<tr><td class="text text-secondary">NIC</td><td id="tdNic">'.$nic.'</td></tr>';
                $table .='<tr><td class="text text-secondary">Address/Zip</td><td id="tdAddressOrZip">'.$address.'</td></tr>';
                $table .='<tr><td class="text text-secondary">Profetion</td><td id="tdProfetion">'.$profetion.'</td></tr>';
                $table .='</tbody>';
                $table .='</table>';
    
                echo $table;
            }
        }else{
            echo '<div role="alert" class="alert alert-danger text-center">invalid email!</div>';
        }        
    }
?>
<?php mysqli_close($connection); ?>