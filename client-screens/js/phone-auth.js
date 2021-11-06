// Sử dụng reCAPTCHA vô hình
// window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
//     'size': 'invisible',
//     'callback': (response) => {
//         // reCAPTCHA solved, allow signInWithPhoneNumber.
//         onSignInSubmit();
//     }
// });
const codeField = document.getElementById("");
const phoneNumberField = document.getElementById("login-form-username");
const signInButton = document.getElementById("sign-in-button");
window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
recaptchaVerifier.render().then((widgetId) => {
    window.recaptchaWidgetId = widgetId;
});
const recaptchaResponse = grecaptcha.getResponse(recaptchaWidgetId);
// OTP
// function getPhoneNumberFromUserInput() {
//     var phoneNumber = document.getElementById("login-form-username").value;
//     return phoneNumber;
// }
function sendVerificationCode() {
    const phoneNumber = phoneNumberField.value;
    const appVerifier = window.recaptchaVerifier;
    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        .then((confirmationResult) => {
            // window.confirmationResult = confirmationResult;
            const sendCodeId = confirmationResult.verificationId;
            signInButton.addEventListener('click', () => {
                signInWithPhone(sendCodeId)
            })
        }).catch((error) => {
            grecaptcha.reset(window.recaptchaWidgetId);
        });
}
function signInWithPhone(sendCodeId) {
    const code = codeField.value;
    var credential = firebase.auth.PhoneAuthProvider.credential(confirmationResult.verificationId, code);
    firebase.auth().signInWithCredential(credential);
}
// grecaptcha.reset(window.recaptchaWidgetId);
// // Or, if you haven't stored the widget ID:
// window.recaptchaVerifier
//     .render()
//     .then(function (widgetId) {
//         grecaptcha.reset(widgetId);
//     })


// // login with authen code
// const code = getCodeFromUserInput();
// confirmationResult.confirm(code).then((result) => {
//     // User signed in successfully.
//     const user = result.user;
//     // ...
// }).catch((error) => {
//     // User couldn't sign in (bad verification code?)
//     // ...
// });


// var credential = firebase.auth.PhoneAuthProvider.credential(confirmationResult.verificationId, code);
// firebase.auth().signInWithCredential(credential);