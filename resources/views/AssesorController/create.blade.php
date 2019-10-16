@extends('layouts.base')

@section('content')
  <!-- begin:: Content -->
  <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
      <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
          <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">
                <i class="flaticon2-plus"></i> Tambah Assesor
              </h3>
            </div>
          </div>

          <!--begin::Form-->
          {!! Form::open(['route' => 'assesor.store', 'class' => 'kt-form kt-form--fit kt-form--label-right', 'id' => 'form_create_asssesor', 'files'=> true]) !!}
            <div class="kt-portlet__body">
              <div class="form-group row">
                <label class="col-lg-2 col-form-label">Nama *</label>
                <div class="col-lg-3">
                  <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="" autocomplete="off">
                  @if ($errors->has('nama'))
                      <div class="text-danger">
                        {{ $errors->first('nama') }}
                      </div>
                  @endif
                </div>
                {{-- <label class="col-lg-2 col-form-label">Contact Number:</label>
                <div class="col-lg-3">
                  <input type="email" class="form-control" placeholder="Enter contact number">
                </div> --}}
              </div>
              <div class="form-group row">
                <label class="col-lg-2 col-form-label">Email *</label>
                <div class="col-lg-3">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="" autocomplete="off">
                  @if ($errors->has('email'))
                      <div class="text-danger">
                        {{ $errors->first('email') }}
                      </div>
                  @endif
                </div>
                {{-- <label class="col-lg-2 col-form-label">Postcode:</label>
                <div class="col-lg-3">
                  <div class="kt-input-icon">
                    <input type="text" class="form-control" placeholder="Enter your postcode">
                    <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-bookmark-o"></i></span></span>
                  </div>
                </div> --}}
              </div>
              <div class="form-group row">
                <label class="col-lg-2 col-form-label">Telepon *</label>
                <div class="col-lg-3">
                <input type="text" name="telepon" value="{{ old('telepon') }}" class="form-control" placeholder="">
                  @if ($errors->has('telepon'))
                      <div class="text-danger">
                        {{ $errors->first('telepon') }}
                      </div>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-2 col-form-label">Institusi</label>
                <div class="col-lg-3">
                <input type="text" name="institusi" value="{{ old('institusi') }}" class="form-control" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-2 col-form-label">Jabatan</label>
                <div class="col-lg-3">
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="form-control" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-2 col-form-label">Foto</label>
                <div class="col-lg-3">
                <input type="file" name="foto" value="{{ old('foto') }}" class="form-control" placeholder="">
                </div>
              </div>
            </div>
            <div class="kt-portlet__foot kt-portlet__foot--fit-x">
              <div class="kt-form__actions">
                <div class="row">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-10">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          {!! Form::close() !!}

          <!--end::Form-->
        </div>

        <!--end::Portlet-->

      </div>
    </div>
  </div>

  <!-- end:: Content -->
@endsection