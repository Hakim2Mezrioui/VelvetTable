function commander(title, desc, price, id_menu, checkUser) {
    if(checkUser) {
        let titleTag = document.getElementsByName("title")[0];
        let descTag = document.getElementsByName("description")[0];
        let priceTag = document.getElementsByName("price")[0];
        let id_menuTag = document.getElementsByName("id_menu")[0];
    
        titleTag.innerHTML = title;
        descTag.innerHTML = desc;
        priceTag.innerHTML = "$" + price;
        id_menuTag.value = id_menu;

        $(document).ready(() => {
            $(".confirmation").fadeIn();
        });
    } else {
        Swal.fire({
                title: 'you must register first',
                text: 'to request our products',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Ok',
                cancelButtonText: 'Not now'
            }).then((result) => {
                // Perform an action based on the user's choice
                if (result.isConfirmed) {
                    // Code to execute if confirmed
                    window.location.href = '../logIn&signUp/login&signup.php';
                } else {
                    // Code to execute if cancelled
                }
            });
    }

}

function hideCommand() {
    $(document).ready(() => {
        $(".confirmation").fadeOut();
    });
}

function afficherCart(checkUser) {
    if(checkUser == "true") {
        $(document).ready(() => {
            $("#yourCart").fadeIn();
        });        
    } else {  
        Swal.fire({
                title: 'you must register first',
                text: 'to request our products',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ok',
                cancelButtonText: 'Not now'
            }).then((result) => {
                // Perform an action based on the user's choice
                if (result.isConfirmed) {
                    // Code to execute if confirmed
                    window.location.href = '../logIn&signUp/login&signup.php';
                } else {
                    // Code to execute if cancelled
                }
            });
    }
}

function hideCart() {    
    $(document).ready(() => {
        $("#yourCart").fadeOut();
    });
}

function incrementQuantity() {
    var quantityInput = document.getElementById('quantity');
    quantityInput.stepUp();
}

function decrementQuantity() {
    var quantityInput = document.getElementById('quantity');
    quantityInput.stepDown();
}

// function goToConfirm() {
//     window.location.href="http://localhost/hakim&salma/Hakim&Salma/src/payment/payment.php";
// }

$(document).ready(() => {
    $(".platEntree a").click(function () {
        $(".platEntree a").removeClass("active");
        $(this).addClass("active");

        var selectedFilter = $(this).data("filter");

        $(".food-item").fadeOut();

        $(selectedFilter).fadeIn();
    });
});
