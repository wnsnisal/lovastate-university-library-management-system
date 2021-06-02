<?php require_once('inc/connection.php'); ?>
<?php
    if(isset($_POST['userId'])){
        //get user Id
        $userId = $_POST['userId'];

        //prepare select query
        $select_query = "SELECT * FROM tblissue WHERE userId='$userId' AND issueStatus='approved' AND returnStatus='pending' OR userId='$userId' AND returnStatus='expired' AND issueStatus='approved'";
        $exc_select_query = mysqli_query($connection,$select_query);

        $rowCount = mysqli_num_rows($exc_select_query);
        //if query success
        if(!($rowCount==0)){
            
            $tabel = '<table id="tblBooksTopic" class="table table-secondary" style="font-size:12px;">';
            $tabel .= '<thead class="thead-dark"><tr><th class="TdOne" style="display:none"></th><th class="TdOne">Book Name</th><th class="TdTwo">Barrowed Date</th><th class="TdThree">Return Date</th><th class="TdFour">Return Status</th><th class="TdFour">Action</th></tr></thead>';
            $tabel .= '<tbody>';
            for($i=0; $i<$rowCount; $i++){
                $records = mysqli_fetch_assoc($exc_select_query);
                //sanitiz issue details
                $issueId = $records['issueId'];
                $bookId = $records['bookId'];
                $barrowDate = $records['issueDate'];
                $returnDate = $records['returnDate'];
                $returnStatus = $records['returnStatus'];
                $panaltyFee = $records['panalty'];

                //select query for get book details
                $book_select_query = "SELECT * from tblbooks WHERE bookId = '$bookId' LIMIT 1";
                $exc_book_select_query = mysqli_query($connection,$book_select_query);
                $book = mysqli_fetch_assoc($exc_book_select_query);
                //sanitize book name
                $bookName = $book['bookName'];
                if($returnStatus == 'expired'){
                    $tabel .= '<tr>';
                    $tabel .= '<td id="tdIssueId" style="display:none">'.$issueId.'</td>';
                    $tabel .= '<td id="tdBookName">'.$bookName.'</td>';
                    $tabel .= '<td id="tdBarrowDate">'.$barrowDate.'</td>';
                    $tabel .= '<td id="tdReturnDate">'.$returnDate.'</td>';
                    $tabel .= '<td id="tdReturnStatus">'.$returnStatus.'</td>';
                    $tabel .= '<td id="tdReturnStatus" style="display:none;">'.$panaltyFee.'</td>';
                    $tabel .= '<td id="tdAction"><button id="btnReturnView" class="btn btn-success btn-sm btnReturnView" data-toggle="modal" data-target="#modCalculateFine">Return</button></td>';
                    $tabel .= '</tr>';
                }else{
                    $tabel .= '<tr>';
                    $tabel .= '<td id="tdIssueId" style="display:none">'.$issueId.'</td>';
                    $tabel .= '<td id="tdBookName">'.$bookName.'</td>';
                    $tabel .= '<td id="tdBarrowDate">'.$barrowDate.'</td>';
                    $tabel .= '<td id="tdReturnDate">'.$returnDate.'</td>';
                    $tabel .= '<td id="tdReturnStatus">'.$returnStatus.'</td>';
                    $tabel .= '<td id="tdReturnStatus" style="display:none;">'.$panaltyFee.'</td>';
                    $tabel .= '<td id="tdAction"><button id="btnReturn" class="btn btn-success btn-sm btnReturn">Return</button></td>';
                    $tabel .= '</tr>';
                }
                
            }
            $tabel .= '</tbody>';
            $tabel .= '</table>'; 

            echo $tabel;
        }else{
            echo '<div role="alert" class="alert alert-info text-center">Thair is no any book to return.</div>';
            
        }
    }
?>
<!--model for calculate panalty-->
<div class="modal fade bd-example-modal-sm mt-5" id="modCalculateFine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bg-light" style="box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.7);">
            <div class="modal-header bg-dark">
                <h4 class="text text-secondary text-center" id="topic">Pay panalty</h4>
                <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="" id="frmPayAndReturn" method="post">
                            <div class="form-group">
                                <p id="p_issueId" style="display:none;"><?php echo $issueId; ?></p>
                                <label for="p_panaltyFee">Panalty fee</label>
                                <p name="panaltyFee" class="form-control " id="p_panaltyFee"><?php echo $panaltyFee.'.00'; ?></p>
                            </div>
                            <button id="btnPayAndReturn" class="btn btn-lg btn-success btn-block" value="PayAndReturn">Pay and return</button>
                        </form>
                        <div id="pay_ststus_msg" role="alert" class="text-center mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        //return book
        $(".btnReturn").click(function(){
            //find the row
            var row = $(this).closest("tr");
            //get issue id
            var issueId = row.find("#tdIssueId").text();
            $("#return_status_msg").load('admin_returnBook.php',{
                issueId:issueId,
            });
        });
        //add panalty and return book
        $("#frmPayAndReturn").submit(function(event){
            event.preventDefault();
            var issueId = $("#p_issueId").text();
            var payAndReturn = $("#btnPayAndReturn").val();

            $("#pay_ststus_msg").load('admin_payAndReturn.php',{
                issueId:issueId,
                payAndReturn:payAndReturn
            });
        });
    });

<?php mysqli_close($connection); ?>

