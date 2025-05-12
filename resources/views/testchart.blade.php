<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <canvas id="myChart" height="150"></canvas>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                    datasets: [{
                        label: 'Harga',
                        data: [12000, 13000, 12500, 14000],
                        borderColor: 'orange',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
</body>

</html>