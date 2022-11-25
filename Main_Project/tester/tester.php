<?php include('../student/assets/header.view.php') ?>

<!--Body content -->

<div class="container-fluid " id="content">

    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('../student/assets/sidebar.view.php') ?>
        </div>
        <div class="col-md-8">
            <div class="container-fluid">
                <form action="">
                    <select id="options">
                        <option value="" disabled selected>Select an option</option>
                        <option value="1">Assignment</option>
                        <option value="2">Activities</option>
                        <option value="3">Quizzes</option>
                        <option value="4">Major Examination</option>
                    </select>
    
                    <select id="choices">
                        <option value="" disabled selected>Please select an option</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Right Banner global-->
        <div class="col-md-2 py-4 " id="rightBanner">
            <?php include('../student/assets/banner.view.php') ?>
        </div>

    </div>
</div>


<!-- Javascrpit Files -->



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>


<!-- J-query -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/main.js"></script>

<script>
// Map your choices to your option value
var lookup = {
    '1': ['No subtask'],
    '2': ['Multiple Choice', 'Identification', 'Enumiration', 'Essay'],
    '3': ['Multiple Choice', 'Identification', 'Enumiration'],
    '4': ['Multiple Choice', 'Identification', 'Enumiration'],
};

// When an option is changed, search the above for matching choices
$('#options').on('change', function() {
    // Set selected option as variable
    var selectValue = $(this).val();

    // Empty the target field
    $('#choices').empty();

    // For each chocie in the selected option
    for (i = 0; i < lookup[selectValue].length; i++) {
        // Output choice in the target field
        $('#choices').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] +
            "</option>");
    }
});
</script>

</body>

</html>