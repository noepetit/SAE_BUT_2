const scrollBtn = document.getElementById("scrollToTop");

function updateScrollButton() {
    if (window.scrollY > 200) {
        scrollBtn.classList.add("show");
    } else {
        scrollBtn.classList.remove("show");
    }
}

window.addEventListener("scroll", updateScrollButton);

scrollBtn.addEventListener("click", (event) => {
    event.preventDefault();

    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

updateScrollButton();