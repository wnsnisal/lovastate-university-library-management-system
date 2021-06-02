<?php require_once('inc/connection.php'); ?>
<?php session_start();?>
<?php

    $query = "SELECT * from tblbooks WHERE bookStatus='available'";
    $exc_query = mysqli_query($connection, $query);

    if($exc_query){
        $rowCount = mysqli_num_rows($exc_query);

        $table = '<table class="tblBookDetails table" id="tblBookDetails">';
        $table .= '<thead class="thead-light"><tr><th class="hidden" scope="col">#</th><th scope="col">Book name</th><th scope="col">Publisher</th><th class="hidden" scope="col" id="bookDiscription">discription</th><th scope="col">Action</th></tr></thead>';
        for($i = 0; $i<$rowCount; $i++){

            $record = mysqli_fetch_assoc($exc_query);

            $table .= '<tbody>';
            $table .= '<tr>';
            $table .= '<th class="hidden" scope="row" id="view_bookId">'.$record['bookId'].'</th>';
            $table .= '<td id="view_bookName">'.$record['bookName'].'</td>';
            $table .= '<td id="view_publisher">'.$record['publisher'].'</td>';
            $table .= '<td id="view_discription" class="hidden">'.$record['discription'].'</td>';
            $table .= '<td id="view_category" class="hidden">'.$record['category'].'</td>';
            $table .= '<td id="view_action"><button id="btnBarrowBook" class="btn btn-primary btn-sm btnBarroBook" data-toggle="modal" data-target="#exampleModal">View</button></td>';
            $table .= '<tr>';
            $table .= '</tbody>';
        }
        $table.="</table>";
    }else{
        echo "thair is no book in the system!";
    }
    
?>


<div id="carouselExampleCaptions" class="carousel slide mt-2" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/book1.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/book2.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/book3.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!--book details-->
<div class="" id="bookDetails">
    <div class="col-12 mt-3">
        <form action="" class="form-inline" method="post" id="frmUserSearchBook">
            <div class="form-group">
                <input name="searchBook" type="text" aria-describedby="searchBook" class="form-control" id="txtSearchBook" placeholder="Search Book">
            </div>
            <div class="form-group ml-1">
                <button id="btnSearchBook" class="btn btn-primary btn-sm" value="searchBook"><i class="fas fa-search" id="btnSearchBook"></i></button>
            </div>
        </form>
    </div>
<hr>
<h3 class="text-center text-dark lead">Select your favorite book</h3>
    <!--book chatagory-->
    <div class="row justify-content-center">
    <div class="col-lg-6 col-sm-6 cl-12">
    <form action="" method="post" class="">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select the book catagory</label>
            <select class="form-control" name="bookCatagery" id="selBookCatagery">
              <option value="All">All catageries</option>
              <option value="Anthology" id="opt">Anthology</option>
              <option value="Classic" id="optClassic">Classic</option>
              <option value="ComicAndGraphicNovel" id="optComicAndGraphicNovel">Comic and Graphic Novel</option>
              <option value="CrimeAndDetective" id="optCrimeAndDetective">Crime and Detective</option>
              <option value="Drama" id="optDrama">Drama</option>
              <option value="Fable" id="optFable">Fable</option>
              <option value="FairyTale" id="optFairyTale">Fairy Tale</option>
              <option value="Fan-Fiction" id="optFan-Fiction">Fan-Fiction</option>
              <option value="Fantasy" id="optFantasy">Fantasy</option>
              <option value="HistoricalFiction" id="optHistoricalFiction">Historical Fiction</option>
              <option value="Horror" id="optHorror">Horror</option>
              <option value="Humor" id="optHumor">Humor</option>
              <option value="Legend" id="optLegend">Legend</option>
              <option value="MagicalRealism" id="optMagicalRealism">Magical Realism</option>
              <option value="Mystery" id="optMystery">Mystery</option>
              <option value="Mythology" id="optMythology">Mythology</option>
              <option value="RealisticFiction" id="optRealisticFiction">Realistic Fiction</option>
              <option value="Romance" id="optRomance">Romance</option>
              <option value="Satire" id="optSatire">Satire</option>
              <option value="ScienceFiction(Sci-Fi)" id="optScienceFiction(Sci-Fi)">Science Fiction (Sci-Fi)</option>
              <option value="ShortStory" id="optShortStory">Short Story</option>
              <option value="Suspense/Thriller" id="optSuspense/Thriller">Suspense/Thriller</option>
            </select>
        </div>
    </form>
    </div>
    </div>
  <div class="tbl" id="table">
    <?php echo $table; ?>
  </div>
</div>

