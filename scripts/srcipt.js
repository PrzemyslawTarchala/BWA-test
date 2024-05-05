const body = document.querySelector("body"),
			sidebar = document.querySelector(".sidebar"),
			toggle = document.querySelector(".toggle"),
			searchBtn = document.querySelector(".search-box"),
			modeSwitch = document.querySelector(".toggle-switch"),
			modeText = document.querySelector(".mode-text"),
			
			expand = document.querySelector(".expand"),
			expanseCategoryList = document.querySelector(".expense-data .category .input");


			toggle.addEventListener("click", () => {
				sidebar.classList.toggle("close");
			});

			modeSwitch.addEventListener("click", () => {
				body.classList.toggle("dark");

				if(body.classList.contains("dark")){
					modeText.innerText = "Light Mode";
				} else{
					modeText.innerText = "Dark Mode";
				}
			});


// ------------ Income doughnut Chart


document.addEventListener('DOMContentLoaded', function() {
	// Pobierz canvas
	var ctx = document.getElementById('incomeDoughnutChart').getContext('2d');

	// Utwórz pie chart
	var myPieChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
				labels: incomeDoughnutChartData.map(item => item.name),
				datasets: [{
						data: incomeDoughnutChartData.map(item => item.incomeByCategory),
						backgroundColor: ['lightgreen', 'limegreen', 'seagreen', 'lawngreen', 'lightgrey', 'forestgreen']
				}]
		},
	});
});

// ------------ Expense doughnut Chart

document.addEventListener('DOMContentLoaded', function() {
	// Pobierz canvas
	var ctx = document.getElementById('expenseDoughnutChart').getContext('2d');

	// Ustaw szerokość i wysokość canvasu na szerokość i wysokość jego rodzica
	ctx.canvas.width = ctx.canvas.parentElement.offsetWidth * 0.8; // Na przykład 80% szerokości rodzica
	ctx.canvas.height = ctx.canvas.parentElement.offsetHeight;

	// Utwórz pie chart
	var myPieChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
					labels: expenseDoughnutChartData.map(item => item.name),
					datasets: [{
							data: expenseDoughnutChartData.map(item => item.expenseByCategory),
							backgroundColor: ['Salmon', 'Coral', 'red', 'Tomato', 'OrangeRed', 'Crimson']
					}]
			},
	});
});

//----------- Balance Plot
document.addEventListener('DOMContentLoaded', function() {
	// Pobierz canvas
	var ctx = document.getElementById('balancePlot').getContext('2d');

	// Utwórz wykres plot
	var balancePlot = new Chart(ctx, {
			type: 'line', // Typ wykresu: plot
			data: {
					labels: Object.keys(balancePlotData), // Dni jako etykiety
					datasets: [{
							label: 'Balance', // Etykieta dla danych
							data: Object.values(balancePlotData), // Dane dotyczące salda
							borderColor: 'gray', // Kolor linii
							backgroundColor: 'transparent', // Kolor tła
							borderWidth: 2 // Grubość linii
					}]
			},
			options: {
					responsive: true,
					legend: { display: false },
					scales: {
							yAxes: [{
									ticks: {
											beginAtZero: true // Wyświetlaj osie Y zaczynając od 0
									},
									scaleLabel: {
											display: true,
											labelString: 'Bilans' // Tytuł dla osi Y
									},
							}],
							xAxes: [{
									scaleLabel: {
											display: true,
											labelString: 'Dzień miesiąca' // Tytuł dla osi X
									},
							}]
					}
			}
	});

	// Ustaw szerokość i wysokość canvasu na 100%
	ctx.canvas.width = ctx.canvas.offsetWidth;
	ctx.canvas.height = ctx.canvas.offsetHeight;
});