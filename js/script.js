$(function(){
    
    $(".navbar a, footer a").on("click", function(event){
        
        event.preventDefault();
        var hash = this.hash;
        
        $('body,html').animate({scrollTop: $(hash).offset().top}, 900, function(){window.location.hash = hash;})
        
    });
    
    $('#contact-form').submit(function(e){
        
       e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'contact.php',
            data: postdata,
            dataType: 'json',
            success: function(result) {
             
                if(result.isSuccess)
                {
                    $('p').remove('.thank-you');
                    $("#contact-form").append("<p class='thank-you'>Votre message à bien été envoyé. Merci de m'avoir contacté !</p>");
                    $("#contact-form")[0].reset();
                }
                else
                {
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#name + .comments").html(result.nameError);
                    $("#email + .comments").html(result.emailError);
                    $("#telephone + .comments").html(result.telephoneError);
                    $("#message + .comments").html(result.messageError);
                }
                
            }
            
        });
        
        
    });

    
    
})