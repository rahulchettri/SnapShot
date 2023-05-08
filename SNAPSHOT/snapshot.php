<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>SnapShot!</title>
  </head>

<?php

require_once "config.php";


if(isset($_REQUEST['delete']))
{
$fileid = $_REQUEST['delete'];
$sql = "DELETE FROM FILE  where id=$fileid";
if ($link->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


}
  if (isset($_POST['upload'])){
  

  $filepath = "/snap/imageloc/" . $_FILES["uploadfile"]["name"];

$sql = "INSERT INTO FILE (filepath)
VALUES ('$filepath')";
if ($link->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$filepath = "/var/www/html/oarm/snap/imageloc/" . $_FILES["uploadfile"]["name"];
$link->close();
if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $filepath))  {
  echo '<script>alert("UPLOADED THE FILE")</script>';
  header('Location: snapshot.php');
  } else {
  echo '<script>alert("FAILED TO upload")</script>';
  }

  }

?>
  <body>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPLOAD FILE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form class="form-horizontal" action=""  autocomplete="off" method="POST" enctype="multipart/form-data">
      </div>
      <div class="modal-body">
        <div class="formgroup">
      <div class="col-md-8">
<label style="font-family: sans-serif;font-size: 10px;">FILE NAME*</label>
<input name="filename" type="text" value="" class="input form-control" id="filename"  placeholder="" required="true" aria-label="filename" aria-describedby="basic-addon1" />
</div>
      <div class="col-md-8">
<label style="font-family: sans-serif;font-size: 10px;">UPLOAD FILE *</label>
<div class="input-group">
<div class="custom-file">
<input type="file"  name="uploadfile"  required="true" class="custom-file-input" id="exampleInputFile" accept=".jpg">
<label class="custom-file-label" for="exampleInputFile"></label>
</div>
</div>
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="upload" value="UPLOAD" id="upload" class="btn btn-block btn-primary btn-small">UPLOAD</button>
      </div>
</form>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">VIEW/DELETE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <form class="form-horizontal" action=""  autocomplete="off" method="POST" enctype="multipart/form-data">
      </div>
      <div class="modal-body">
        <div class="formgroup">
     
      
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="upload" value="UPLOAD" id="upload" class="btn btn-block btn-primary">UPLOAD</button>
      </div>
</form>
    </div>
  </div>
</div>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">SNAPSHOT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
     
      
    </ul>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Upload Images
</button>

  </div>
</nav>
	
	
	
	 <div>
    <br></br>
<div class="row">
 <?php

header('Content-type: image/jpeg');
$sql = "SELECT filepath,id FROM FILE";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
 echo '
<div class="col-md-4">   
  
<img src="'. $row["filepath"].'"   alt="Girl in a jacket" width="250" height="200"/><br>
<a href = "'.$row["filepath"].'" onClick="doSomething">View</a>
<a href = "snapshot?delete='.$row["id"].'" >Delete</a>
</div>';
if($i%3==0){
echo '<br></br>';
}
 }

}


?>




</div>
</div>


	
  </body>
 
</html>
