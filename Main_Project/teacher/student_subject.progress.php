<?php include('assets/header.view.php')?>

    <!--Body content -->

    <div class="container-fluid " id="content">

        <div class="row overflow-hidden">

            <!-- Left Side Nav global-->
            <div class="col-md-2 " id="sideNav">
                <?php include('assets/sidebar.view.php') ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-8 py-4 main-content" id="teacherSubjectContent">
                <div class="d-flex justify-content-between mx-3">
                    <div class="d-flex align-items-end">
                        <h3 class="mb-0">Subject Name</h3>
                        <p class="text-muted mb-0 ms-2">BSIT 4.1B</p>
                    </div>

                </div>
                <div class="card ">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-flex align-items-end">
                            <p class="mb-0">Maralit III, Carlos Romulo P.</p>
                        </div>
                        <div class="flex-right">
                            <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                            <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover px-4 section-table">
                            <thead class="">
                                <tr>
                                    <th scope="col">Task List</th>
                                    <th scope="col" class="text-center">Progress</th>
                                    <th scope="col" class="text-center">Duration</th>
                                    <th scope="col" class="text-center ">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="">01 Quiz 1</a></td>
                                    <td>10/30</td>
                                    <td>08/05/22 - 08/10/22</td>
                                    <td>Graded</td>
                                </tr>
                                <tr>
                                    <td><a href="">01 Assignment 1</a></td>
                                    <td>10/30</td>
                                    <td>08/05/22 - 08/10/22</td>
                                    <td class="">Late</td>
                                </tr>
                                <tr>
                                    <td><a href="">01 Project 1</a></td>
                                    <td>10/30</td>
                                    <td>08/05/22 - 08/10/22</td>
                                    <td>Finished</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

            <!-- Right Banner -->
            <div class="custom-border col-md-2 mt-4" id="rightBanner">
                <?php include('assets/banner.view.php')?>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <!-- J-query -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>


    <script>
    //Tabpane
    let tabHeader = document.getElementsByClassName("tab-header")[0];
    let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
    let tabBody = document.getElementsByClassName("tab-body")[0];

    let tabsPane = tabHeader.getElementsByTagName("div");

    for (let i = 0; i < tabsPane.length; i++) {
        tabsPane[i].addEventListener("click", function() {
            tabHeader.getElementsByClassName("active")[0].classList.remove("active");
            tabsPane[i].classList.add("active");
            tabBody.getElementsByClassName("active")[0].classList.remove("active");
            tabBody.getElementsByClassName("tab-content")[i].classList.add("active");

            tabIndicator.style.left = `calc(calc(100% / 4) * ${i})`;
        });
    }

    //Tester
    function showTab() {
        tabHeader.getElementsByClassName("active")[0].classList.remove("active");
        tabsPane[1].classList.add("active");
        tabBody.getElementsByClassName("active")[0].classList.remove("active");
        tabBody.getElementsByTagName("div")[1].classList.add("active");

        tabIndicator.style.left = `calc(calc(100% / 4) * ${1})`;
    }


    //Module collapse
    let hideContent = document.querySelectorAll("#teacherSubjectContent .content-collapse");
    let customHideTable = document.querySelectorAll(".section-table-content");

    for (let i = 0; i < hideContent.length; i++) {
        hideContent[i].addEventListener("click", function() {
            customHideTable[i].classList.toggle("custom-hide");
        });
    }

    //Change task type (modal - create_tas_modals.php)
    </script>

</body>

</html>