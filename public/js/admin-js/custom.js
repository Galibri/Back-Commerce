(function($) {
    'use strict'
    $(document).ready(function() {
        $('#category-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });
    });
})(jQuery)