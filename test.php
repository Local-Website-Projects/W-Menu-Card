<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <style>
        #reader {
            width: 300px;
            margin: auto;
        }
    </style>
</head>
<body>
<button class="btn" onclick="startScan()"><span>Search with QR</span></button>
<div id="reader"></div>

<!-- Include the html5-qrcode library -->
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>

<script>
    function startScan() {
        const html5QrCode = new Html5Qrcode("reader");

        Html5Qrcode.getCameras().then(cameras => {
            if (cameras && cameras.length) {
                const cameraId = cameras[0].id;

                html5QrCode.start(
                    cameraId,
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
                    qrCodeMessage => {
                        alert(`QR Code detected: ${qrCodeMessage}`);
                        html5QrCode.stop().then(ignore => {
                            // QR Code scanning is stopped.
                        }).catch(err => {
                            console.error("Failed to stop QR Code scanning.", err);
                        });
                    },
                    errorMessage => {
                        console.warn("QR Code scan failed.", errorMessage);
                    })
                    .catch(err => {
                        console.error("Failed to start QR Code scanning.", err);
                    });
            } else {
                alert("No cameras found. Please ensure your device has a camera and that it is working properly.");
            }
        }).catch(err => {
            console.error("Error in getting cameras.", err);
            alert("Error in accessing camera: " + (err.message || err));
        });
    }
</script>
</body>
</html>
