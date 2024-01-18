let offset = 0;
const sliderLine = document.querySelector('.slider-line');

document.addEventListener("DOMContentLoaded", function () {
    const interval = 7500;
    const slider = document.querySelector('.slider');

    function nextSlide() {
        offset += 960;
        if (offset > 3840) offset = 0;
        sliderLine.style.left = -offset + 'px';
    }

    var sliderInterval = setInterval(nextSlide, interval);

    slider.addEventListener('mouseenter', function () {
        clearInterval(sliderInterval);
    });

    slider.addEventListener('mouseleave', function () {
        sliderInterval = setInterval(nextSlide, interval);
    });
});

document.querySelector('.next-slide').addEventListener('click', function () {
    offset += 960;
    if (offset > 3840) offset = 0;
    sliderLine.style.left = -offset + 'px';
});

document.querySelector('.prev-slide').addEventListener('click', function () {
    offset -= 960;
    if (offset < 0) offset = 3840;
    sliderLine.style.left = -offset + 'px';
});