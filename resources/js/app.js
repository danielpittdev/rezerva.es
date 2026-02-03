import './bootstrap';
import '@tailwindplus/elements';
import $ from 'jquery';
import FormBackendValidation from 'form-backend-validation';
import AOS from 'aos'
import 'aos/dist/aos.css'

// opción: si quieres exponerlo globalmente en window
window.FormBackendValidation = FormBackendValidation;
window.$ = window.jQuery = $;
AOS.init({ once: true });