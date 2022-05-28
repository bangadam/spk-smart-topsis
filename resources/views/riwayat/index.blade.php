@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Riwayat Penerimaan Bantuan</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Detail</th>
                            <th>Tanggal pelaksanaan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat_data as $key => $item)
                        <tr data-toggle="collapse" data-target="#item-{{$key}}" class="accordion-toggle">
                            <td>{{ ++$loop->index }}</td>
                            <td><button class="btn btn-default btn-xs"><span class="fa fa-eye"></span></button></td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->is_process ? 'Sudah Diproses' : 'Belum Diproses'}}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="hiddenRow">
                                <div id="item-{{$key}}" class="accordian-body collapse">
                                    @php
                                        $data = $item->parseData();
                                    @endphp

                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Status Penerimaan</td>
                                                <td>:</td>
                                                <td>
                                                    @if(strtolower($data['status']) == 'layak')
                                                        <span class="badge badge-success">{{ $data['status'] }}</span>
                                                    @elseif(strtolower($data['status']) == 'tidak layak')
                                                        <span class="badge badge-danger">{{ $data['status'] }}</span>
                                                    @endif
                                                </td>
                                            </tr>

                                            @foreach($data['data'] as $key => $value)
                                                <tr>
                                                    <td>{{ $key }}</td>
                                                    <td>:</td>
                                                    <td>{{ $value }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $('.datatables').DataTable()
</script>
@endpush
