function drawChart(info) {
	
	var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Cazuri in Puerto Rico 2011-2018"
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
export {drawChart};