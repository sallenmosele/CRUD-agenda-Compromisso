<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>
<script src="assets2/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="assets2/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script src="assets2/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="assets2/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
<script src="assets2/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="assets2/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="assets2/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="assets2/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="assets2/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="assets2/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
    $('#exemplo').datepicker({
        format: "dd/MM/yyyy",
        language: "en",
        startDate: '+0d',
        inline: true,

    });
</script>

<script type="text/javascript">
    $('#exemplo2').datepicker({
        format: "dd/MM/yyyy",
        language: "en",
        startDate: '+0d',
        inline: true,

    });
</script>

<script>
    $(".hBack").on("click", function(e) {
        e.preventDefault();
        window.history.back();
    });
</script>

<script>
    $(document).ready(function() {
        var table = $('#table').DataTable({
            buttons: ['excel', 'print', 'pdf'],
            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ]
        });

        table.buttons().container()
            .appendTo('#table_wrapper .col-md-5:eq(0)');
    });
</script>


</body>

</html>