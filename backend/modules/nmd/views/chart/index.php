<?php

?>

<!DOCTYPE html>
<html>

<head>
    <title>Car Brand Data Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"></script>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>


    <style>
        .chart-container {
            margin: 0.5rem;
            padding-bottom: 1rem;
            padding: 1rem;
            border-radius: 1rem;
            background-color: white;
            display: inline-block;
            height: 25rem;
            width: 90%;
        }

        /* .chart-container canvas {
            background-color: white;
            border-radius: 5px;
        } */

        body.dark-mode .chart-container {
            background-color: black;
        }

        body.dark-mode .chart-container canvas {
            background-color: black;
        }


        @media (max-width: 900px) {
            .chart-container {
                flex-basis: 100%;
                max-width: 100%;
                background-color: white;
                width: 100%;
                display: block;
                /* Change to block to stack vertically */
            }
        }
    </style>
</head>

<body><!-- removed direct declaration of chart from controller -->

        <button onclick="downloadPDF()"> PDF Download</button>
    <div class="chart-container">
        <a> From </a>
        <select name="startDate" id="startDate" onchange="filterData()">
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>
        <a> To </a>
        <select name="endDate" id="endDate" onchange="filterData()">
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>
        <br>
        <canvas id="barChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="pieChart"></canvas>
    </div>

    <script>
        // Get the data from the canvas element data attribute for both bar and pie charts
        const barChartData = (<?= json_encode($barChartData) ?>); //eto rekta na tawag from array to json
        const pieChartData = (<?= json_encode($pieChartData) ?>); //di ma edit pag sa html declared yung canvas/chart
        //testing lang extract
        const barLabelArray = barChartData.labels;
        const barDataArray = barChartData.datasets;
        const x = 0;
        // Prepare the bar chart 
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: barLabelArray,
                datasets: [{
                        label: barChartData.datasets[0].label,  
                        data: [barChartData.datasets[0].data[2020],barChartData.datasets[0].data[2021],
                        barChartData.datasets[0].data[2022],barChartData.datasets[0].data[2023],],
                        backgroundColor: barChartData.datasets[0].backgroundColor,
                    },
                    {
                        label: barChartData.datasets[1].label,  
                        data: [barChartData.datasets[1].data[2020],barChartData.datasets[1].data[2021],
                        barChartData.datasets[1].data[2022],barChartData.datasets[1].data[2023],],
                        backgroundColor: barChartData.datasets[1].backgroundColor,
                    },{
                        label: barChartData.datasets[2].label,  
                        data: [barChartData.datasets[2].data[2020],barChartData.datasets[2].data[2021],
                        barChartData.datasets[2].data[2022],barChartData.datasets[2].data[2023],],
                        backgroundColor: barChartData.datasets[2].backgroundColor,
                    },{
                        label: barChartData.datasets[3].label,  
                        data: [barChartData.datasets[3].data[2020],barChartData.datasets[3].data[2021],
                        barChartData.datasets[3].data[2022],barChartData.datasets[3].data[2023],],
                        backgroundColor: barChartData.datasets[3].backgroundColor,
                    },] //reminder, filter this thing later at DOST it causes to post labels even without the labels:barLabelArray
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                        grid: {
                            display: false,
                        },
                    },
                    x: {
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 7,
                        },
                        grid: {
                            display: false,
                        },
                    },
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Car Brands Total Order per Year',
                    },
                    legend: {
                        display: true,
                    },
                },
                responsive: true,
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15,
                    },
                },
            },
        });


        // Prepare the pie chart
        var pieCtx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'doughnut',
            data: pieChartData,
            options: {
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Car Brands General Total Order',
                    },
                    legend: {
                        display: true,
                    },
                },
                responsive: true,
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15,
                    },
                },
            },
        });

        function filterData() {
            //logs to see if I am not hallucinating
            const barLabel = [...barLabelArray]; //duplicate array
            console.log(barChartData);
            const startDate = document.getElementById('startDate'); //retrieve selected year
            const endDate = document.getElementById('endDate');

            const pickStartDate = barLabel.indexOf(startDate.value); //pass selected year
            const pickEndDate = barLabel.indexOf(endDate.value);

            //slice array based on selected year
            const filterDate = barLabel.slice(pickStartDate, pickEndDate + 1);
            //replace labels hopefully
            barChart.data.labels = filterDate;

            barChart.data.labels.splice(0, barChart.data.labels.length, ...filterDate);

            barChart.update();
            pieChart.update();
        }


    function downloadPDF() {
        const pieCanvas = document.getElementById('pieChart');
        const barCanvas = document.getElementById('barChart');
        const tempCanvas = document.createElement('canvas');
        const tempCtx = tempCanvas.getContext('2d');

        // Calculate the total height including space between the charts
        const totalHeight = pieCanvas.height + barCanvas.height + pieCanvas.height + barCanvas.height + 40; // Adding space between charts

        // Set canvas dimensions to accommodate both charts with space
        tempCanvas.width = Math.max(pieCanvas.width, barCanvas.width);
        tempCanvas.height = totalHeight;

        // Set the background color to white on the temporary canvas
        tempCtx.fillStyle = 'white';
        tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);

        // Draw pie chart on the temporary canvas
        tempCtx.drawImage(pieCanvas, 0, 0);

        // Draw bar chart below the first pie chart with space in between
        tempCtx.drawImage(barCanvas, 0, pieCanvas.height + 20); // Adding space

        // Draw another copy of pie chart below the bar chart
        tempCtx.drawImage(pieCanvas, 0, pieCanvas.height + barCanvas.height + 40); // Adding space

        // Create the PDF
        let pdf = new jsPDF();

        // First page
        const canvasImage = tempCanvas.toDataURL('image/jpeg', 1.0);
        pdf.setFontSize(20);
        pdf.addImage(canvasImage, 'JPEG', 15, 15, 190, totalHeight * (190 / tempCanvas.width)); // Adjust positioning and dimensions

        // Draw the title "Car Brands" using vector graphics
        pdf.setFont('helvetica', 'normal'); // Set font to Helvetica (similar to Poppins)
        pdf.setFontSize(16);
        pdf.setTextColor(0, 0, 0); // Set text color to black
        pdf.text(10, 10, "Car Brands");

        // Clean up the temporary canvas
        tempCanvas.width = 0;
        tempCanvas.height = 0;

        // Create a new temporary canvas for the second page
        tempCanvas.width = Math.max(pieCanvas.width, barCanvas.width);
        tempCanvas.height = totalHeight;

        // Set the background color to white on the temporary canvas
        tempCtx.fillStyle = 'white';
        tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);

        // Draw the duplicated bar chart on the new temporary canvas
        tempCtx.drawImage(barCanvas, 0, 0);

        // Add the second page with the duplicated bar chart
        pdf.addPage();
        const canvasImagePage2 = tempCanvas.toDataURL('image/jpeg', 1.0);
        pdf.addImage(canvasImagePage2, 'JPEG', 15, 15, 190, totalHeight * (190 / tempCanvas.width)); // Adjust positioning and dimensions

        // Save the PDF
        pdf.save('sample.pdf');
}






    </script>
</body>

</html>