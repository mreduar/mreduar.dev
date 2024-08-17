window.axios = require("axios");
import Alpine from "alpinejs";
import Fuse from "fuse.js";
import * as particlesJson from "./particles-config";
import { tsParticles } from "tsparticles";

tsParticles.load("body", particlesJson);

window.Fuse = Fuse;
window.Alpine = Alpine;

Alpine.start();
