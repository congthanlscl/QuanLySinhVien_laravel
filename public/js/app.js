$(document).ready(function(){

    $(document).on("click", ".openbtn", function(e){


        if($("#menu-sidebar").hasClass("sidebar-show")){

            $("#menu-sidebar").removeClass("sidebar-show");
            $("#main").removeClass("main");
        }
        else{

            $("#menu-sidebar").addClass("sidebar-show");
            $("#main").addClass("main");
        }
    })

    $(document).on('click', '.btn-delete-item', function(){
        
        let url = $(this).attr("data-url");
        let _token = $("input[name='_token']").val();
        let confirm = $(this).attr("data-confirm");
        let redirect = $(this).attr("data-redirect");
        showConfirmMessage(confirm, function(){
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {_token:_token},
                dataType: "JSON",
            }).done(function( data ) {
                showSuccessAutoClose(data.txt, data.st);
                if(data.st == "success"){
                    setTimeout(function(){
                        window.location.href = redirect;
                    },2000);
                }
                
            });
        });
    });
})

showConfirmMessage = function($message, $function) {
    swal({
        title: "Bạn có chắc?",
        text: $message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $function();
        }
    });
}

showSuccessAutoClose = function($message, $label) {
    swal({
        title: $label,
        text: $message,
        icon: $label,
    });
}
