<?php
$connection = mysqli_connect('localhost', 'root', '', 'olms_hfa');

// upload files
if(isset($_POST['save_faculty']))
{
    $name = $_POST['faculty_name'];
    $designation = $_POST['faculty_designation'];
    $description = $_POST['faculty_description'];
    $images = $_FILES["Module_files"]['name'];

    

    if(file_exists("upload/".$_FILES["Module_files"]["name"]))
    {
         $store = $_FILES["Module_files"]['name'];
         $_SESSION['status'] = "Files Already exists. '.$store.'";
         header('Location: subject-content.php');
    }
    else
    {
        $query = "INSERT INTO files (`name`,`design`,`descrip`,`images`) VALUES ('$name', '$designation' , '$description', '$images')";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            move_uploaded_file($_FILES["Module_files"]["tmp_name"], "upload/".$_FILES["Module_files"]["name"]);
            $_SESSION['success'] = "File is Added";
            header('Location: subject-content.php');
        }
        else
        {
            $_SESSION['success'] = "File is Not Added";
            header('Location: subject-content.php');
        }
    }
}

if(isset($_POST['file_update_btn']))
{
    $file_edit_id = $_POST['file_edit_id'];
    $file_edit_name = $_POST['file_edit_name'];
    $file_edit_designation = $_POST['file_edit_designation'];
    $file_edit_description = $_POST['file_edit_description'];

    $file_edit_files = $_FILES["Module_files"]['name'];

    $file_query = "SELECT * FROM files WHERE id ='$file_edit_id'";
    $file_query_run = mysqli_query($connection, $file_query);
    foreach($file_query_run as $file_row)
    {
        // echo $file_row['images'];
        if($file_edit_files == NULL)
        {
            // UPDATE WITH EXISTING FILE
            $file_data = $file_row['images'];
        }
        else
        {
            // UPDATE WITH NEW FILE AND DELETE WITH OLD FILE
            if($file_path = "upload/".$file_row['images'])
            {
                unlink($file_path);
                $file_data = $file_edit_files;
            }
        }
    }
    
    $query = "UPDATE files SET name ='$file_edit_name', design = '$file_edit_designation', descrip = '$file_edit_description', images = '$file_data' WHERE id = '$file_edit_id'";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
        // echo $file_row['images'];
        if($file_edit_files == NULL)
        {
            // UPDATE WITH EXISTING FILE
            $_SESSION['success'] = "File is Update with exitisng file";
            header('Location: subject-content.php');
        }
        else
        {
            // UPDATE WITH NEW FILE AND DELETE WITH OLD FILE
            move_uploaded_file($_FILES["Module_files"]["tmp_name"], "upload/".$_FILES["Module_files"]["name"]);
            $_SESSION['success'] = "File is Update";
            header('Location: subject-content.php');
        }

    }
    else
    {
        $_SESSION['success'] = "File is Not Update";
        header('Location: subject-content.php');
    }
}


// DELETING FILE
if(isset($_POST['delete_data_btn']))
{
    $delete_id = $_POST['delete_file_id'];
    
    $query = "DELETE FROM files WHERE id='$delete_id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "File Data is Deleted";
        header("Location: subject-content.php");
    }
    else
    {
        $_SESSION['status'] = "File Data is Not Deleted";
        header("Location: subject-content.php");
    }
}
?>