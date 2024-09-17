let imgBox = document.getElementById("imgBox");
let qrImg = document.getElementById("qrImg");
let qrText = document.getElementById("qrText");
let aTagHref = document.getElementById("hrefImg");

function showErrorMessage(message) {
    const errorBox = document.getElementById("error-message-box");
    const errorMessage = document.getElementById("error-message-text");
    errorMessage.textContent = message;
    errorBox.style.display = "block";
    setTimeout(function () {
        hideErrorMessage()
    }, 4000);
}

function hideErrorMessage() {
    document.getElementById("error-message-box").style.display = "none";
}

function validateURLWithRegex(url) {
    const regex = /^(https?|ftp):\/\/[^\s/$.?#].\S*$/i;
    return regex.test(url);
}

function generateQR() {
    if (validateURLWithRegex(qrText.value)) {
        imgBox.classList.add("show-img");
        qrImg.alt = qrText.value;
        qrImg.title = qrText.value;
        let width = imgBox.offsetWidth;
        let height = imgBox.offsetHeight;
        qrImg.src = "https://api.qrserver.com/v1/create-qr-code/?size=" + width + "x" + height + "&data=" + qrText.value;
        aTagHref.href = qrText.value;
    } else {
        if (imgBox.classList.contains("show-img")) {
            imgBox.classList.remove("show-img");
        }
        showErrorMessage("Invalid URL. Please try again another URL.");
    }
}


