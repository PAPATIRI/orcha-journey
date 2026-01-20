let items = document.querySelectorAll(".slider .item");
let prevButton = document.getElementById("prev");
let nextButton = document.getElementById("next");
let lastPosition = items.length - 1;
let firstPosition = 0;
let active = 0;

nextButton.onclick = () => {
    active++;
    setSlider();
};
prevButton.onclick = () => {
    active--;
    setSlider();
};

const setSlider = () => {
    const oldActive = document.querySelector(".slider .item.active");
    if (oldActive) oldActive.classList.remove("active");
    items[active].classList.add("active");

    nextButton.classList.remove("d-none");
    prevButton.classList.remove("d-none");
    if (active == lastPosition) nextButton.classList.add("d-none");
    if (active == firstPosition) prevButton.classList.add("d-none");
};

setSlider();

const setDiameter = () => {
    let slider = document.querySelector(".slider");
    let widthSlider = slider.offsetWidth;
    let heightSlider = slider.offsetHeight;

    let diameter = Math.sqrt(
        Math.pow(widthSlider, 2) + Math.pow(heightSlider, 2)
    );

    document.documentElement.style.setProperty("--diameter", diameter + "px");
};
setDiameter();
document.addEventListener("resize", setDiameter);
