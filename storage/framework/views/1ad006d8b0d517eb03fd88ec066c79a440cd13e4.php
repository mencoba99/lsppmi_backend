<?php $__env->startSection('content'); ?>

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Manajemen Assessor
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="<?php echo e(url('/')); ?>" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Assessor Add')): ?>
                        <a href="<?php echo e(route('assessor.create')); ?>" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Tambah Assessor
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Instansi</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="nosearch"></td>
                    </tfoot>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#kt_table_1').DataTable({
                // dom: 'Bfrtip',
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ordering: false,
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
                ajax: {
                    'url': '<?php echo e(route('assessor.getdata')); ?>',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                },
                columns: [
                    {data: 'name', name: 'name', title: 'Nama Assessor'},
                    {data: 'email', name: 'email', title: 'Email'},
                    {data: 'mobile_phone', name: 'mobile_phone', title: 'No HP'},
                    {data: 'company', name: 'company', title: 'Instansi'},
                    {data: 'action', responsivePriority: -1},
                ],
                initComplete: function () {
                    this.api().columns().every(function (i,e) {
//                        console.log(i);
                        var column = this;
                        var input = document.createElement("input");
                        var wrapper = document.createElement('div');
                        $(wrapper).addClass('kt-input-icon kt-input-icon--right');
                        $(input).addClass('form-control form-control-sm');
                        $(input).appendTo(wrapper);
                        $('<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-search"></i></span></span>').appendTo(wrapper);
                        $(wrapper).appendTo($(column.footer()).not('.nosearch').empty())
                            .on('change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });

                    // Restore state
                    var state = table.state.loaded();
                    if ( state ) {
                        table.columns().eq( 0 ).each( function ( colIdx ) {
                            var colSearch = state.columns[colIdx].search;

                            if ( colSearch.search ) {
                                console.log(table.column( colIdx ).footer());
                                $( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
                            }
                        } );

                        table.draw();
                    }
                },
                // dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style type="text/css">
        tfoot {
            display: table-header-group;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/DataMaster/AssessorController/index.blade.php ENDPATH**/ ?>