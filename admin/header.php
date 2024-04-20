<?php 
session_start();
if(!isset($_SESSION['fullname'])){
    echo '<script> window.location="../login.php";</script>';
    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../tailwind.css">
</head>

<body>
    <div class="flex">
        <div class="w-56 h-screen bg-gray-200 shadow-md">
            <img src="https://th.bing.com/th/id/OIP.63KYOdyuObTMjkNl6gF9LgHaHa?rs=1&pid=ImgDetMain" class="w-10/12 bg-white px-4 py-2 mt-5 mx-auto rounded-lg" alt="">

            <div class="mt-5">
                <P>Hello, <?php echo $_SESSION['fullname']; ?></p>
                <a href="dashboard.php" class="text-lg block p-2 my-2 hover:bg-gray-300">Dashboard</a>
                <a href="category.php" class="text-lg block p-2 my-2 hover:bg-gray-300">Category</a>
                <a href="news.php" class="text-lg block p-2 my-2 hover:bg-gray-300">News</a>
                <a href="logout.php" class="text-lg block p-2 my-2 hover:bg-gray-300">Logout</a>
            </div>
        </div>
        <div class="p-4 flex-1">