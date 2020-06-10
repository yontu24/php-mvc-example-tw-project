function drawChart(info,locatie) {
	console.log(locatie);
	var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Cazuri in "+locatie+" 2011-2018"
	},
	
	data: [{
		type: "line",
		
		//yValueFormatString: "#,### cazuri",
		dataPoints: info
	}]
});
	console.log(info);
	return chart2;
	//chart2.render();
}
function drawChart2(info,locatie,anul) {
	console.log(locatie);
	var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Cazuri in "+locatie+" anul "+anul
	},
	
	data: [{
		type: "column",
		
		//yValueFormatString: "#,### cazuri",
		dataPoints: info
	}]
});
	console.log(info);
	return chart2;
	//chart2.render();
}
function drawChart3(info,locatie,anul) {
	console.log(locatie);
	var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Cazuri in "+locatie+" anul "+anul
	},
	
	data: [{
		type: "pie",
		
		//yValueFormatString: "#,### cazuri",
		dataPoints: info
	}]
});
	console.log(info);
	return chart2;
	//chart2.render();
}
export {drawChart,drawChart2,drawChart3};