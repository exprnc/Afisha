var prevTopSlide = document.querySelector('.prev-top-slide');
var nextTopSlide = document.querySelector('.next-top-slide');
var topSliderLine = document.querySelector('.top-slider-line');
let topOffset = 0;

nextTopSlide.addEventListener('click', function () {
    topOffset += 370;
    if (topOffset > 2640) topOffset = 0;
    topSliderLine.style.left = -topOffset + 'px';
});

prevTopSlide.addEventListener('click', function () {
    topOffset -= 370;
    if (topOffset < 0) topOffset = 2600;
    topSliderLine.style.left = -topOffset + 'px';
});