<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
</head>

<body>
    <!-- javascript for handling date -->
    <!-- <script type="text/javascript">
        // Use of Date.now() method 
        let A = Date.now();

        let D = Date(Date.now());
        // Printing the number of millisecond elapsed
        console.log("The time elapsed in millisecond is: " + A);

        // Converting the number of millisecond
        // in date string
        A = D.toString()
        // Printing the current date
        console.log("The current date is: " + A)

        // Using Date() method
        // another method different from above.
        let E = Date();

        // Converting the number value to string
        a = E.toString()

        // Printing the current date
        console.log("The current date is: " + a)

        const date = new Date();
        console.log("hari ini:" + date);

        let now = new Date();
        // alert(now); // show current date/time

        console.log(now); // "17/06/2022"
    </script> -->

    <h2>Using JavaScript to resirect a webpage after 5 seconds </h2>
    <p id="result"></p>
    <button onclick="redirect()">Click to Redirect to Tutorials Point</button>
    <script>
        function redirect() {
            setTimeout(myURL, 5000);
            var result = document.getElementById("result");
            result.innerHTML = "<b> The page will redirect after delay of 5 seconds";
        }

        function myURL() {
            document.location.href = "http://localhost/sewing-app/public/dashboard-video";
        }
    </script>

    <p id="flashtext">JavScript setInterval Demo</p>
    <button onclick="start()">Start</button>
    <button onclick="stop()">Stop</button>

</body>

<script>
    let intervalID;

    function toggleShow() {
        let e = document.getElementById('flashtext');
        e.style.color = e.style.color == 'red' ? 'blue' : 'red';
    }

    function stop() {
        clearInterval(intervalID);
    }

    function start() {
        intervalID = setInterval(toggleShow, 5000);
    }
</script>

</html>