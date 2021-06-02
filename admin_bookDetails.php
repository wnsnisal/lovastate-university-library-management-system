
<?php require_once('inc/connection.php'); ?>
<?php
    //select book details from the book table
    $query = "SELECT * FROM tblbooks WHERE bookStatus = 'available'";
    $exc_query = mysqli_query($connection,$query);

    //check if the query excuited
    if($exc_query){
        $rowCount = mysqli_num_rows($exc_query);

        $table = '<table class="tblBookDetails table table-striped">';
        $table .= '<thead class="thead-dark"><tr><th scope="col"></th><th scope="col">id</th><th scope="col">book Name</th><th scope="col">Publisher</th><th scope="col">category</th><th scope="col">discription</th><th scope="col">quentity</th></tr></thead>';
        for($i = 0; $i<$rowCount; $i++){
            $record=mysqli_fetch_assoc($exc_query);
            $table .= '<tbody class="tboddy-dark">';
            $table .= '<tr id="select_book">';
            $table .= '<td id="Edit_button"><button class="btn btn-success viewBook" id="btnViewBook" value="#btnViewBook" name="viewBook" data-toggle="modal" data-target="#modEditBookDetails">Edit</button></td>';
            $table .= '<td id="Edit_bookId">'.$record['bookId'].'</td>';
            $table .= '<td id="Edit_bookName"  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;max-width: 130px;">'.$record['bookName'].'</td>';
            $table .= '<td id="Edit_publisher">'.$record['publisher'].'</td>';
            $table .= '<td id="Edit_category">'.$record['category'].'</td>';
            $table .= '<td id="Edit_discription" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;max-width: 130px;">'.$record['discription'].'</td>';
            $table .= '<td id="Edit_quentity" style="background-color: rgb(160, 160, 160,0.3); color:rgb(43, 43, 43);">'.$record['quentity'].'</td>';
            $table .= '</tr>';
            $table .= '</tbody>';
        }
        $table .= '</table>';
    }else{
        echo "error";
    }
