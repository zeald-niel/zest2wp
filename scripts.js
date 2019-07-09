jQuery( function ($) {
    $("#form").on('submit',(function(e) {
        e.preventDefault();
        $(".spinner-border").css('display', 'inline-block');
        $("#download").hide();
        $.ajax({
            url: "uploads.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend : function()
            {
                $("#err").fadeOut();
            },
            success: function(data)
            {
                $(".spinner-border").hide();
                if(data=='invalid')
                {
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                }
                else
                {
                    // view download file.
                    $("#download").attr('href', data).show();
                    $("#err").html(data).show();
                    $("#form")[0].reset(); 
                }
            },
            error: function(e) 
            {
                $(".spinner-border").fadeOut();
                $("#err").html(e).fadeIn();
            }          
        });
    }));
});