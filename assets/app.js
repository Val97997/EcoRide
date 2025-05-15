import './bootstrap.js';
import './bootstrap';
import 'bootstrap';
import { waapi, animate, createSpring, stagger } from 'animejs';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// app.js

// const $ = require('jquery');
// // this "modifies" the jquery module: adding behavior to it
// // the bootstrap module doesn't export/return anything
// require('bootstrap');

// // or you can include specific pieces
// // require('bootstrap/js/dist/tooltip');
// // require('bootstrap/js/dist/popover');

// $(document).ready(function() {
//     $('[data-toggle="popover"]').popover();
// });

// anime.js animation setups

waapi.animate('.animate-title span', {
  translate: `0 -2rem`,
  delay: stagger(100),
  duration: 600,
  loop: 3,
  alternate: true,
  ease: 'inOut(2)',
});
