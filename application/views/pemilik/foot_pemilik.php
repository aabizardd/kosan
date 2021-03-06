<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('pemilik/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() ?>asset_admin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>asset_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>asset_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>asset_admin/js/sb-admin-2.min.js"></script>

<script src="<?=base_url('asset_bootstrap/');?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('asset_bootstrap/');?>datatables/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>asset_admin/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url() ?>asset_admin/js/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url() ?>asset_admin/js/demo/chart-pie-demo.js"></script>


<script>
$(document).ready(function() {
    $('.toast').toast('show');
});

function notifDibaca(idnotif) {
    var redirect = $('.notif' + idnotif).data('url');
    // alert(url);
    $.ajax({
        url: '<?=base_url('pemilik/getNotif')?>',
        type: 'post',
        data: {
            'id': idnotif
        },
        dataType: 'json',
        success: function(response) {
            let {
                id_notifikasi,
                jenis,
                untuk,
                status_baca
            } = response
            $.ajax({
                url: '<?=base_url('pemilik/notifDibaca')?>',
                type: 'post',
                data: {
                    'id': id_notifikasi,
                    'status_baca': 1
                },
                dataType: 'json',
                complete: function() {
                    if (jenis == 'pemesanan' && status_baca == 0) {
                        window.location = redirect;
                    } else {
                        window.location = redirect;
                    }
                    // alert(jenis);
                }
            });
            // console.log(jenis);
        }
    });
}
</script>

<?php if ($nama->file_mou == "" || is_null($nama->file_mou)): ?>

<script>
$('#modal-mou').modal('show');
</script>

<?php endif?>

</body>





















</html>