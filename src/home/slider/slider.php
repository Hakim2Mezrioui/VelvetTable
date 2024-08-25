<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php 
            include "./slider/slider.css";
        ?>
    </style>
     
    </head>
    <body>
        
        <section aria-label="Newest Photos">
            <div class="carousel" data-carousel>
                <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
                <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
                <ul data-slides>
                    <li class="slide" data-active>
                        <!-- <img height="500" src="../../assets/home_images/randy.jpg" alt="Nature Image #1"> -->
                        <div style="background: url('../../assets/home_images/randy.jpg'); background-size: cover; background-position: center; background-attachment: fixed;" class="imgSlider">
                                
                        </div>
                    </li>
                    <li class="slide">
                        <!-- <img height="500" src="../../assets/home_images/kiris.jpg" alt="Nature Image #2"> -->
                        <div style="background: url('../../assets/home_images/kiris.jpg'); background-size: cover; background-position: center; background-attachment: fixed;" class="imgSlider">

                        </div>
                    </li>
                    <li class="slide">
                        <!-- <img height="500" src="../../assets/home_images/jade.jpg" alt="Nature Image #3"> -->
                        <div style="background: url('../../assets/home_images/jade.jpg'); background-size: cover; background-position: center; background-attachment: fixed;" class="imgSlider">

                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <script src="./slider/slider.js"></script>

    </body>
</html>