<script>
var colors = ['#007bff', '#28a745', '#444444', '#c3e6cb', '#dc3545', '#6c757d'];

var chBar = document.getElementById("chBar");
var chartData = {
    labels: [<?php foreach ($count_pencari as $b): ?> "<?=date("F", strtotime($b->tgl_daftar));?>",
        <?php endforeach;?>
    ],
    datasets: [{
        data: [<?php foreach ($count_pencari as $p): ?> <?=$p->ct?>, <?php endforeach;?>],
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
