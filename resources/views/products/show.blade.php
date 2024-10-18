@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Create new product</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <form class="forms-sample">
                <div class="row mb-3">
                  <div class="col">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="{{$product->name}}" disabled>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Price:</label>
                    <input type="text" class="form-control" placeholder="Price" name="price" id="price" value="{{$product->price}}" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Description:</label>
                    <input type="text" class="form-control" placeholder="Description the product" name="description" id="description" value="{{$product->description}}" disabled>
                  </div>
                </div>
                {{-- btn ala isquierda  pero si es movil al centro --}}
                <div class="d-flex justify-content-center ">
                    <a href="{{ url('products') }}" type="button" class="btn btn-danger btn-icon-text me-2">
                        <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                        Prev
                    </a>
                    <button type="submit" class="btn btn-primary btn-icon-text" disabled>
                        <i class="btn-icon-prepend" data-feather="save"></i>
                        Save
                    </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
@endsection

