<?php
if(isset($_POST['store']))
{
    $category_id = $_POST['category_id'];
    $news_date = $_POST['news_date'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    

    //for file store
    $filename = $_FILES['photopath']['name'];
    $tmpname = $_FILES['photopath']['tmp_name'];
    $filename = time().'_'.$filename;
    $photopath = "uploads/".$filename;

    //move the file to our location
    move_uploaded_file($tmpname,$photopath);

    $qry = "INSERT INTO news(title,description,news_date,photopath,category_id) VALUES ('$title','$description','$news_date','$filename',$category_id)";

    include('../includes/dbconnection.php');
    $res = mysqli_query($con,$qry);
    include('../includes/closeconnection.php');

    if($res)
    {
        echo "<script>alert('News Created Successfully');
        window.location.href='news.php';</script>";
    }
    else
    {
        echo "<script>alert('Something Went Wrong');
        history.back();</script>";
    }

}
//delete news


if(isset($_GET['deleteid']))
{
    $newid = $_GET['deleteid'];
    $qry = "SELECT * FROM news WHERE id=$newid";
    include('../includes/dbconnection.php');
    $result = mysqli_query($con,$qry);
    
    $row = mysqli_fetch_assoc($result);
    $filename = $row['photopath'];
    //delete file
    unlink("uploads/".$filename);
    $qry = "DELETE FROM news WHERE id=$newid";
    
    $res = mysqli_query($con,$qry);
    include('../includes/closeconnection.php');

    if($res)
    {
        echo "<script>alert('News Deleted Successfully');
        window.location.href='news.php';</script>";
    }
    else
    {
        echo "<script>alert('Something Went Wrong');
        history.back();</script>";
    }
}


// update 


include('../includes/dbconnection.php');

if (isset($_POST['update'])) {
    $newsid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;

    // If the newsid is not valid, redirect or show an error message
    if ($newsid <= 0) {
        header('Location: news.php'); // Redirect to news.php or display an error message
        exit();
    }

    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $news_date = mysqli_real_escape_string($con, $_POST['news_date']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
   $filename = mysqli_real_escape_string($con, $_POST['oldpath']);
   $filenames = mysqli_real_escape_string($con, $_FILES['photopath']['name']);
   if($_FILES['photopath']['name'] != '')
   {

       //for file store
       $filename = $_FILES['photopath']['name'];
       $tmpname = $_FILES['photopath']['tmp_name'];
       $filename = time().'_'.$filename;
       $photopath = "uploads/".$filename;
   
    //    remove old photo
    unlink("uploads/".$_POST['oldpath']);

       //move the file to our location
       move_uploaded_file($tmpname,$photopath);
             
   }

    $updateQuery = "UPDATE news SET category_id='$category_id', news_date='$news_date', title='$title', description='$description', photopath='$filename' WHERE id=$newsid";

    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        // Successful update
        header('Location: news.php');
        exit;
    } else {
        // Error handling, redirect or display an error message
        echo "Error updating news: " . mysqli_error($con);
    }
}

// Close the database connection
include('../includes/closeconnection.php');

function handleFileUpload($file)
{
    // Your file upload handling logic here, similar to the uploadFunction examples
    // ...

    return $uploadedFilePath; // Return the path to the uploaded file
}


?>

