const url = 'http://localhost/Proiect_1/MCV/Model/mgetbylocation.php';
const xhr = new XMLHttpRequest();

// listen for `load` event
xhr.onload = () => {
	var normalWtotal=0;
	var obesetotal=0;
	var overWtotal=0;
	var underWtotal=0;
	
	var normalW2011=0,normalW2012=0,normalW2013=0,normalW2014=0,normalW2015=0,normalW2016=0,normalW2017=0,normalW2018=0;
	var obese=[];
	var overW=[];
	var underW=[];
	var anul=0;
	var ob=0;
    // print JSON response
	var dataPoints1 =[];
	var dataPoints2=[];
    if (xhr.status >= 200 && xhr.status < 300) {
        // parse JSON
        const response = JSON.parse(xhr.responseText);
		for (var i = 0; i < response.values.length; i++)
		{
		if (parseInt(response.values[i].an, 10) != anul) {
			obese.push({
				an: anul,
				cazuri: ob
			});
			anul = (parseInt(response.values[i].an, 10));
			ob = 0;
		}

		if (response.values[i].categorie.includes("Obese"))
	
			ob = ob + (parseInt(response.values[i].cazuri, 10));
	
		}
		obese.shift();
		for(var i=0;i<obese.length;i++)
		{
			dataPoints2.push({ y:obese[i].cazuri ,label :obese[i].an});
		}
		localStorage.setItem("vOneLocalStorage",dataPoints2);
		/*for(var i=0;i<response.values.length;i+=4)
		{
			normalWtotal=normalWtotal+parseInt(response.values[i].cazuri,10);
			
		}
		// console.log(response.message);
		//console.log(response.values[1].cazuri);
		console.log(normalWtotal);
		for(var i=1;i<response.values.length;i+=4)
		{
			obesetotal=obesetotal+parseInt(response.values[i].cazuri,10);
			
		}
		console.log(obesetotal);
		for(var i=2;i<response.values.length;i+=4)
		{
			overWtotal=overWtotal+parseInt(response.values[i].cazuri,10);
			
		}
		console.log(overWtotal);
		for(var i=3;i<response.values.length;i+=4)
		{
			underWtotal=underWtotal+parseInt(response.values[i].cazuri,10);
			
		}
		console.log(underWtotal);
    }*/
    /*dataPoints1 = [
	{y:normalWtotal ,label:"normal weight"},
	{y:obesetotal ,label:"obese"},
	{y:overWtotal ,label:"over weight"},
	{y:underWtotal ,label:"under weight"}
	];
	
	var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Cazuri in Puerto Rico 2011-2018"
	},
	
	data: [{
		type: "column",
		yValueFormatString: "#,### cazuri",
		dataPoints: dataPoints1
	}]
});*/
export default ob;
var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Cazuri in Puerto Rico 2011-2018"
	},
	
	data: [{
		type: "line",
		//yValueFormatString: "#,### cazuri",
		dataPoints: dataPoints2
	}]
});
	
	//chart1.render();
	chart2.render();
};
}


// create a JSON object
const json = {
    "locatie": "Puerto Rico"
};

// open request
xhr.open('POST', url);

// set `Content-Type` header
xhr.setRequestHeader('Content-Type', 'application/json');

// send rquest with JSON payload
xhr.send(JSON.stringify(json));