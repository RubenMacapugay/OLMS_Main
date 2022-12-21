<?php
$connection = mysqli_connect('localhost', 'root', '', 'olms_hfa');
?>
<!DOCTYPE html>
<html>

<head>
  <title>File Retrieve With PHP and MySql</title>
</head>

<body>
  <div>
    <label>File Retrieve With PHP and MySql</label>
  </div>
  <div>
    <table width="80%" border="1">
      <tr>
        <th colspan="4">your uploads...<label><a href="index.php">upload new files...</a></label></th>
      </tr>
      <tr>
        <td>File Name</td>
        <td>File</td>
      </tr>
      <?php
      $result = mysqli_query($connection, "SELECT * FROM module_tbl");
      ?>
      <?php
      $i = 0;
      while ($row = mysqli_fetch_array($result)) {
        if ($i % 2 == 0)
          $classname = "evenRow";
        else
          $classname = "oddRow";
      ?>

        <tr>
          <td><?php echo $row["module_name"]; ?></td>
          <td><a href="../upload/<?php echo $row['module_file'] ?>" target="_blank"><?php echo $row['module_name'] ?></a></td>
        </tr>
      <?php
        $i++;
      }
      ?>
    </table>

  </div>
</body>

</html>