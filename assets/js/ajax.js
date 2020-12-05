
$(document).ready(function(){
    // $('.add-info-btn').click(function(){

    //     var filedata = new FormData();
    //     var files = $('.file-side')[0].files[0];
    //     filedata.append('file',files);

    //     $.ajax({
    //         url: 'operation.php',
    //         type: 'POST',
    //         data: filedata,
    //         processData: false,
    //         contentType: false,
    //         success: function(data){
    //             alert(data);
    //         }
    //     });

    // });

     var url="http://localhost/file_system/phpfiles/operation.php";
    $('.change-name').click(function(){
        var rename=$("#rename").serialize();
        $.post(url,{rename_info:rename},function (data){
            //alert(data);
            if(data=='success'){
                //swal("Uğurlu", "Faylın adı dəyişdi.!", "success");
                $('.rename-popup-wrapper').fadeOut();
                $('#update_rename').html('<div class="alert alert-success">Faylın adı dəyişdi.</div>')
                setInterval(() => {
                    window.location.href="http://localhost/file_system/";
                }, 2000);

            }
            else if(data=='empty'){
                $('.rename-popup-wrapper').fadeOut();
                $('#update_rename').html('<div class="alert alert-warning">Fayl adını daxil etməlisiniz.</div>')
                setInterval(() => {
                    window.location.href="http://localhost/file_system/";
                }, 2000);
            }
            else if(data=='fail'){
                $('.rename-popup-wrapper').fadeOut();
                $('#update_rename').html('<div class="alert alert-warning">Fayl adını daxil etməlisiniz.</div>')
                setInterval(() => {
                    window.location.href="http://localhost/file_system/";
                }, 2000);
            }

        });
    });



});