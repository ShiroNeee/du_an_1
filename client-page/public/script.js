let currentIndex = 0;
const slides = document.querySelectorAll(".slide");
const totalSlides = slides.length;

const updateSlides = (index) => {
    slides[currentIndex].classList.remove("active");
    currentIndex = index;
    slides[currentIndex].classList.add("active");
};

document.querySelector(".next").addEventListener("click", () => {
    updateSlides((currentIndex + 1) % totalSlides);
});

document.querySelector(".prev").addEventListener("click", () => {
    updateSlides((currentIndex - 1 + totalSlides) % totalSlides);
});

