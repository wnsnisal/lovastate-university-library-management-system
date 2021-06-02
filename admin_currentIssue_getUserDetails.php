<?php require_once('inc/connection.php'); ?>
<?php
    if(isset($_GET['issueId'])){
        $issueId=$_GET['issueId'];
        //prepare select query for get issue details
        $issue_select_query = "SELECT * FROM tblissue WHERE issueId = '$issueId' LIMIT 1";
        $exc_issue_select_query = mysqli_query($connection,$issue_select_query);
        $issue = mysqli_fetch_assoc($exc_issue_select_query);

        //get user id
        $userId = $issue['userId'];
        $bookId= $issue['bookId'];
        //prepare select query for get book details
        $book_select_query = "SELECT * FROM tblbooks WHERE bookId = '$bookId' LIMIT 1";
        $exc_book_select_query = mysqli_query($connection,$book_select_query);

        //prepare select query for get user details
        $select_query = "SELECT * FROM tbluser WHERE userId = '$userId' LIMIT 1";
        $exc_select_query = mysqli_query($connection,$select_query);
        //if query success
        if($exc_select_query && $exc_book_select_query){
            $user = mysqli_fetch_assoc($exc_select_query);
            $book = mysqli_fetch_assoc($exc_book_select_query);
            //sanitize the variabes
            $firstName = $user['firstName'];
            $lastName = $user['lastName'];
            $email = $user['email'];
            $mobileNo = $user['mobileNo'];
            $nic = $user['NIC'];
            $address = $user['AddressOrZip'];
            $profetion = $user['userType'];
            $bookName = $book['bookName'];

            $table = '<table id="tblRquestedUser" class="table">';
            $table .= '<td id="tdCurrentIssueId" style="display:none;">'.$issueId.'</td>';
            $table .= '<tr><td class="lable text-secondary">Full Name</td><td class="text-dark" id="tdFullNameRequested">'.$firstName.' '.$lastName.'</td></tr>';
            $table .= '<tr><td class="lable text-secondary">Email</td><td class="text-dark" id="tdEmailRequested">'.$email.'</td></tr>';
            $table .= '<tr><td class="lable text-secondary">Mobile No</td><td class="text-dark" id="tdMobileNoRequested">'.$mobileNo.'</td></tr>';
            $table .= '<tr><td class="lable text-secondary">NIC</td><td class="text-dark" id="tdNicRequested">'.$nic.'</td></tr>';
            $table .= '<tr><td class="lable text-secondary">Address/Zip</td><td class="text-dark" id="tdAddressOrZipRequested">'.$address.'</td></tr>';
            $table .= '<tr><td class="lable text-secondary">Profetion</td><td class="text-dark" id="tdProfetionRequested">'.$profetion.'</td></tr>';
            $table .= '<tr><td class="lable text-secondary">Selected Book</td><td class="text-dark" id="tdProfetionRequested">'.$bookName.'</td></tr>';
            $table .= '</table>';

            echo $table;
        }
    }
?>
<?php mysqli_close($connection); ?>