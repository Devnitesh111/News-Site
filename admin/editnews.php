<?php
include('header.php');

// Ensure the 'id' parameter is set and is a valid integer
$newsid = (isset($_GET['id']) && is_numeric($_GET['id'])) ? intval($_GET['id']) : 0;

// If the newsid is not valid, redirect or show an error message
if ($newsid <= 0) {
    header('Location: news.php'); // Redirect to news.php or display an error message
    exit();
}

// Connect to the database
include('../includes/dbconnection.php');

// Select news based on the provided ID
$qry = "SELECT * FROM news WHERE id = $newsid";
$result = mysqli_query($con, $qry);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the news details
    $row = mysqli_fetch_assoc($result);

    // Select all categories for the dropdown
    $categoryQuery = "SELECT * FROM categories";
    $res = mysqli_query($con, $categoryQuery);
?>

    <h1 class="text-3xl font-bold">Edit News</h1>
    <hr class="h-1 bg-red-600">

    <form action="actionnews.php?id=<?php echo $newsid; ?>" method="POST" enctype="multipart/form-data">
        <select name="category_id" class="border p-2 rounded w-full my-2">
            <?php
            // Display categories in the dropdown
            while ($categoryRow = mysqli_fetch_assoc($res)) {
                $selected = ($categoryRow['id'] == $row['category_id']) ? 'selected' : '';
                echo "<option value='{$categoryRow['id']}' {$selected}>{$categoryRow['categoryname']}</option>";
            }
            ?>
        </select>
        <input type="date" class="border p-2 rounded w-full my-2" name="news_date" value="<?php echo $row['news_date']; ?>">
        <input type="text" class="border p-2 rounded w-full my-2" name="title" placeholder="News Title" value="<?php echo htmlspecialchars($row['title']); ?>">
        <input type="text" class="border p-2 rounded w-full my-2" name="description" placeholder="Enter Description" value="<?php echo htmlspecialchars($row['description']); ?>">
 
<input type="file" name="photopath" class="border p-2 rounded w-full my-2">
<input type="hidden" name="oldpath" value="<?php echo $row['photopath'];?>"> 

<!-- row -->

<div class="flex justify-center my-2">
            <input type="submit" name="update" class="bg-blue-600 text-white px-2 py-1 rounded" value="Update News">
            <a href="news.php" class="bg-red-600 text-white px-2 py-1 rounded ml-2">Cancel</a>
        </div>
    </form>

<?php
} else {
    echo "Error retrieving news details or news not found.";
}

// Close the database connection
include('../includes/closeconnection.php');

include('footer.php');
?>
