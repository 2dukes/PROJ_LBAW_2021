// Upload Profile Picture

import { defaultProperties } from "./files/defaultProperties.js";
import { FileInput } from "./files/FileInput.js";

fileUploadListeners();

function fileUploadListeners() {
    let fileUploads = document.querySelectorAll('.file-input');
    fileUploads.forEach((fileUpload) => {
        fileUpload.addEventListener('click', fileUploadHandler);
    });

    let fileInputs = document.querySelectorAll("input[name='profileImage']");
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener('change', fileInputHandler);
    })
}

function fileUploadHandler(event) {
    let target = event.target;
    target.nextElementSibling.click();
}

function fileInputHandler(event) {
    let img = event.target.previousElementSibling;
    img.src = URL.createObjectURL(event.target.files[0]);
    img.onload = () => {
        URL.revokeObjectURL(img.src);
    }
}

// Display Progress Stepper after filling first form

document.querySelector('#first-step').addEventListener('click', function () {
    document.querySelector('div.progress').parentNode.classList.remove('d-none');
    document.getElementById('error-messages').classList.add('d-none');
});


new FileInput('profile-photo-input', 'profileImage', defaultProperties(['rounded-circle', 'file-input']));
