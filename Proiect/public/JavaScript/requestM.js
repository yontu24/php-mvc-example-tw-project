
function requestM(an,locatie){
  var opt = localStorage.getItem("locatie");
  console.log (opt);
  const url1 = 'http://localhost/OBIS/REST/api/info/read.php?an='+an+'&raspuns=RESP039&locatie='+opt.replace(" ","_")+'&categorie=CAT2';
  console.log (url1);
  const request1 = new XMLHttpRequest();
  request1.open('GET', url1);

  request1.onload = function() {
    if (request1.status === 200) {
      const data = JSON.parse(request1.responseText);
      document.getElementById("rezultat").innerHTML = data.values[1].cazuri;
      console.log(data.values[0].cazuri);
    } else {
      // Reached the server, but it returned an error
    }

  }
  request1.setRequestHeader('Content-Type', 'application/json');

   request1.send();
}
export {requestM};
