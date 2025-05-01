// /js/productZoom.js
document.addEventListener("DOMContentLoaded", function () {
    const img = document.getElementById("zoom-image");
    const container = img?.closest(".zoom-container");

    if (!img || !container) return;

    container.addEventListener("mousemove", function (e) {
        const rect = container.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        img.style.transformOrigin = `${x}% ${y}%`;
        img.style.transform = "scale(2)";
    });

    container.addEventListener("mouseleave", function () {
        img.style.transform = "scale(1)";
        img.style.transformOrigin = "center center";
    });
});
