<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="m-0">
    <div class="relative text-center bg-gradient-to-r from-[#A31621] to-[#db1b2b] text-white">
        <div class="flex flex-col items-center justify-center h-[65vh]">
            <img src="images/codex-white.png" alt="logo.png">
            <h1 class="font-semibold tracking-wider text-4xl animate-stretch">CodeX Bites</h1>
        </div>

        <div class="relative w-full h-[15vh]">
            <svg class="absolute bottom-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28"
                preserveAspectRatio="none">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="animate-[move-forever_25s_cubic-bezier(0.55,0.5,0.45,0.5)_infinite]">
                    <use href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                    <use href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
    </div>

    <div class="flex items-center justify-center h-[20vh] bg-white">
        <p class="text-gray-700 text-sm">COdeX | Rizky Maulana</p>
    </div>

    <style>
        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }

            100% {
                transform: translate3d(85px, 0, 0);
            }
        }

        @keyframes stretch {
            0% {
                transform: scaleX(1);
            }

            50% {
                transform: scaleX(1.2);
            }

            /* Meregang secara horizontal */
            100% {
                transform: scaleX(1);
            }
        }

        .animate-stretch {
            display: inline-block;
            animation: stretch 1s infinite ease-in-out;
        }
    </style>

    <script>
        setTimeout(() => {
            window.location.href = "/home";
        }, 2000);
    </script>

</body>

</html>
