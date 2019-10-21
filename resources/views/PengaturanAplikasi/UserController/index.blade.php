@extends('layouts.base')
@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        @include('flash::message')

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        Manajemen User
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="#" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                        <a href="{{ route('user.create') }}" class="btn btn-brand btn-icon-sm">
                            <i class="flaticon2-plus"></i> Tambah User
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th width="40%">Nama</th>
                        <th width="40%">Username/Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

@push('script')
    <script src="{{ Storage::url('vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#kt_table_1');

            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    'url': '{{ route('user.getdata') }}',
                    'type': 'POST',
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'action', responsivePriority: -1},
                ],
            });
        })
    </script>
@endpush
