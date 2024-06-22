<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            height: 80%;
            max-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #reader {
            width: 100%;
        }
    </style>
</head>
<body>
<button class="btn" onclick="openModal()"><span>Search with QR</span></button>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="reader"></div>
    </div>
</div>

<!-- Include the html5-qrcode library -->
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>

<script>
    let html5QrCode;

    function openModal() {
        const modal = document.getElementById('myModal');
        modal.style.display = "block";
        startScan();
    }

    function closeModal() {
        const modal = document.getElementById('myModal');
        modal.style.display = "none";
        stopScan();
    }

    function startScan() {
        html5QrCode = new Html5Qrcode("reader");

        Html5Qrcode.getCameras().then(cameras => {
            if (cameras && cameras.length) {
                // Try to find the back camera
                let backCamera = cameras.find(camera => camera.label.toLowerCase().includes('back') || camera.label.toLowerCase().includes('rear'));
                const cameraId = backCamera ? backCamera.id : cameras[0].id;

                html5QrCode.start(
                    cameraId,
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
                    qrCodeMessage => {
                        if (isValidUrl(qrCodeMessage)) {
                            window.location.href = qrCodeMessage;
                        } else {
                            alert(`QR Code detected: ${qrCodeMessage}`);
                        }
                        stopScan();
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

    function stopScan() {
        if (html5QrCode) {
            html5QrCode.stop().then(ignore => {
                // QR Code scanning is stopped.
            }).catch(err => {
                console.error("Failed to stop QR Code scanning.", err);
            });
        }
    }

    // Function to validate URL
    function isValidUrl(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    }

    // Close the modal when the user clicks on <span> (x)
    document.getElementsByClassName('close')[0].onclick = function() {
        closeModal();
    }

    // Close the modal when the user clicks anywhere outside of the modal
    window.onclick = function(event) {
        const modal = document.getElementById('myModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
</body>
</html>
