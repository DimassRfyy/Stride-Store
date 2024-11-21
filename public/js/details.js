const swiper = new Swiper('.swiper', {
    // Optional parameters
    slidesOffsetAfter: 16,
    slidesOffsetBefore: 16,
    slidesPerView: "auto",
    spaceBetween: 12,
    centerInsufficientSlides: true
});

const mainThumbnail = document.getElementById("main-thumbnail");
const imgSelectors = document.querySelectorAll(".thumbnail-selector");
imgSelectors.forEach(element => {
    element.addEventListener("click", () => {
        const imgElement = element.querySelector("img");
        if (imgElement) {
            mainThumbnail.src = imgElement.src;
        }
    });
});