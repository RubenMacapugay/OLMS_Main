<?php include('assets../header.view.php') ?>


<link rel="stylesheet" href="../vendor/fullcalendar/lib/main.min.css">
<script src="../vendor/js/jquery-3.6.0.min.js"></script>
<script src="../vendor/js/bootstrap.min.js"></script>
<script src="../vendor/fullcalendar/lib/main.min.js"></script>
<style>
    :root {
        --bs-success-rgb: 71, 222, 152 !important;
    }

    html,
    body {
        height: 100%;
        width: 100%;
    }

    .btn-info.text-light:hover,
    .btn-info.text-light:focus {
        background: #000;
    }

    table,
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: #ededed !important;
        border-style: solid;
        border-width: 1px !important;
    }
</style>
<!--Body content -->
<div class="container-fluid " id="content">

    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets../sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 py-4 main-content" id="subjectMainContent">
            <div class="container" id="page-container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php 
$schedules = $conn->query("SELECT * FROM `schedule_list`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
?>

<!-- Script Links Bootstrap/Jquery -->
<?php include('assets/scriptlink.view.php') ?>

<!-- Javascrpit Files -->
<script src="js/main.js"></script>
<script src="../vendor/js/script.js"></script>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
</html>