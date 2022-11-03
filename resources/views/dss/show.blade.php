@extends('layouts.app')

@push('third_party_stylesheets')
@include('layouts.datatables_css')
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail data terpilih</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-rangking">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penerima</th>
                            <th>Ranking</th>
                            <th>Status</th>
                            <th>Detail Kriteria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($population_assesments as $key => $item)
                        @php
                        $data = $item->parseData();
                        $number = ++$loop->index;
                        @endphp
                        <tr>
                            <td>{{$number}}</td>
                            <td>{{$data['nama_alternatif']}}</td>
                            <td>{{$data['ranking']}}</td>
                            <td>{{$data['status']}}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs btn-modal-criteria"
                                    data-toggle="modal" data-target="#modal-kriteria"
                                    data-criteria="{{json_encode($data['data'])}}">
                                    Detail kriteria
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="row">

            </div>

        </div>

    </div>
</div>

@include('dss.__modal-show')

@endsection

@push('third_party_scripts')
@include('layouts.datatables_js')
<script>
    $(function () {
            $('#table-rangking').DataTable()

            // on click btn-modal-criteria
            $('#table-rangking').on("click", ".btn-modal-criteria", function () {
                var data = $(this).data('criteria');
                var html = '';
                $.each(data, function (key, value) {
                    html += '<tr>';
                    html += '<td>' + key + '</td>';
                    html += '<td>' + value + '</td>';
                    html += '</tr>';
                });
                $('#table-criteria tbody').html(html);
            });
        })
</script>
@endpush
