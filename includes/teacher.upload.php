<?php
$connection = mysqli_connect('localhost', 'root', '', 'olms_hfa');
// include("dbh.inc.php");

// upload files
if(isset($_POST['btnUpload']))
{
    $name = $_POST['file_name'];
    $upload_files = $_FILES["file_upload"]['name'];

    

    if(file_exists("../upload/".$_FILES["file_upload"]["name"]))
    {
         $store = $_FILES["file_upload"]['name'];
         $_SESSION['status'] = "Files Already exists. '.$store.'";
         header('Location: ../Main_Project/teacher/teacher.subject.php');
    }
    else
    {
        $query = "INSERT INTO module_tbl (`module_name`,`module_file`) VALUES ('$name', '$upload_files')";
        $query_run = mysqli_query($connection, $query);
        
        $folder = "../upload/";

        if($query_run)
        {
            move_uploaded_file($_FILES["file_upload"]["tmp_name"], $folder.$_FILES["file_upload"]["name"]);
            $_SESSION['success'] = "File is Added";
            header('Location: ../Main_Project/teacher/teacher.subject.php');
        }
        else
        {
            $_SESSION['success'] = "File is Not Added";
            header('Location: ../Main_Project/teacher/teacher.subject.php');
        }
    }
}

if(isset($_POST['update_btn']))
{
    $file_edit_id = $_POST['file_edit_id'];
    $file_edit_name = $_POST['file_edit_name'];
    $file_edit_files = $_FILES["file_upload"]['name'];

    $file_query = "SELECT * FROM module_tbl WHERE module_id ='$file_edit_id'";
    $file_query_run = mysqli_query($connection, $file_query);
    foreach($file_query_run as $file_row)
    {
        // echo $file_row['file_upload'];
        if($file_edit_files == NULL)
        {
            // UPDATE WITH EXISTING FILE
            $file_data = $file_row['module_file'];
        }
        else
        {
            // UPDATE WITH NEW FILE AND DELETE WITH OLD FILE
            if($file_path = "../upload/".$file_row['module_file'])
            {
                unlink($file_path);
                $file_data = $file_edit_files;
            }
        }
    }
    
    $query = "UPDATE files SET module_name ='$file_edit_name', module_file = '$file_data' WHERE module_id = '$file_edit_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
        // echo $file_row['images'];
        if($file_edit_files == NULL)
        {
            // UPDATE WITH EXISTING FILE
            $_SESSION['success'] = "File is Update with exitisng file";
            header('Location: ../Main_Project/teacher/teacher.subject.php');
        }
        else
        {
            // UPDATE WITH NEW FILE AND DELETE WITH OLD FILE
            move_uploaded_file($_FILES["file_upload"]["tmp_name"], "../upload/".$_FILES["file_upload"]["name"]);
            $_SESSION['success'] = "File is Update";
            header('Location: ../Main_Project/teacher/teacher.subject.php');
        }

    }
    else
    {
        $_SESSION['success'] = "File is Not Update";
        header('Location: ../Main_Project/teacher/teacher.subject.php');
    }
}


// DELETING FILE
if(isset($_POST['delete_data_btn']))
{
    $delete_id = $_POST['delete_file_id'];
    
    $query = "DELETE FROM module_tbl WHERE id='$delete_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "File Data is Deleted";
        header("Location: ../Main_Project/teacher/teacher.subject.php");
    }
    else
    {
        $_SESSION['status'] = "File Data is Not Deleted";
        header("Location: ../Main_Project/teacher/teacher.subject.php");
    }
}
?>