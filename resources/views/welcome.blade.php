<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                background: #fefefe;
                background-image: linear-gradient(to bottom left, #2a95bf, #e6da37, #eab676);
                font-family: Helvetica, Arial, sans-serif;
                min-height: 900px;
            }

            .flex-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 75px;
            }

            .passcode-area {
                margin-top: 50px;
                text-align: center;
            }

            .passcode-area > input {
                background-color: #fff;
                border: 2px solid #d6d6d6;
                border-radius: 4px;
                padding: 0;
                margin: 25px 6px 0;
                width: 65px;
                height: 65px;
                text-align: center;
                font-size: 32px;
                line-height: 1.29;
                text-transform: uppercase;
                background-clip: padding-box;
            }

            .passcode-area > input:nth-child(3) {
                margin-right: 25px;
            }

            .passcode-area > input:focus {
                -webkit-appearance: none;
                border: 2px solid skyblue;
                outline: 0;
                box-shadow: 0 0 3px rgba(131, 192, 253, 0.5);
            }

            #submitBtn {
                margin:20px;
                padding: 10px;
            }

            .note {
                margin-top: 13px;
                color: #8298a0;
            }

            .warning {
                color: red;
            }

            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="flex-box">
                <div class="passcode-area">
                    <input autofocus type="text" maxlength="1">
                    <input type="text" maxlength="1">
                    <input type="text" maxlength="1">
                    <input type="text" maxlength="1">
                    <input type="text" maxlength="1">
                    <input type="text" maxlength="1">

                    <label onclick="toggle()" title="show/hide">
                        <span>👁</span>
                    </label>
                </div>

                <button id="submitBtn" onclick="submitResult()">Submit</button>
                <span id="resultText"></span>
                <span class="note">Click on the input and using CMD + Delete to clear all the input</span>
            </div>
        </div>
    </body>
</html>
<script>
    const inputs = document.querySelectorAll('.passcode-area input');

    // Focus on the first input
    inputs[0].focus();

    // Listen input
    for (let elem of inputs) {
        elem.addEventListener('input', function() {
            const value = this.value;
            const nextElement = this.nextElementSibling;

            if (!value.match(/^\d+$/)) {
                elem.value = '';
                return;
            }

            if (value === '' || !nextElement) {
                return;
            }

            nextElement.focus();
        });
    }


    for (let elem of inputs) {
        elem.addEventListener('keydown', function(event) {

            // Detect Right Arrow Key
            if (event.keyCode === 39) {
                this.nextElementSibling.focus();
            }

            // Detect Left Arrow Key
            if (event.keyCode === 37) {
                this.previousElementSibling.focus();
            }

            // Detect Backspace Key
            if (event.keyCode === 8 && event.metaKey) {
                for (let innerElem of inputs) {
                    innerElem.value = '';
                }
                document.getElementById('resultText').innerHTML = '';
                inputs[0].focus();
            } else if (event.keyCode === 8) {
                if (elem.value === '') {
                    this.previousElementSibling.focus();
                    return;
                }
                elem.value = '';
            }
        });
    }

    function toggle() {
        for (let elem of inputs) {
            if (elem.type === "password") {
                elem.type = "text";
            } else {
                elem.type = "password";
            }
        }
    }

    function submitResult() {
        let result = '';
        for (let elem of inputs) {
            if (elem.value === '') {
                document.getElementById('resultText').innerHTML = 'You need to fill all the input';
                document.getElementById('resultText').className = 'warning';
                return;
            }
            result += elem.value;
        }

        document.getElementById('resultText').innerHTML = 'Your pin is ' + result;
        document.getElementById('resultText').className = '';
    }

</script>
