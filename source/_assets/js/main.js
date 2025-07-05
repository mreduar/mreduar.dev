window.axios = require("axios");
import Alpine from "alpinejs";
import Fuse from "fuse.js";
import * as particlesJson from "./particles-config";
import { tsParticles } from "tsparticles";
import katex from "katex";

tsParticles.load("body", particlesJson);

window.Fuse = Fuse;
window.Alpine = Alpine;

// Initialize KaTeX for math rendering
document.addEventListener('DOMContentLoaded', function() {
    const mathElements = document.querySelectorAll('.math');
    mathElements.forEach(element => {
        katex.render(element.textContent, element, {
            displayMode: element.classList.contains('display-math'),
            throwOnError: false
        });
    });
});

Alpine.start();
