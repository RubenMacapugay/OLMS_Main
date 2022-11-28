<?php include('assets../header.view.php') ?>

    <!--Body content -->
    <div class="container-fluid " id="content">

        <div class="row overflow-hidden">

            <!-- Left Side Nav global-->
            <div class="col-md-2 " id="sideNav">
                <?php include('assets../sidebar.view.php') ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-8 py-4 main-content" id="subjectMainContent">

                <div class="custom-border">
                    <div class="card mb-2">
                        <div class="card-header text-center">
                            <h3>Announcement</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-header">Dear Charo,</p>
                            <p class="card-text text-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo
                                aperiam
                                distinctio eius quidem maiores, hic
                                tempore. Atque quaerat maiores quae at illo dolore in accusamus pariatur, mollitia nisi
                                eos blanditiis
                                deleniti harum neque incidunt debitis doloribus temporibus earum nostrum deserunt
                                impedit reiciendis
                                distinctio. Quibusdam fugiat culpa nostrum unde, qui dolores?</p>

                            <div class="text-closing d-flex flex-column align-items-end">
                                <p class="card-text text-remarks mb-0">I'm yours,</p>
                                <p class="card-text text-author">Admin Addones</p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header text-center">
                            <h3>Announcement</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-header">Dear Charo,</p>
                            <p class="card-text text-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo
                                aperiam
                                distinctio eius quidem maiores, hic
                                tempore. Atque quaerat maiores quae at illo dolore in accusamus pariatur, mollitia nisi
                                eos blanditiis
                                deleniti harum neque incidunt debitis doloribus temporibus earum nostrum deserunt
                                impedit reiciendis
                                distinctio. Quibusdam fugiat culpa nostrum unde, qui dolores?</p>

                            <div class="text-closing d-flex flex-column align-items-end">
                                <p class="card-text text-remarks mb-0">I'm yours,</p>
                                <p class="card-text text-author">Admin Addones</p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header text-center">
                            <h3>Announcement</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-header">Dear Charo,</p>
                            <p class="card-text text-body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo
                                aperiam
                                distinctio eius quidem maiores, hic
                                tempore. Atque quaerat maiores quae at illo dolore in accusamus pariatur, mollitia nisi
                                eos blanditiis
                                deleniti harum neque incidunt debitis doloribus temporibus earum nostrum deserunt
                                impedit reiciendis
                                distinctio. Quibusdam fugiat culpa nostrum unde, qui dolores?</p>

                            <div class="text-closing d-flex flex-column align-items-end">
                                <p class="card-text text-remarks mb-0">I'm yours,</p>
                                <p class="card-text text-author">Admin Addones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
    let btn2 = document.querySelector(".table-control-collapse");
    let customHideTable = document.querySelector(".section-table-content");
    customHideTable.classList.toggle("custom-hide");
    btn2.onclick = function() {
        customHideTable.classList.toggle("custom-hide");
    };
    </script>


</body>

</html>