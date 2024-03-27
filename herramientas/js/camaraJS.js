document.addEventListener("DOMContentLoaded", function() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const startButton = document.getElementById('btnPrenderCamera');
    const stopButton = document.getElementById('btnApagarCamera');
    const captureButton = document.getElementById('capturar-btn');
    const constraints = {
        video: true
    };

    let stream;

    startButton.addEventListener('click', async () => {
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        video.srcObject = stream;
    });

    stopButton.addEventListener('click', () => {
        stream.getTracks().forEach(track => {
            track.stop();
        });
        video.srcObject = null;
    });

    captureButton.addEventListener('click', () => {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/png');
        saveImage(imageData);
    });

    function saveImage(imageData) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../controlador/fotosCtrl.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Imagen guardada correctamente.');
            } else {
                console.error('Error al guardar la imagen.');
            }
        };
        xhr.send('image=' + encodeURIComponent(imageData));
    }
});
