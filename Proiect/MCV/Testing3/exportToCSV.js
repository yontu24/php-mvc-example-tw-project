import {getObese} from "../View/vprimulchart.js";

/* de creat getter getObese() la vectorul obese din vprimulchart.js */

let element = document.getElementById("csv_file");
element.onclick = function () {
    const items = getObese();

    // specify how you want to handle null values here
    const replacer = (key, value) => value === null ? '' : value;
    const header = Object.keys(items[0]);
    let csv = items.map(row => header.map(fieldName => JSON.stringify(row[fieldName], replacer)).join(','));
    csv.unshift(header.join(','));
    csv = csv.join('\r\n');

    // this trick will generate a temp "a" tag
    // https://stackoverflow.com/questions/8847766/how-to-convert-json-to-csv-format-and-store-in-a-variable
    var link = document.createElement("a");
    link.id = "down-link";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);

    var blob = new Blob([csv], { type: 'text/csv' });
    var csvUrl = window.webkitURL.createObjectURL(blob);
    var filename = 'UserExport.csv';
    $("#down-link")
        .attr({
            'download': filename,
            'href': csvUrl
        });

    $('#down-link')[0].click();
    document.body.removeChild(link)
};