<!-- Modal for view book details-->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-light" id="exampleModalLabel">Book Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                      <form action="user_barrowBook.php" id="frmViewBookDetails" name="viewBookDetails" method="post">
                        <p id="p_bookId" style="display:none;"></p>
                        <div class="row">
                          <div class="col-4">
                            <p class="alert alert-success">Book Name</p>  
                          </div>
                          <div class="col-8">
                            <p id="bookName" class="alert alert-info" role="alert"></p>  
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-4">
                            <p class="alert alert-success">Pubisher</p>  
                          </div>
                          <div class="col-8">
                            <p id="publisher" class="alert alert-info" role="alert"></p>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-4">
                            <p class="alert alert-success">Discription</p> 
                          </div>
                          <div class="col-8">
                            <p id="discription" class="alert alert-info" role="alert"></p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-4">
                            <p class="alert alert-success">Category</p>
                          </div>
                          <div class="col-8">
                            <p id="category" class="alert alert-info" role="alert"></p>
                          </div>
                        </div>
                        
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="btnBarrow" data-toggle="modal" data-target="#modUserConfrom">Barrow</button>
                        </div>
                        <p class="text-center lead mt-3" id="satus_msg"></p>
                      </form>
                    </div>
                  </div>
                </div>
                
            </div>
        </div>
</div>



<!-- Modal for conform barrowng book-->
<div class="modal fade bd-example-modal-sm mt-5" id="modUserConfrom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content bg-light" style="box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.7);">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-light" id="exampleModalLabel">User Conform</h5>
                    <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                      <small class="form-text text-muted text-center"><p class="text text-dark">enter email and password to conform barrowing book</p></small>
                      <hr>
                      <!--barrowing book form-->
                      <form action="" id="frmBarrowBook" method="post">

                        <p style="display:none;" id="conform_bookId"></p>
                        <p style="display:none;" id="conform_bookName"></p>
                        <p style="display:none;" id="conform_publisher"></p>
                        <p style="display:none;" id="conform_discription"></p>
                        <p style="display:none;" id="conform_category"></p>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input name="txtEmail" type="email" class="form-control" id="conform_txtEmail" aria-describedby="emailHelp" maxlength="50" required>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">New password</label>
                          <input name="txtNewPassword" type="password" class="form-control" id="conform_Password">
                          <i class="far fa-eye" id="eye"></i>
                        </div>
                        <div class="modal-footer">
                          <button name="barowBook" class="btn btn-danger" id="btnBarrow" value="conform">Conform</button>
                        </div>
                        <p class="text-center lead mt-3" id="barrow_satus_msg"></p>
                      </form>
                    </div>
                  </div>
                </div>
                
            </div>
        </div>
</div>

<!-- inport jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        //jquery code for filter book category
        $("#selBookCatagery").on("change",function(){
            var book_category = $("#selBookCatagery").val();
            var getURL= "filterByCetagory_bookDetails.php?category=" + book_category;
            $.get(getURL, function(data, status){
                $("#table").html(data);
            });   
        });

        //jquery code for view book details
        $(".btnBarroBook").click(function(){
            // find the row
            var row = $(this).closest("tr"); 
            // Find the text values
            var bookId = row.find("#view_bookId").text();
            var bookName = row.find("#view_bookName").text();
            var publisher = row.find("#view_publisher").text();
            var discription = row.find("#view_discription").text();
            var category = row.find("#view_category").text();

            document.getElementById("p_bookId").textContent = bookId;
            document.getElementById("bookName").textContent = bookName;
            document.getElementById("publisher").textContent = publisher;
            document.getElementById("discription").textContent = discription;
            document.getElementById("category").textContent = category;

            document.getElementById("conform_bookId").textContent = bookId;
            document.getElementById("conform_bookName").textContent = bookName;
            document.getElementById("conform_publisher").textContent = publisher;
            document.getElementById("conform_discription").textContent = discription;
            document.getElementById("conform_category").textContent = category;
            
        });

        //jquery for barrow book
        $("#frmBarrowBook").submit(function(event){
          event.preventDefault();
          //book details
          var barrow_bookId = $("#conform_bookId").text();
          var barrow_bookName = $("#conform_bookName").text();
          var barrow_publisher = $("#conform_publisher").text();
          var barrow_discription = $("#conform_discription").text();
          var barrow_category = $("#conform_category").text();
          //user details
          var conform_email = $("#conform_txtEmail").val();
          var conform_password = $("#conform_Password").val();
          var submit= 'submit';

          console.log(submit);
          console.log(conform_email);
          console.log(barrow_bookId);

          $("#barrow_satus_msg").load("user_barrowBook.php",{
            barrow_bookId:barrow_bookId,
            barrow_bookName:barrow_bookName,
            barrow_publisher:barrow_publisher,
            barrow_discription:barrow_discription,
            barrow_category:barrow_category,
            conform_email:conform_email,
            conform_password:conform_password,
            submit:submit
          });
        });
        //close window
        $("#btnClose").click(function(){
            document.getElementById("conform_txtEmail").value = "";
            document.getElementById("conform_Password").value = "";
        });
        //search book
        $("#frmUserSearchBook").submit(function(event){
            event.preventDefault();
            var search_bookName = $("#txtSearchBook").val();
            var searchBook = $("#btnSearchBook").val();

            $("#table").load("user_searchBookDetails.php",{
                search_bookName:search_bookName,
                searchBook:searchBook
            });
        });
    });
</script>
<?php mysqli_close($connection);?>