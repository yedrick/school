@extends('layout.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">categories</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ url('categories/create') }}" class="btn btn-outline-primary">
                Crear category
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    {{-- Aquí se los titulos --}}
                    {{-- @foreach ($headers as $item)
                            <th>{{ $item }}</th>
                        @endforeach --}}
                </tr>
            </thead>
            <tbody>
                {{-- Aquí se cargarían los datos --}}
            </tbody>
        </table>
    </div>
@endsection
