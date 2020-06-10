import {functie1} from "./functie1.js";
import {drawChart}from "./functie2.js";

let a=functie1();
let b=drawChart(a);
b.render();
console.log(a);