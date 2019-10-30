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
                        Manajemen TUK <small>Ubah TUK</small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="{{ route('tuk.index') }}" class="btn btn-clean btn-icon-sm">
                            <i class="la la-long-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            @include('DataMaster.TukController.form', ['button' => 'Ubah','action'=>route('tuk.update',['tuk'=>$tuk])])

        </div>

    </div>

    <!-- end:: Content -->

@endsection
