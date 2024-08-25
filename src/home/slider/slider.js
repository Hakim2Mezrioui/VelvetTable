// const buttons = document.querySelectorAll("[data-carousel-button]");


// buttons.forEach(button => {
//   button.addEventListener("click", () => {
//     const offset = button.dataset.carouselButton === "next" ? 1 : -1;
//     const slides = button.closest("[data-carousel]").querySelector("[data-slides]");

//     const activeSlide = slides.querySelector("[data-active]");
//     let newIndex = [...slides.children].indexOf(activeSlide) + offset;
//     if (newIndex < 0) newIndex = slides.children.length - 1;
//     if (newIndex >= slides.children.length) newIndex = 0;

//     slides.children[newIndex].dataset.active = true;
//     delete activeSlide.dataset.active;
//   })
// });


// ------------------------------------------------------------

// Store the interval ID for later use
let intervalId;

// Function to move the carousel
const moveCarousel = (offset) => {
  const slides = document.querySelector("[data-carousel] [data-slides]");
  const activeSlide = slides.querySelector("[data-active]");

  let newIndex = [...slides.children].indexOf(activeSlide) - offset;
  if (newIndex < 0) newIndex = slides.children.length - 1;
  if (newIndex >= slides.children.length) newIndex = 0;

  slides.children[newIndex].dataset.active = true;
  delete activeSlide.dataset.active;
};

const startCarouselInterval = () => {
  intervalId = setInterval(() => {
    moveCarousel(1); 
  }, 3000); 
};


const stopCarouselInterval = () => {
  clearInterval(intervalId);
};


const handlePreviousButtonClick = () => {
  stopCarouselInterval(); 
  moveCarousel(-1);
  startCarouselInterval(); 
};


const handleNextButtonClick = () => {
  stopCarouselInterval();
  moveCarousel(1);
  startCarouselInterval(); 
};


const prevButton = document.querySelector("[data-carousel-button='prev']");
const nextButton = document.querySelector("[data-carousel-button='next']");
prevButton.addEventListener("click", handleNextButtonClick);
nextButton.addEventListener("click", handlePreviousButtonClick);


startCarouselInterval();
