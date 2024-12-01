let currentIndex = 0;

function showSlide(index) {
    const slides = document.querySelector('.slides');
    const totalSlides = slides.children.length;
    if (index >= totalSlides) currentIndex = 0;
    if (index < 0) currentIndex = totalSlides - 1;
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
}

document.querySelector('.prev').addEventListener('click', () => {
    currentIndex--;
    showSlide(currentIndex);
});

document.querySelector('.next').addEventListener('click', () => {
    currentIndex++;
    showSlide(currentIndex);
});

// Auto-slide every 5 seconds
setInterval(() => {
    currentIndex++;
    showSlide(currentIndex);
}, 5000);
