(function($){

    $(document).ready(function(){

        $('input#student_photo').change(function(e){
           let file_url = URL.createObjectURL(e.target.files[0]);
           $('img#student_photo_load').attr('src', file_url);
        });

        $('table#table_student').DataTable();


        // Show Student All Data
        // function allStudent(){
        //     $.ajax({
        //         url : 'student-all',
        //         success : function(data){
        //             $('tbody#student_tbody').html(data);
        //         }
        //     });
        // }
        // allStudent();


        $(document).on('submit','form#add_student_form',function (e){
            e.preventDefault();

            let name = $('form#add_student_form input[name="name"]').val();
            let roll = $('form#add_student_form input[name="roll"]').val();
            let email = $('form#add_student_form input[name="email"]').val();
            let cell = $('form#add_student_form input[name="cell"]').val();

            if( name == '' || roll == '' || email == '' || cell == '' ) {
                $('.mess').html('<p class="alert alert-danger">All fields are required !<button class="close" data-dismiss="alert">&times;</button></p>');
            }else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email) == false) {
                $('.mess').html('<p class="alert alert-danger">Invalid E-Mail Address !<button class="close" data-dismiss="alert">&times;</button></p>');
            }else {

                $.ajax({
                    url : 'student-create',
                    method : 'POST',
                    data : new FormData(this),
                    contentType : false,
                    processData : false,
                    success: function (data){
                        $('.mess').html('<p class="alert alert-success">Student Added Successful !<button class="close" data-dismiss="alert">&times;</button></p>');
                        $('form#add_student_form')[0].reset();
                        $('img#student_photo_load').attr('src', '');
                    }
                });

            }
        });

    });


    // Update STudent Data Show
    $(document).on('click', 'a#edit_student', function (e){
        e.preventDefault();
        let id = $(this).attr('student_id');

        $.ajax({
            url : 'edit-Student/' + id,
            dataType : 'json',
            success : function (data){
                $('#edit_student_modal input[name="name"]').val(data.name);
                $('#edit_student_modal input[name="id"]').val(id);
                $('#edit_student_modal input[name="roll"]').val(data.roll);
                $('#edit_student_modal input[name="email"]').val(data.email);
                $('#edit_student_modal input[name="cell"]').val(data.cell);
                $('#edit_student_modal img').attr('src', 'media/students/'+data.photo);
            },
        });
    });

    // Student Data Update
    $(document).on('submit','form#edit_student_form', function (e){
        e.preventDefault();


        let name = $('form#edit_student_form input[name="name"]').val();
        let id = $('form#edit_student_form input[name="id"]').val();
        let roll = $('form#edit_student_form input[name="roll"]').val();
        let email = $('form#edit_student_form input[name="email"]').val();
        let cell = $('form#edit_student_form input[name="cell"]').val();


        if( name == '' || roll == '' || email == '' || cell == '' ){
            $('.mess').html('<p class="alert alert-danger">All fields are required !<button class="close" data-dismiss="alert">&times;</button></p>');
        }else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email) == false) {
            $('.mess').html('<p class="alert alert-danger">Invalid E-Mail Address !<button class="close" data-dismiss="alert">&times;</button></p>');
        }else {

            $.ajax({
                url : 'update-Student/' + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data){
                    $('.mess').html('<p class="alert alert-success">Update Data Successful !<button class="close" data-dismiss="alert">&times;</button></p>');
                },
            });

        }

    });

// Single Student show
    $(document).on('click', 'a#single_student', function (e){
        e.preventDefault();
        let id = $(this).attr('student_id');

        $.ajax({
            url : 'show-Student/' + id,
            dataType: 'json',
            success : function (data){
                $('#show_student_modal .single_name').html(data.name);
                $('#show_student_modal #t1').html(data.name);
                $('#show_student_modal #t2').html(data.roll);
                $('#show_student_modal #t3').html(data.email);
                $('#show_student_modal #t4').html(data.cell);
                $('#show_student_modal img#single_sut').attr('src', 'media/students/'+data.photo);
            }
        });
    });

    //Single Student Delete
    $(document).on('submit', 'form#single_student_delete', function (e){
        e.preventDefault();
        let id = $(this).attr('student_id');

        $.ajax({
            url : 'delete-Student/' + id,
            method : 'POST',
            data : new FormData(this),
            processData: false,
            contentType: false,
            success : function (data){
                $('.mess').html('<p class="alert alert-success">Delete Student Data Successful !<button class="close" data-dismiss="alert">&times;</button></p>');
            }
        });

    });

})(jQuery)
