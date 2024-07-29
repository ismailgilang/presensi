var video = document.querySelector("#video-webcam");

        // minta izin user
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

        // jika user memberikan izin
        if (navigator.getUserMedia) {
            // jalankan fungsi handleVideo, dan videoError jika izin ditolak
            navigator.getUserMedia({
                video: true
            }, handleVideo, videoError);
        }

        // fungsi ini akan dieksekusi jika  izin telah diberikan
        function handleVideo(stream) {
            video.srcObject = stream;
        }

        // fungsi ini akan dieksekusi kalau user menolak izin
        function videoError(e) {
            // do something
            alert("Izinkan menggunakan webcam untuk demo!")
        }
        
        function takeSnapshot() {
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');
            var width = video.offsetWidth,
                height = video.offsetHeight;
            canvas.width = width;
            canvas.height = height;
            context.drawImage(video, 0, 0, width, height);
            var imageDataURL = canvas.toDataURL('image/jpeg', 0.5); // Menggunakan format JPEG dengan kualitas 50%
            var img = document.createElement('img');
            img.src = imageDataURL;
            var container = document.getElementById('imageContainer');
            container.innerHTML = '';
            container.appendChild(img);
            var imageInput = document.getElementById('imageInput');
            imageInput.value = imageDataURL;
        }
        