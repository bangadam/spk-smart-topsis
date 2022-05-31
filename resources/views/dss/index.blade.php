@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report DSS</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('dss.create') }}">
                        Tambah Proses Penentuan Penerima Bantuan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-borderd" id="table-report">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kuota</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periods as $value)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td>{{$value->title}}</td>
                                    <td>{{$value->quota}}</td>
                                    <td>{{$value->start_date}}</td>
                                    <td>{{$value->end_date}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>
                                        <a href="{{ route('dss.show', $value->id) }}" class="btn btn-primary btn-sm">
                                            detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('third_party_stylesheets')
    @include('layouts.datatables_css')
@endpush

@push('third_party_scripts')
    @include('layouts.datatables_js')
    <script>
        $('#table-report').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endpush

