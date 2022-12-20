<?php include('assets../header.view.php') ?>

<!-- Add Announcement -->
<div class="modal fade" id="addAnouncement" tabindex="-1" aria-labelledby="addAnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="uploadModalLabel">Add Announcement</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/save_schedule.php" method="post" id="schedule-form">
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="description" class="control-label">Description</label>
                        <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="start_datetime" class="control-label">Start</label>
                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="end_datetime" class="control-label">End</label>
                        <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="btnUpload" class="btn btn-primary">Add</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

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
                <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#addAnouncement">Add Announcement</button>
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
            <?php include('assets/banner.view.php') ?>
        </div>

    </div>
</div>

<!-- Script Links Bootstrap/Jquery -->
<?php include('assets/scriptlink.view.php') ?>

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