$(document).ready(() => {
    $("#edit").click(() => {
        var form = document.getElementById("editForm");

        if(form.checkValidity()) {
            $(".profile").slideDown("slow");
            $(".edit-box").slideUp("slow");
        }
    });

    $("#cancel").click(() => {
        $(".profile").slideDown("slow");
        $(".edit-box").slideUp("slow");
    })
    
    $("#editProfile").click(() => {
        $(".profile").slideUp("slow");
        $(".edit-box").slideDown("slow");
    });
});