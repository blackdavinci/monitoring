jQuery(document).ready(function($) {
	// Fonction datepicker pour le formatage des dates
	$('.date-select').datepicker({
	    language: "fr",
	    format: "dd-mm-yyyy",
	    orientation: "top left"
	});

	// Afficher et Masquer le combox des superviseurs
	$('#role-select').change(function(){
		var rolevalue =  $( "#role-select option:selected" ).val();
		if(rolevalue=='emp'){
			$('#superviseur-select').show();
		}else{
			$('#superviseur-select').hide();
			$('#sup-select').val(0);
		}
	}).trigger('change');

	// ChartJS Code & Data

	// And for a doughnut chart
	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
	        datasets: [{
	            label: '# of Votes',
	            data: [12, 19, 3, 5, 2, 3]
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
	    }
	});
	// Hidding & Showing Year Goal

	$('.link-an').click(function(event) {
		/* Act on the event */
		alert('Hello');
	});


});