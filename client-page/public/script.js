document.addEventListener("DOMContentLoaded", () => {
    let currentIndex = 0;
    const slides = document.querySelectorAll(".slide");
    const totalSlides = slides.length;

    const updateSlides = (index) => {
        slides[currentIndex].classList.remove("active");
        currentIndex = index;
        slides[currentIndex].classList.add("active");
    };

    const nextButton = document.querySelector(".next");
    const prevButton = document.querySelector(".prev");

    if (nextButton) {
        nextButton.addEventListener("click", () => {
            updateSlides((currentIndex + 1) % totalSlides);
        });
    }

    if (prevButton) {
        prevButton.addEventListener("click", () => {
            updateSlides((currentIndex - 1 + totalSlides) % totalSlides);
        });
    }
});
