import './bootstrap';
import Alpine from 'alpinejs';
import { initCKEditor } from './ckeditor-config';

window.Alpine = Alpine;
Alpine.start();

// Make initCKEditor available globally
window.initCKEditor = initCKEditor;
