// sidebar.view.php **Sidebar Responsive
let btn = document.querySelector("#sidenavBtn");
let sidenav = document.querySelector("#sideNav");
btn.onclick = function () {

    if (window.innerWidth < 768) {
        sidenav.classList.toggle("customActive");
    }
}


//subject.php **tabpane
/*
Navigating to task
button -> id="task-tab" 
data-bs-target="#task-tab-pane"
*/
// ***Not working navigating ng tabpane in subjects
const triggerHome = document.querySelector('#myTab button[data-bs-target="#module-tab-pane"]')
const triggerTask = document.querySelector('#myTab button[data-bs-target="#task-tab-pane"]')
const triggerExam = document.querySelector('#myTab button[data-bs-target="#exam-tab-pane"]')
const triggerFinished = document.querySelector('#myTab button[data-bs-target="#finished-tab-pane"]')
$("#examFirstBtn").click(function () {
    alert("Open Task pane");
    bootstrap.Tab.getInstance(document.querySelector('#myTab button[data-bs-target="#task-tab-pane"]')).show()

});
$("#examSecondBtn").click(function () {
    alert("Open finished pane");
    // bootstrap.Tab.getInstance(triggerFinished).show()

});

$("#taskLinkBtn").click(function () {
    //alert("Open exam pane");
    bootstrap.Tab.getInstance(triggerTask).show()

});


// student.profile.php
function openInfoPane(evt, cityName) { //change me
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// // Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();












































// const test = document.querySelector('#myTab button[data-bs-target="#task-tab-pane"]')




// const triggerEl = document.querySelector('#task-tab')
// $('#coolkid').click(function(){
//     alert('clicked');
//     bootstrap.Tab.getInstance(triggerEl).show()
// })

// // working task-tab-pane
// const trigerTab1 = document.querySelector('#myTab li button[data-bs-target="#module-tab-pane"]')
// $('#dumbass').click(function () {
//     alert("dumbass");
//     bootstrap.Tab.getInstance(trigerTab1).show()
// })

// const trigerTab2 = document.querySelector('#myTab li button[data-bs-target="#finished-tab-pane"]')
// $('#coolkid').click(function () {
//     alert("coolkid");
//     bootstrap.Tab.getInstance(trigerTab2).show()
// })

// const triggerFirstTabEl = document.querySelector('#myTab li:nth-child(3) button')
// bootstrap.Tab.getInstance(triggerFirstTabEl).show()
// $('#dumbass').click(function () {
//     alert('clicked');
//     bootstrap.Tab.getInstance(triggerTab).show()
// })