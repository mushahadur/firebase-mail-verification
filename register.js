// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.12.5/firebase-auth.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCCbQ_JqGk88DDI1rG3l379_djP05c4hvQ",
  authDomain: "email-auth-500a9.firebaseapp.com",
  projectId: "email-auth-500a9",
  storageBucket: "email-auth-500a9.firebasestorage.app",
  messagingSenderId: "412003158891",
  appId: "1:412003158891:web:7922aa6e43594878711a2e",
  measurementId: "G-H7CD4TCTNW"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

const sendEmailBten = document.getElementById('send-magic-link');
sendEmailBten.addEventListener('click', () => {
   event.preventDefault();
   alert('Email sent');
});


// Generate Username
document.getElementById('generateUsername').addEventListener('click', function () {
    const usernameInput = document.getElementById('username');
    usernameInput.value = 'user_' + Math.random().toString(36).substring(2, 10);
});

// Toggle Password
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const confirmPassword = document.querySelector('#confirm-password');

toggleConfirmPassword.addEventListener('click', function (e) {
    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPassword.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});