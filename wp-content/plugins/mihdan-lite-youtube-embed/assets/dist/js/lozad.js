/*! lozad.js - v1.16.0 - 2020-09-06
* https://github.com/ApoorvSaxena/lozad.js
* Copyright (c) 2020 Apoorv Saxena; Licensed MIT */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.lozad=e()}(this,(function(){"use strict";var t="undefined"!=typeof document&&document.documentMode,e={rootMargin:"0px",threshold:0,load:function(e){if("picture"===e.nodeName.toLowerCase()){var r=e.querySelector("img"),a=!1;null===r&&(r=document.createElement("img"),a=!0),t&&e.getAttribute("data-iesrc")&&(r.src=e.getAttribute("data-iesrc")),e.getAttribute("data-alt")&&(r.alt=e.getAttribute("data-alt")),a&&e.append(r)}if("video"===e.nodeName.toLowerCase()&&!e.getAttribute("data-src")&&e.children){for(var o=e.children,i=void 0,n=0;n<=o.length-1;n++)(i=o[n].getAttribute("data-src"))&&(o[n].src=i);e.load()}e.getAttribute("data-poster")&&(e.poster=e.getAttribute("data-poster")),e.getAttribute("data-src")&&(e.src=e.getAttribute("data-src")),e.getAttribute("data-srcset")&&e.setAttribute("srcset",e.getAttribute("data-srcset"));var d=",";if(e.getAttribute("data-background-delimiter")&&(d=e.getAttribute("data-background-delimiter")),e.getAttribute("data-background-image"))e.style.backgroundImage="url('"+e.getAttribute("data-background-image").split(d).join("'),url('")+"')";else if(e.getAttribute("data-background-image-set")){var u=e.getAttribute("data-background-image-set").split(d),g=u[0].substr(0,u[0].indexOf(" "))||u[0];g=-1===g.indexOf("url(")?"url("+g+")":g,1===u.length?e.style.backgroundImage=g:e.setAttribute("style",(e.getAttribute("style")||"")+"background-image: "+g+"; background-image: -webkit-image-set("+u+"); background-image: image-set("+u+")")}e.getAttribute("data-toggle-class")&&e.classList.toggle(e.getAttribute("data-toggle-class"))},loaded:function(){}};function r(t){t.setAttribute("data-loaded",!0)}function a(t){t.getAttribute("data-placeholder-background")&&(t.style.background=t.getAttribute("data-placeholder-background"))}var o=function(t){return"true"===t.getAttribute("data-loaded")},i=function(t,e){return function(a,i){a.forEach((function(a){(a.intersectionRatio>0||a.isIntersecting)&&(i.unobserve(a.target),o(a.target)||(t(a.target),r(a.target),e(a.target)))}))}},n=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:document;return t instanceof Element?[t]:t instanceof NodeList?t:e.querySelectorAll(t)};return function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:".lozad",d=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},u=Object.assign({},e,d),g=u.root,s=u.rootMargin,c=u.threshold,l=u.load,b=u.loaded,f=void 0;"undefined"!=typeof window&&window.IntersectionObserver&&(f=new IntersectionObserver(i(l,b),{root:g,rootMargin:s,threshold:c}));for(var A=n(t,g),m=0;m<A.length;m++)a(A[m]);return{observe:function(){for(var e=n(t,g),a=0;a<e.length;a++)o(e[a])||(f?f.observe(e[a]):(l(e[a]),r(e[a]),b(e[a])))},triggerLoad:function(t){o(t)||(l(t),r(t),b(t))},observer:f}}}));