<div class="col-md-8 py-4 main-content" id="teacherProfile">
    <div class="card">
        <div class="img-section">
            <div class="profile-img-cont">
                <img class="profile-img ms-5" src="images/sins.jpg" alt="">
             
            </div>
            <div class="overlay-image" style="background-image:url(images/bg2.jpg);"></div>
        </div>

        <div class="card-body p-1">
            <div class="container-fluid">
                <div class="row profile-info ">

                    <!-- Main student information -->
                    <div class="profile-content d-flex justify-content-between align-items-center">
                        <div class="profile-header">
                        <!--  d-flex align-items-end-->
                            <div class=" mt-2">
                                <h3 class="mb-0" id="profile-name">Maralit III, Carlos Romulo P.</h3>
                                <p class="text-muted mb-0">HFA0001</p>
                            </div>
                            <p class="mb-0">Joined: October 14, 2022</p>
                            <p class="mb-0">It's me your Addoness</p>

                        </div>

                        <div class="profile-edit">
                            <a href="" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-8">
                                <!-- Tab header   -->
                                <div class="tab-header">
                                    <div class="active">
                                        Teacher Info
                                    </div>
                                    <div>
                                        Progress
                                    </div>
                                </div>
                                <div class="tab-indicator"></div>
                            </div>
                        </div>

                        <!-- Subject Content (tabpane body) -->
                        <div class="row mt-2">
                            <div class="tabs px-0">
                                <div class="tab-body">

                                    <!-- Subject Modules Tab -->
                                    <div class="active tab-content p-2">

                                        <!-- First Grading -->
                                        <div class="section-module mt-2 card ">
                                            <div class="card-header ">
                                                <p>Campus : STI College Lipa</p>
                                                <p>Teacher</p>
                                                <p>Teacher ID : 123456789</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Subject Task -->
                                    <div class="tab-content p-2">
                                        <!-- First Grading -->
                                        <div class="section-module mt-2 card ">
                                            <div class="card-header ">
                                                <p>Binobola pa...</p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>


    </div>
</div>

<script>
// Removing excess padding on text
const range = document.createRange();
const h3 = document.getElementById('profile-name');
const text = h3.childNodes[0];
range.setStartBefore(text);
range.setEndAfter(text);

const clientRect = range.getBoundingClientRect();
h3.style.width = `${clientRect.width}px`;

//Tab pane control
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
</script>