function goToConfirm(event) {
    event.preventDefault();
    let form_reservation = document.getElementsByClassName("form-reservation")[0];
    let form_confirmation = document.getElementsByClassName("form-confirmation")[0];
    if(form_confirmation.classList.contains("hide")) {
        form_confirmation.classList.remove("hide");
        form_confirmation.classList.add("show");
    }else {
        form_confirmation.classList.remove("show");
        form_confirmation.classList.add("hide");
    }
    if(form_reservation.classList.contains("hide")) {
        form_reservation.classList.remove("hide");
        form_reservation.classList.add("show");
    }else {
        form_reservation.classList.remove("show");
        form_reservation.classList.add("hide");
    }
}