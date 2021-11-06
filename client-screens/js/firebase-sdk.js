// Import the functions you need from the SDKs you need
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/9.3.0/firebase-app.js";
import {
    getAnalytics
} from "https://www.gstatic.com/firebasejs/9.3.0/firebase-analytics.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyDSWFNAkUOiTOQXjXnS313kONfg_w9-vPE",
    authDomain: "phpbtl.firebaseapp.com",
    projectId: "phpbtl",
    storageBucket: "phpbtl.appspot.com",
    messagingSenderId: "673120912066",
    appId: "1:673120912066:web:10549f1d99907409be315b",
    measurementId: "G-7X6LTD4GMG"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

// firebase.auth().languageCode = 'it';
// To apply the default browser preference instead of explicitly setting it.
firebase.auth().useDeviceLanguage();