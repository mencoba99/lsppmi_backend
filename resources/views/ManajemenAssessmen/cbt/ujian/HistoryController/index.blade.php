@extends('layouts.base')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-tag"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Jenis Ujian
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href={{route('ujian.jenis.create', '')}} class='btn btn-brand btn-elevate btn-icon-sm modalIframe' id="clearIframe" data-toggle='kt-tooltip' title='Tambah Data'
                            data-original-tooltip='Jadwal Ujian Create Data'>
                            <i class='la la-plus'></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body tabel-provinsi">
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                id="datatable">
                <thead>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="nosearch"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ Storage::url('assets/backend/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var KTBootstrap = function () {
        // Private functions
        var config = function () {
           
        }
        return {
            init: function () {
                config();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTBootstrap.init();
    });

    function view(){
    $('#datatable').DataTable().destroy(); // destroy datatable
    /* Datatable View */
    $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ujian.jenis.data') }}",
            columns: [
                { data: 'ujian_jenis_id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } , title: 'No.', width : "3%" },
                { data: 'name', name: 'name' , title: 'Nama ' },
                { data: 'keterangan', name: 'keterangan' , title: 'Keterangan' },
                { data: 'action', name: 'action' , title: 'Action', width : "15%" },
            ]
    });

    $('#clearIframe').click(function(event) {
            $('#loader').show();
        });
    }

    $(function() {
        view(); //call datatable view
    });

</script>

@endpush
