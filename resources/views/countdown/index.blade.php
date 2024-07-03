<!DOCTYPE html>
<html lang="en" oncontextmenu="return false;" onkeydown="return false;" ondragstart="return false;" onselectstart="return false;">
<head>
    <style>
        .countdown {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .countdown-timer {
            text-align: center;
            font-size: 3rem;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <x-header>{{ $title }}</x-header>
</head>

<body>
    <x-topbar></x-topbar>
    <div class="countdown">
        <div class="countdown-timer">
            <h1>Hasil akan diumumkan pada <br>{{ $targetDate }}</h1>
            <div id="timer">
                <div><span id="days"></span> Days</div>
                <div><span id="hours"></span> Hours</div>
                <div><span id="minutes"></span> Minutes</div>
                <div><span id="seconds"></span> Seconds</div>
            </div>
        </div>
    </div>
    

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>


    <script>
        function countdownTimer(targetDate) {
            const endDate = new Date(targetDate).getTime();
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = endDate - now;

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('days').innerText = days;
                document.getElementById('hours').innerText = hours;
                document.getElementById('minutes').innerText = minutes;
                document.getElementById('seconds').innerText = seconds;

                if (distance < 0) {
                    clearInterval(timer);
                    document.getElementById('timer').innerText = 'EXPIRED';
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            countdownTimer("{{ $targetDate }}");
        });
    </script>
</body>
</html>
