<head>
    <style>
        section#alert {
            position: fixed;
            background-color: white;
            z-index: 3;
            top: 10em;
            --width: 25em;
            width: var(--width);
            left: calc(50% - var(--width)/2);
            padding: 2em;
            border-radius: .5em;
            /* animation: enter 0.2 ease; */
        }

        section#alert img {
            width: 10em;
            text-align: center;
            margin: auto;
        }

        /* @keyframes (Enter) {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        } */
    </style>
</head>

<main id="alertMain" style="display: none">
    <?php 
        include $_SESSION["backgroundDarker"];
    ?>
    
    <section id="alert">
        <div class="d-flex justify-content-center align-items-center mb-3">
            <img id="iconAlert" src="">
        </div>
        <p id="paraAlert" class="text-center"></p>
        <span class="d-flex justify-content-center gap-2">
            <button onclick="check(true)" class="btn btn-outline-success">Yes</button>
            <button onclick="check(false)" class="btn btn-outline-danger">No</button>
        </span>
    </section>
</main>

<script>
    function sweetAlert(para) {
        const errorIcon = "<?php echo $_SESSION["errorIcon"] ?>";
        const warningIcon = "<?php echo $_SESSION["warningIcon"] ?>";
        const successIcon = "<?php echo $_SESSION["successIcon"] ?>";

        const alert = document.getElementById("alertMain");
        const icon = document.getElementById("iconAlert");
        const msg = document.getElementById("paraAlert");

        alert.style.display = "block";

        if(para="warning") {
            icon.src = warningIcon;
            msg.innerHTML = "Are you sure";
        } else if(para="error") {
            icon.src = errorIcon;
            msg.innerHTML ="Ooops ... you make a mistake";
        } else{
            icon.src = successIcon;
            msg.innerHTML = "Good";
        }
    }

    function check(descision) {
        if(descision) {            
            let form = document.getElementsByTagName('form')[0];
            form.reset();
        }
        const alert = document.getElementById("alertMain");
        alert.style.display = "none";
    }
</script>