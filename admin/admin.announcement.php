<?php
include('security.php');
//session_start();

include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Add Announcement -->
<div class="modal fade" id="addAnouncement" tabindex="-1" aria-labelledby="addAnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="uploadModalLabel">Add Announcement</h1>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- <form action="../../includes/teacher.upload.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Announcement Name</label>
                        <input type="text" name="file_name" class="form-control" placeholder="Announcement Name" required>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="taskcontent" placeholder="Announcement..." id="floatingTextarea"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btnUpload" class="btn btn-primary">Upload</button>
                </div>
            </form> -->
            <form action="admin_save_schedule.php" method="post" id="schedule-form">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="btnUpload" class="btn btn-primary">Add</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!--DataTables Example-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <div class="p-2 flex-grow-1">
                    <div class="mt-3 font-weight-bold text-primary">
                        Student List
                    </div>
                </div>
                <div class="p-2">
                    <button class="btn btn-primary m-3" data-toggle="modal" data-target="#addAnouncement">Add Announcement</button>
                </div>
            </div>
        </div>
        <div class="card-body">
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

            </div>
        </div>
    </div>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>