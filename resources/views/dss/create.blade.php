@extends('layouts.app')

@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Proses Pendukung Keputusan</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')


        {{-- Informasi Data --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="card-title">
                            <i class="fas fa-info-circle"></i>
                            Informasi Data
                        </h4>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <h5>Data Kriteria</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($criterias as $key => $criteria)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $criteria->name }}</td>
                                            <td>{{ $criteria->weight }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfooot>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td>{{$total_weight_criteria}}</td>
                                    </tr>
                                </tfooot>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <h5>Normalisasi Bobot Kriteria</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode Kriteria</th>
                                        <th>Normalisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($normalized_weight_criteria as $key => $value)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            {!! Form::open(['route' => 'dss.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('dss.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('dss.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@push('third_party_scripts')
    @include('layouts.datatables_js')
    <script>
        $(function () {
            $('#table-dataset').DataTable()
            $('#table-utility').DataTable()
        })
    </script>
@endpush
