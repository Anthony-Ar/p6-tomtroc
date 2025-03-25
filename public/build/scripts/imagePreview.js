const imageInput = document.getElementById(document.currentScript.dataset.input);
const preview = document.getElementById('preview');

imageInput.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
