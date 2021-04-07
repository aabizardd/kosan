<script>
var colors = ['#007bff', '#28a745', '#444444', '#c3e6cb', '#dc3545', '#6c757d'];

var chBar = document.getElementById("chBar");
var chartData = {
    labels: [<?php foreach ($pemasukann as $b): ?> "<?=date("F", strtotime($b->tanggal));?>",
        <?php endforeach;?>
    ],
    datasets: [{
        data: [<?php foreach ($pemasukann as $p): ?> <?=$p->pendapatan?>, <?php endforeach;?>],
        backgroundColor: colors[0]
    }, ]
};
if (chBar) {
    new Chart(chBar, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                xAxes: [{
                    barPercentage: 0.4,
                    categoryPercentage: 0.5
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });
}
</script>