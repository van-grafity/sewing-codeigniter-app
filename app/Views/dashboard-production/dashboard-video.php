<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial;
            font-size: 17px;
        }

        #myVideo {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;

            /* Make video to at least 100% wide and tall 
            min-width: 100%;
            min-height: 100%;*/

            /* Setting width & height to auto prevents the browser from stretching or squishing the video */
            width: auto;
            height: auto;

            /* Center the video */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <video autoplay muted id="myVideo">
        <source src="<?= base_url(); ?>/assets/video/video1.mp4" type="video/mp4" />
        Your browser does not support the video tag.
    </video>
</body>

<script type='text/javascript'>
    var count = 1;
    var totalvideo = 2;
    var player = document.getElementById('myVideo');
    player.addEventListener('ended', videoHandler, false);

    function videoHandler(e) {
        if (!e) {
            e = window.event;
        }
        if (count <= totalvideo) {
            count++;
        } else {
            count = 1
        }
        player.src = "<?= base_url(); ?>/assets/video/video" + count + ".mp4";

    }
</script>

</html>