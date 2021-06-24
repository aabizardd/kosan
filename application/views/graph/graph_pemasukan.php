<!-- <script>
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
        type: 'line',
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
</script> -->

<script>
//line
var ctxL = document.getElementById("chBar").getContext('2d');
var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
        labels: [<?php foreach ($pemasukann as $b): ?> "<?=date("F", strtotime($b->tanggal));?>",
            <?php endforeach;?>
        ],
        datasets: [{
                label: "Pendapatan",
                data: [<?php foreach ($pemasukann as $p): ?> <?=$p->pendapatan?>, <?php endforeach;?>],
                backgroundColor: [
                    'rgba(105, 0, 132, .2)',
                ],
                borderColor: [
                    'rgba(200, 99, 132, .7)',
                ],
                borderWidth: 2
            }

        ]
    },
    options: {
        responsive: true
    }
});
</script>
