document.addEventListener("DOMContentLoaded", function () {
    const textElement = document.getElementById("typing-text");
    const textToType = "Saya butuh bantuan pada fasilitas perangkat TIK di kampus";
    let textIndex = 0;

    function typeText() {
        if (textIndex < textToType.length) {
            textElement.textContent += textToType.charAt(textIndex);
            textIndex++;
            setTimeout(typeText, 100); // Kecepatan ketik (ms)
        }
    }

    typeText();
});