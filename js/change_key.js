$(document).ready(function (){
    $('#change').click(function () {
        var holder = $('#holder');
        holder.empty();
        $.ajax({
            url: "change_key.php",
            type: 'POST',
            data:{uid:$("#uid").val()},
            success: function (data){
            $('#private_key').val(data);
                var holder = $('#holder');
                $('<p>Your key has been successfully changed. <span style="color:red">Please remember to update it in headwinds2lib</span></p>').addClass('msg done').width(400).appendTo(holder);
            },
            error: function(xhr) {
                $('<p></p>').addClass('msg error').text('Something wrong with the server, try again later').width(250).appendTo(form);
            }
        })
    });
});