@extends('layouts.base')

@section('content')
  <!-- begin:: Content -->
  <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon">
            <i class="kt-font-brand flaticon2-line-chart"></i>
          </span>
          <h3 class="kt-portlet__head-title">
            Manajeman Assesor
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <div class="kt-portlet__head-actions">
            <a href="{{ url('assesor/create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                <i class="la la-plus"></i>
                New Record
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="kt-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="assesor-table">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Telepon</th>
              <th>Institusi</th>
              <th>Jabatan</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>

        <!--end: Datatable -->
      </div>
    </div>
  </div>

  <!-- end:: Content -->
  <script>
    var KTAppOptions = {
      "colors": {
        "state": {
          "brand": "#5d78ff",
          "dark": "#282a3c",
          "light": "#ffffff",
          "primary": "#5867dd",
          "success": "#34bfa3",
          "info": "#36a3f7",
          "warning": "#ffb822",
          "danger": "#fd3995"
        },
        "base": {
          "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
          "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
        }
      }
    };
  </script>
@endsection
@push('styles')
  <link href="{{ Storage::url('vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
  <!--begin::Page Vendors(used by this page) -->
  <script src="{{ Storage::url('vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

  <!--end::Page Vendors -->

  <!--begin::Page Scripts(used by this page) -->
  <script src="{{ Storage::url('js/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>

  <script>
    $(function(){
      var t_assesor = $('#assesor-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ $url_ajax_datatable }}',
        columns: [
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'telephone', name: 'telephone'},
          {data: 'institution', name: 'institution'},
          {data: 'position', name: 'position'},
          {data: 'action', orderable: false, searchable: false},
        ],
        pageLength: 10,
      });
    })
  </script>
@endpush 