import {functie1} from "./functie1.js";
import {drawChart}from "./functie2.js";
let text="Connecticut";
let a=functie1(text);
let b=drawChart(a,text);
b.render();
console.log(a);