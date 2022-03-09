$('#signUpModal').on('shown.bs.modal', function () {
    map.updateSize();   
});

$(document).ready(function(){
    $("#signUpForm").submit(function(e){
        $("#signUpForm").serializeArray();
        $.ajax({
            url: "",
        })
    })
});