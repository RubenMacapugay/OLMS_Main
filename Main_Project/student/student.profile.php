<?php include('assets../header.view.php');

?>

    <!--Body content -->

    <div class="container-fluid " id="content">

        <div class="row overflow-hidden">

            <!-- Left Side Nav global-->
            <div class="col-md-2 " id="sideNav">
                <?php include('assets../sidebar.view.php') ?>
            </div>

            <!-- Main Content -->

            <!-- Working -->
            <?php include('assets/tester.view.php')?>
           


            <!-- Right Banner -->
            <div class="custom-border col-md-2 mt-4" id="rightBanner">
               <?php include('assets/banner.view.php')?>
            </div>

        </div>
    </div>





   <!-- Script Links Bootstrap/Jquery -->
   <?php include('assets/scriptlink.view.php')?>
    <!-- Javascrpit Files -->
    <script src="js/main.js"></script>
    <script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>
</body>

</html>