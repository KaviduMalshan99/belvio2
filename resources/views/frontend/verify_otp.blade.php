@extends('frontend.master', ['hideHeader' => true, 'hideFooter' => true])

@section('content')
<style>
    /* Center the form on the page */
    .form-card {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* Make sure the body takes the full viewport height */
        margin: 0;
        /* Remove default body margin */
        background-color: #000;
        /* Optional background color for contrast */
    }

    .form {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-around;
        height: 30vw;
        width: 100vh;
        background-color: white;
        border-radius: 12px;
        padding: 20px;

        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Optional shadow for better aesthetics */

    }

    .title {
        font-size: 2em;
        font-weight: bold;
        color: black;
    }

    .message {
        color: #a3a3a3;
        font-size: 1.1em;
        margin-top: 4px;
        text-align: center;
    }


    .inputs {       

        margin-top: 10px;
    }

    .inputs input {
        width: 64px;
        height: 64px;
        text-align: center;
        color: #000;
        font-size: 1.5em;
        border: none;
        border-bottom: 1.5px solid #d2d2d2;
        margin: 0 10px;
    }

    .inputs input:focus {
        border-bottom: 1.5px solid royalblue;
        outline: none;
    }

    .action {
        margin-top: 24px;
        padding: 12px 16px;
        border-radius: 8px;
        border: none;
        background-color: royalblue;
        color: white;
        cursor: pointer;
        align-self: end;
    }

    /* Responsive Design */
    @media (max-width: 1440px) {
        .form {
            width: 150vh;
            height: 35vw;
        }

        .title {
            font-size: 2.5em;
        }

        .message {
            font-size: 1.1em;
        }

        .inputs input {
            width: 56px;
            height: 56px;
        }
    }

    @media (max-width: 1024px) {
        .form {
            width: 150vh;
            height: 35vw;
        }

        .message {
            font-size: 1em;
        }

        .inputs input {
            width: 56px;
            height: 56px;
        }
    }

    @media (max-width: 768px) {
        .form {
            width: 100vh;
            height: auto;
            padding: 16px;
        }

        .title {
            font-size: 1.5em;
        }

        .message {
            font-size: 0.6em;
        }

        .inputs input {
            width: 48px;
            height: 48px;
            margin: 0 8px;
        }
    }

    @media (max-width: 480px) {
        .form {
            width: 90%;
            height: auto;
        }

        .title {
            font-size: 1.5em;
        }

        .message {
            font-size: 1em;
        }

        .inputs input {
            width: 40px;
            height: 40px;
            margin: 0 5px;
        }

        .action {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="form-card">
    <div class="form">
        <div>
            <svg class="check" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" xml:space="preserve">
                <image id="image0" width="60" height="60" x="0" y="0" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAQAAACQ9RH5AAAABGdBTUEAALGPC/xhBQAAACBjSFJN
AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
cwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0NDzN/r+StAAACR0lEQVRYw+3Yy2sTURTH8W+bNgVf
aGhFaxNiAoJou3FVEUQE1yL031BEROjCnf4PLlxILZSGYncuiiC48AEKxghaNGiliAojiBWZNnNd
xDza3pl77jyCyPzO8ubcT85wmUkG0qT539In+MwgoxQoUqDAKDn2kSNLlp3AGi4uDt9xWOUTK3xg
hVU2wsIZSkxwnHHGKZOxHKfBe6rUqFGlTkPaVmKGn6iYao1ZyhK2zJfY0FZ9ldBzsbMKxZwZjn/e
5szGw6UsD5I0W6T+hBhjUjiF7bNInjz37Ruj3igGABjbtpIo3GIh30u4ww5wr3fwfJvNcFeznhBs
YgXw70TYX2bY/ulkZhWfzfBbTdtrzjPFsvFI+T/L35jhp5q2owDs51VIVvHYDM9sa/LY8XdtKy1l
FXfM8FVN2/X2ajctZxVXzPA5TZvHpfb6CFXxkerUWTOcY11LX9w0tc20inX2mmF4qG3upnNWrOKB
hIXLPu3dF1x+kRWq6ysHpkjDl+7eQjatYoOCDIZF3006U0unVSxIWTgTsI3HNP3soSJkFaflMDwL
3OoHrph9YsPCJJ5466DyOGUHY3Epg2rWloUxnMjsNw7aw3AhMjwVhgW4HYm9FZaFQZ/bp6QeMRQe
hhHehWKXGY7CAuSpW7MfKUZlAUqWdJ3DcbAAB3guZl9yKC4WYLfmT4muFtgVJwvQx7T2t0mnXK6J
XlGGyAQvfNkaJ5JBmxnipubJ5HKDbJJsM0eY38QucSx5tJWTVHBwqDDZOzRNmn87fwDoyM4J2hRz
NgAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMy0wMi0xM1QxMzoxNTo1MCswMDowMKC8JaoAAAAldEVY
dGRhdGU6bW9kaWZ5ADIwMjMtMDItMTNUMTM6MTU6NTArMDA6MDDR4Z0WAAAAKHRFWHRkYXRlOnRp
bWVzdGFtcAAyMDIzLTAyLTEzVDEzOjE1OjUxKzAwOjAwIIO3fQAAAABJRU5ErkJggg=="></image>
            </svg>
        </div>
        <div class="title">OTP Verification Code</div>
        <p class="message">We have sent a verification code to your mobile number</p>
        <label class="mobile_no" id="mobile-no"></label>
        <form class="form" method="POST" action="{{route('verify_otp')}}" id=otp-form>
            @csrf

        <div class="inputs">
            <input id="input1" type="text" maxlength="1" name="n_1" required>
            <input id="input2" type="text" maxlength="1" name="n_2" required>
            <input id="input3" type="text" maxlength="1" name="n_3" required>
            <input id="input4" type="text" maxlength="1" name="n_4" required>
            <input id="input5" type="text" maxlength="1" name="n_5" required>
            <input id="input6" type="text" maxlength="1" name="n_6" required>
        </div>

        <button type="submit" class="action">Verify</button>

        </form>
    </div>
</div>

<script>

    // Get the phone number passed from the controller

    const mobileNo = @json($phoneNumber);

    // Function to hide middle digits of mobile number
    function hideMiddleDigits(mobile) {
        let newmobile = ""; // Initialize newmobile

        newmobile += mobile.slice(0, 4); //add first 4 digit


        for (let i = 4; i < mobile.length - 3; i++) {
            newmobile += "*"; // Append '*' to newmobile
        }



        //add last 3 digit

        newmobile += mobile.slice(-3);

        return newmobile;
    }

    // Format the mobile number and display it
    document.addEventListener('DOMContentLoaded', function() {
        const formattedMobileNo = hideMiddleDigits(mobileNo);
        document.getElementById('mobile-no').textContent = formattedMobileNo;
    });

</script>


    // Detect backward navigation
    window.addEventListener('popstate', function() {
        // Redirect to the logout route
        window.location.href = "{{ route('detect_backward') }}";
    });

    // Push state to history to track backward navigation
    window.addEventListener('load', function() {
        history.pushState(null, document.title, location.href);
    });
</script>



@endsection