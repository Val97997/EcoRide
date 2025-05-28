import $ from 'jquery';
// Import the necessary styles and scripts
import './bootstrap';
import 'bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
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


// anime.js animation setups
//login page
waapi.animate('.animate-title span', {
  translate: `0 -2rem`,
  delay: stagger(100),
  duration: 600,
  loop: 3,
  alternate: true,
  ease: 'inOut(2)',
});

//list carshares page
animate('.search-page-big-hero h1', {
  opacity: [0, 1],
  translateY: ['-2rem', '0'],
  duration: 1000,
  ease: 'bounce(2, 0.3)',
  delay: stagger(100),
});

animate('.search-page-big-hero h4', {
  opacity: [0, 1],
  translateY: ['2rem', '0'],
  duration: 1000,
  ease: 'bounce(2, 0.3)',
  delay: stagger(100),
});
