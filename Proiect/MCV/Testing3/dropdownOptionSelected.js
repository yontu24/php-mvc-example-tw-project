let theDropdown = document.getElementById("locality-dropdown");

 function getSelectedValue() {
    for (var i = 1; i < theDropdown.options.length; i++) {
        if (theDropdown.options[i].selected == true) {
			drawChart();
        }
    }
 }


 function drawChart() {
    var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Cazuri in Puerto Rico 2011-2018"
	},
	
	data: [{
		type: "line",
		
		//yValueFormatString: "#,### cazuri",
		dataPoints: [
		{y:3},
		{y:4},
		{y:5},
		{y:6},
		{y:7}
		]
	}]
});
	
	//chart1.render();
	chart2.render();
}