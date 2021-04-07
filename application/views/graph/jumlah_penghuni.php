<script>
var colors = ['#007bff', '#28a745', '#444444', '#c3e6cb', '#dc3545', '#6c757d'];

var chBar = document.getElementById("chBar1");
var chartData = {
    labels: [<?php foreach ($count_penghuni as $b): ?> "<?=date("F", strtotime($b->tanggal));?>",
        <?php endforeach;?>
    ],
    datasets: [{
        data: [<?php foreach ($count_penghuni as $p): ?> <?=$p->penghuni?>, <?php endforeach;?>],
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