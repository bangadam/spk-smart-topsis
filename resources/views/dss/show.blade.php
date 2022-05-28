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


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">

                </div>

            </div>

        </div>
    </div>

@endsection

@push('third_party_scripts')
@endpush
