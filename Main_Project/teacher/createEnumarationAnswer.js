$(document).ready(function() {
    // adding new row for answer
    $(".add_item_btn").click(function(e) {
        e.preventDefault();
        $("#show_item").prepend(`<div class="row append_item">
                                <div class="class col-md-4 mb-3">
                                    <!-- storing multiple data in single name -->
                                    <input type="text" name="answer_key[]" class="form-control"
                                        placeholder="Answer key" required>
                                </div>

                                <div class="col-md-2 mb-3 d-grid">
                                    <button class="btn btn-danger remove_item_btn">Remove</button>
                                </div>
                            </div>`);
    });

    // removing the selected row
    $(document).on('click', '.remove_item_btn', function(e){
        e.preventDefault();
        let row_item = $(this).parent().parent();
        $(row_item).remove();
    });

    // creating questions and answers
    $("#add_form").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'teacher.createEnumeration.inc.php',
            method: 'post',
            data: $(this).serialize(),
            success: function(response){
                //console.log(response);
                $("#nextEnumerationQuestionAnswerBtn").val('Next');
                $("#add_form")[0].reset();
                $(".append_item").remove();
                $("#show_alert").html(`<div class="alert alert-success" role="alert">${response}</div>`);
                location.reload();
            }
        });
    });

});