?>
<div class="row">
    <div class="col-12">
        <form action="" class="form-inline" method="post" id="frmAdminSearchBook">
            <div class="form-group">
                <input name="searchBook" type="text" aria-describedby="searchBook" class="form-control" id="txtSearchBook" placeholder="Search Book">
            </div>
            <div class="form-group ml-1">
                <button id="btnSearchBook" class="btn btn-danger btn-sm" value="searchBook"><i class="fas fa-search" id="btnSearchBook"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-3">
        <div class="max_height">
            <div id="divSearchBookDetails">
                <?php echo $table; ?>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-lg-8 mt-3">
            <div class="div">
                <h4 class="text text-secondary text-center" id="topic">Add new book</h4>
                <hr>
                <form action="" class="" method="post" id="frmAddBook" value="addBook">
                    
                    <div class="from-group mt-2">
                        <label for="txtAddBookName" class="text text-secondary ml-2">book name</label>
                        <input type="text" name="bookName" class="form-control" id="txtAddBookName" placeholder="type the book name" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="txtAddPublisher" class="text text-secondary ml-2">publisher</label>
                        <input type="text" class="form-control" id="txtAddPublisher" placeholder="type the publisher" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="txtCategory" class="text text-secondary ml-2">category</label>
                        <select name="bookCatagery" id="txtCategory" required class="form-control">
                            <option value="">select book catagery</option>
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
                    <div class="form-group mt-2">
                        <label for="txtAddBookDiscription" class="text text-secondary ml-2">description</label>
                        <textarea class="form-control" id="txtAddBookDiscription" placeholder="type the discription" required></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="txtAddBookDiscription" class="text text-secondary ml-2">quentity</label>
                        <input type="number" class="form-control" id="txtAddQuentity" placeholder="type the quentity" required>
                    </div>
                    <div class="form-group mt-2">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <button name="addBook" class="btn btn-primary btn-block" id="btnAddBook" value="add">Add</button>
                            </div>    
                        </div>
                    </div>
                    <!--display status-->
                    <p class="text-center lead mt-3" id="status_msg"></p>
                </form>
            </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-md mt-2" id="modEditBookDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bg-light" style="box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.7);">
                <div class="modal-header bg-dark">
                    <h4 class="text text-secondary text-center" id="topic">Edit book details</h4>
                    <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                        <form action="" class="" method="post" id="frmDeleteBook">
                            <p id="p_bookId" style="display:hidden;"></p>
                            <div class="from-group mt-2">
                                <label for="txtDeleteBookName" class="text text-secondary ml-2">book name</label>
                                <input type="text" name="bookName" class="form-control" id="txtDeleteBookName" placeholder="the book name" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="txtDeletePublisher" class="text text-secondary ml-2">publisher</label>
                                <input type="text" class="form-control" id="txtDeletePublisher" placeholder="the publisher" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="txtDeleteCategory" class="text text-secondary ml-2">category</label>
                                <select name="bookCatagery" id="txtDeleteCategory" required class="form-control">
                                    <option value="">select book catagery</option>
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
                            <div class="form-group mt-2">
                                <label for="txtDeleteBookDiscription" class="text text-secondary ml-2">description</label>
                                <textarea class="form-control" id="txtDeleteBookDiscription" placeholder="type the discription" required></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="txtDeleteQuentity" class="text text-secondary ml-2">quentity</label>
                                <input type="text" class="form-control" id="txtDeleteQuentity" placeholder="type the quentity" required>
                            </div>
                            <div class="form-group mt-2">
                                <button name="addBook" class="btn btn-primary" id="btnUpdateBook" value="edit">Update</button>
                                <button name="addBook" class="btn btn-danger" id="btnDelateBook" value="delete">Delete</button>
                            </div>
                            <!--display status-->
                            <div id="update_status_msg"></div>
                        </form>
                        </div>
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
        //view book
        $(".viewBook").click(function(){
            // find the row
            var row = $(this).closest("tr"); 
            // Find the text values
            var view_bookId = row.find("#Edit_bookId").text();
            var view_bookName = row.find("#Edit_bookName").text(); 
            var view_publisher = row.find("#Edit_publisher").text();
            var view_category = row.find("#Edit_category").text();
            var view_discription = row.find("#Edit_discription").text();
            var view_quentity = row.find("#Edit_quentity").text(); 
        
            document.getElementById("p_bookId").value = view_bookId;
            document.getElementById("txtDeleteBookName").value = view_bookName;
            document.getElementById("txtDeletePublisher").value = view_publisher;
            document.getElementById("txtDeleteCategory").text = view_category;
            document.getElementById("txtDeleteBookDiscription").value = view_discription;
            document.getElementById("txtDeleteQuentity").value = view_quentity;
        });
        //edit book
        $("#btnUpdateBook").click(function(event){
            event.preventDefault();
            var edit_bookId = $("#p_bookId").val();
            var edit_bookName = $("#txtDeleteBookName").val();
            var edit_publisher = $("#txtDeletePublisher").val();
            var edit_category = $("#txtDeleteCategory").val();
            var edit_discription = $("#txtDeleteBookDiscription").val();
            var edit_quentity = $("#txtDeleteQuentity").val();
            var edit_edit = $("#btnUpdateBook").val();

            $("#update_status_msg").load("admin_updateBooks.php",{
                edit_bookId:edit_bookId,
                edit_bookName:edit_bookName,
                edit_publisher:edit_publisher,
                edit_category:edit_category,
                edit_discription:edit_discription,
                edit_quentity:edit_quentity,
                edit_edit:edit_edit
            });
        });
        //delete book
        $("#btnDelateBook").click(function(event){
            event.preventDefault();
            var delete_bookId = $("#p_bookId").val();
            var delete_bookName = $("#txtDeleteBookName").val();
            var delete_publisher = $("#txtDeletePublisher").val();
            var delete_category = $("#txtDeleteCategory").val();
            var delete_discription = $("#txtDeleteBookDiscription").val();
            var delete_quentity = $("#txtDeleteQuentity").val();
            var delete_edit = $("#btnDelateBook").val();

            $("#update_status_msg").load("admin_deleteBook.php",{
                delete_bookId:delete_bookId,
                delete_bookName:delete_bookName,
                delete_publisher:delete_publisher,
                delete_category:delete_category,
                delete_discription:delete_discription,
                delete_quentity:delete_quentity,
                delete_edit:delete_edit
            });
        });
        //add new book
        $("#frmAddBook").submit(function(event){
            event.preventDefault();
            var bookName = $("#txtAddBookName").val();
            var publisher = $("#txtAddPublisher").val();
            var category = $("#txtCategory").val();
            var discription = $("#txtAddBookDiscription").val();
            var quentity = $("#txtAddQuentity").val();
            var add = $("#btnAddBook").val();

            $("#status_msg").load("admin_addBooks.php",{
                bookName:bookName,
                publisher:publisher,
                category:category,
                discription:discription,
                quentity:quentity,
                add:add
            });
        });
        //search book
        $("#frmAdminSearchBook").submit(function(event){
            event.preventDefault();
            var search_bookName = $("#txtSearchBook").val();
            var searchBook = $("#btnSearchBook").val();

            $("#divSearchBookDetails").load("admin_searchBookDetails.php",{
                search_bookName:search_bookName,
                searchBook:searchBook
            });
        });
    });
</script>
<?php mysqli_close($connection); ?>