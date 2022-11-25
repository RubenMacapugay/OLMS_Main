function fetchQuestioner(){
    var id = document.getElementById("questionList").value;
    $.ajax({
        url: "fetchQuestions.php",
        method: "POST",
        data: {
            x: id
        },
        dataType: "JSON",
        success: function (data) {
            document.getElementById("inputQuestionId").value = data.questionId;
            document.getElementById("inputQuestion").value = data.questionerName;

            // set the value for queston counter
            document.getElementById("updateQuestionLabel").innerHTML = data.questionerNumber; 
        }
    })
    $.ajax({
        url: "fetchAnswerKey.php",
        method: "POST",
        data: {
            x: id
        },
        dataType: "JSON",
        success: function (data) {
            document.getElementById("answerId").value = data.answerId;
            document.getElementById("answerSelector").value = data.answerKey;
        }
    })
    $.ajax({
        url: "fetchChoice.php",
        method: "POST",
        data: {
            x: id
        },
        dataType: "JSON",
        success: function (data) {
            document.getElementById("choiceA").value = data.choiceA;
            document.getElementById("choiceB").value = data.choiceB;
            document.getElementById("choiceC").value = data.choiceC;
            document.getElementById("choiceD").value = data.choiceD;

            document.getElementById("choiceAId").value = data.choiceAId;
            document.getElementById("choiceBId").value = data.choiceBId;
            document.getElementById("choiceCId").value = data.choiceCId;
            document.getElementById("choiceDId").value = data.choiceDId;

        }
    })

    document.getElementById('nextBtn').style.display = "none";
    document.getElementById('nextQuestionLabel').style.display = "none";
    
    document.getElementById('updateBtn').style.display = "inline-block";
    document.getElementById('questionLabel').style.display = "inline-block";
}

function fetchIdentification(){
    var id = document.getElementById("identificationSelect").value;
    $.ajax({
        url: "fetchQuestions.php",
        method: "POST",
        data: {
            x: id
        },
        dataType: "JSON",
        success: function (data) {
            document.getElementById("identificationInputQuestionId").value = data.questionId;
            document.getElementById("identificationInputQuestion").value = data.questionerName;
        }
    })
    $.ajax({
        url: "fetchAnswerKey.php",
        method: "POST",
        data: {
            x: id
        },
        dataType: "JSON", 
        success: function (data) {
            document.getElementById("identificationInputId").value = data.answerId;
            document.getElementById("identificationInputAnswer").value = data.answerKey;
        }
    })
    document.getElementById('nextBtn').style.display = "none";
    document.getElementById('updateBtn').style.display = "inline-block";
    

}

function fetchEnumiration(target){
    console.log(target.value);
    let selected = JSON.parse(target.value);
    console.log("taergasd");

    document.getElementById('nextEnumerationQuestionAnswerBtn').style.display = "none";
    document.getElementById('updateEnumerationQuestionAnswerBtn').style.display = "inline-block";
    // document.getElementById('question-input').value = selected.question_name;

    // $.ajax({
    //     url: "fetchAnswerKey.php",
    //     method: "POST",
    //     data: {
    //         x: selected.question_id
    //     },
    //     dataType: "JSON",
    //     success: function (data) {
    //         console.log(data);
    //         $("#show_item").prepend(`<div class="row append_item">
    //         <div class="class col-md-4 mb-3">
    //             <!-- storing multiple data in single name -->
    //             <input type="text" name="answer_key[]" class="form-control"
    //                 placeholder="Answer key" required value=${data.answerKey}>
    //         </div>

    //         <div class="col-md-2 mb-3 d-grid">
    //             <button class="btn btn-danger remove_item_btn">Remove</button>
    //         </div>
    //         </div>`);
    //     }
    // })

  


}

function fetchTrueOrFalse(){
    var id = document.getElementById("questionList").value;
    $.ajax({
        url: "fetchQuestions.php",
        method: "POST",
        data: {
            x: id
        },
        dataType: "JSON",
        success: function (data) {
            // set the value for queston counter
            document.getElementById("updateQuestionLabel").innerHTML = data.questionerNumber;
            
            document.getElementById("inputtrueOrFalseQuestionerId").value = data.questionId;
            document.getElementById("inputtrueOrFalseQuestioner").value = data.questionerName;
        }
    })

    $.ajax({
        url: "fetchAnswerKey.php",
        method: "POST",
        data: {
            x: id
        },
        dataType: "JSON",
        success: function (data) {
            

            // check if the retrieve data is true or false
            document.getElementById("submissionChoiceId").value = data.answerId;
            if(data.answerKey == "True"){
                document.getElementById("radioTrue").checked  = true;
            } else if(data.answerKey == "False"){
                document.getElementById("radioFalse").checked  = true;
            }
        }
    })

    document.getElementById('nextBtn').style.display = "none";
    document.getElementById('nextQuestionLabel').style.display = "none";
    
    document.getElementById('updateBtn').style.display = "inline-block";
    document.getElementById('questionLabel').style.display = "inline-block";
}