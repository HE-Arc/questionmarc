document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');

    if (imageInput) {
        imageInput.addEventListener('change', function(event) {
            const fileList = document.getElementById('file-list');
            fileList.innerHTML = '';
            if (event.target.files.length <= 1) {
                return;
            }
            for (let i = 0; i < event.target.files.length; i++) {
                const li = document.createElement('li');
                li.textContent = event.target.files[i].name;
                fileList.appendChild(li);
            }
        });
    }
});
