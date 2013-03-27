$(document).ready(function (){
    $("#preference_form").submit(function (){

        var form = $("#preference_form");
        form.find("p").remove();
        $.ajax({
            url: "process.php",
            beforeSend: function ( xhr ) {

            },
            type: 'POST',
            dataType:'json',
            data:form.serialize(),
            success: function (data){
                if (data.result=='fail')
                {
                    var error_text='';
                    if (data.reason =='empty')
                        error_text = 'Please choose at least one puzzle';

                    else
                        error_text = "unknow error";
                    $('<p></p>').addClass('msg error').text('Please choose at least one puzzle').width(250).appendTo(form);
                }
                else
                {
                   $('<p></p>').addClass('msg done').text('Your preference has been update').width(250).appendTo(form);
                }
            },
            error: function(xhr) {
                $('<p></p>').addClass('msg error').text('Something wrong with the server, try again later').width(250).appendTo(form);
            }
        })
        return false;
    });

});
