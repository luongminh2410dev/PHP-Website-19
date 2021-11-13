// // import {
// //     initializeApp
// // } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-app.js";
// // import {
// //     getAnalytics
// // } from "https://www.gstatic.com/firebasejs/9.4.0/firebase-analytics.js";
// // TODO: Add SDKs for Firebase products that you want to use
// // https://firebase.google.com/docs/web/setup#available-libraries

// // Your web app's Firebase configuration
// // For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyDSWFNAkUOiTOQXjXnS313kONfg_w9-vPE",
    authDomain: "phpbtl.firebaseapp.com",
    projectId: "phpbtl",
    storageBucket: "phpbtl.appspot.com",
    messagingSenderId: "673120912066",
    appId: "1:673120912066:web:38a7d6c758003d2bbe315b",
    measurementId: "G-0QTBMEVD6C"
};

// Initialize Firebase
// const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);
firebase.initializeApp(firebaseConfig);
firebase.analytics();

const btnGetToken = document.getElementById("get-otp-button");
const btnRegister = document.getElementById("register-button");
const username = document.getElementById("register-form-username");
const password = document.getElementById("register-form-password");
const fullname = document.getElementById("register-form-fullname");
const phoneNumber = document.getElementById("register-form-phonenumber");
const codeField = document.getElementById("register-form-otp-input");

btnGetToken.onclick = function () {
    const headerNumber = '+84';
    const sub_phoneNumber = headerNumber.concat(phoneNumber.value.slice(1));
    if (phoneNumber.value == '') {
        alert("Vui lòng nhập số điện thoại để lấy mã");
    }
    else if (phoneNumber.value.charAt(0) != '0' || phoneNumber.value.length < 10 || phoneNumber.value.length > 11) {
        alert('Số điện thoại không hợp lệ');
    }
    else {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'normal',
            'callback': function (response) {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                // ...
            },
            'expired-callback': function () {
                // Response expired. Ask user to solve reCAPTCHA again.
                // ...
            }
        });
        // recaptchaVerifier.render().then((widgetId) => {
        //     window.recaptchaWidgetId = widgetId;
        // });
        var cverify = window.recaptchaVerifier;

        firebase.auth().signInWithPhoneNumber(sub_phoneNumber, cverify)
            .then(function (response) {
                console.log(response);
                window.confirmationResult = response;
            }).catch(function (error) {
                console.log(error);
                grecaptcha.reset(window.recaptchaWidgetId);
                // Or, if you haven't stored the widget ID:
                window.recaptchaVerifier.render().then(function (widgetId) {
                    grecaptcha.reset(widgetId);
                })
            })
    }
}
btnRegister.onclick = function () {
    if (username.value == '' || password.value == '' || fullname.value == '' || phoneNumber.value == '') {
        alert("Vui lòng nhập đầy đủ thông tin");
    }
    else if (codeField.value == '') {
        alert('Bạn phải nhập mã OTP để xác thực số điện thoại')
    }
    else {
        confirmationResult.confirm(codeField.value)
            .then(function (response) {
                console.log(response)
                $.ajax({
                    type: "POST",
                    url: "./functions/handleRegister.php",
                    data: {
                        'username': username.value,
                        'password': password.value,
                        'fullname': fullname.value,
                        'phoneNumber': phoneNumber.value
                    }
                }).done(function (msg) {
                    alert(msg)
                    msg == 'Đăng ký thành công!' ? handleRedirectLogin() : null;
                });
            })
            .catch(function (error) {
                console.log(error);
                alert('Mã OTP không chính xác!')
            })
    }
}