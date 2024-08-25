$(document).ready(() => {
    $("#addMeal").click(()=> {
        $(".section-addMeal").fadeIn();;
    });

    $("#cancel").click(() => {
        $(".section-addMeal").fadeOut();
    });
});