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

            {!! Form::open(['route' => 'dss.store', 'id' => 'form-dss']) !!}

            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 mb-5">
                        <h3>
                            <i class="fas fa-info-circle"></i>
                            {{$periods->title .' - Kuota ('.  $periods->quota .') Orang'}}
                        </h3>
                    </div>

                    <div class="col-sm-12 mb-3">
                        {!! Form::label('table_dataset', '1. Daftar Calon Penerima:') !!}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-dataset">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataset as $key => $item)
                                        <tr>
                                            <td>{{++$loop->index}}</td>
                                            <td>{{ $item['name'] }}</td>
                                            @foreach ($item['population_assesment_detail'] as $value)
                                                <td>{{ $value->value }}</td>
                                            @endforeach
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

                    <div class="col-sm-12 mb-3">
                        {!! Form::label('table_utility', '2. Nilai Utility:') !!}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-utility">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $verticalToHorizontal = App\Services\SmartTopsisService::verticalToHorizontal($utility);
                                    @endphp
                                    @forelse ($alternatif_name as $key => $item)
                                        <tr>
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$item}}</td>

                                            @forelse ($verticalToHorizontal[$key] as $value)
                                                <td>{{$value}}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="text-bold bg-secondary">
                                    <tr>
                                        <td colspan="2">Total</td>
                                        @foreach($total_utility as $value)
                                            <td>{{$value}}</td>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3">
                        {!! Form::label('table-akar-normalisasi', '3. Pembagian Hasil Akar Nilai Normalisasi dengan normalisasi matrik:') !!}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-akar-normalisasi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $verticalToHorizontal = App\Services\SmartTopsisService::verticalToHorizontal($result_normalized_root);
                                    @endphp
                                    @forelse ($alternatif_name as $key => $item)
                                        <tr>
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$item}}</td>

                                            @forelse ($verticalToHorizontal[$key] as $value)
                                                <td>{{$value}}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="text-bold bg-secondary">
                                    <tr>
                                        <td colspan="2">Total</td>
                                        @foreach($total_utility as $value)
                                            <td>{{$value}}</td>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                    <div class="col-sm-12 mb-3">
                        {!! Form::label('table-normalisasi-bobot', '4. Perhitungan Nilai Hasil Normalisasi Pembobotan:') !!}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-normalisasi-bobot">
                                <thead>
                                    <tr>
                                        <th>Positif</th>
                                        <th>A+</th>
                                        <th>Negatif</th>
                                        <th>A-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($result_solution as $key => $item)
                                        <tr>
                                            <td>Y{{++$loop->index}}+</td>
                                            <td class="bg-secondary">{{$item['max']}}</td>
                                            <td>Y{{++$loop->index}}-</td>
                                            <td class="bg-secondary">{{$item['min']}}</td>
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

                    <div class="col-sm-12 mb-3">
                        {!! Form::label('table-jarak-alternatif', '5. Jarak antara nilai setiap alternatif:') !!}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-jarak-alternatif">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jarak Alternatif</th>
                                        <th>Positif(+)</th>
                                        <th>Negatif(-)</th>
                                        <th>D+ + D-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $positif = $result_distance['solusi_ideal_positif'];
                                        $negatif = $result_distance['solusi_ideal_negatif'];
                                        $distance = $result_distance['distance'];
                                    @endphp
                                    @forelse ($alternatif_name as $key => $item)
                                        <tr>
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$item}}</td>
                                            <td>{{$positif[$key]}}</td>
                                            <td>{{$negatif[$key]}}</td>
                                            <td>{{$distance[$key]}}</td>
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

                    <div class="col-sm-12 mb-3">
                        {!! Form::label('table-rangking', '6. Hasil Perangkingan:') !!}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-rangking">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jarak Alternatif</th>
                                        <th>V</th>
                                        <th>Ranking</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($result_ranking as $key => $item)
                                    @php
                                        $number = ++$loop->index;
                                    @endphp
                                        <tr>
                                            <td>{{$number}}</td>
                                            <td>{{$item['nama_alternatif']}}</td>
                                            <td>{{$item['nilai_v']}}</td>
                                            <td>{{$number}}</td>
                                            <td>{{$item['status']}}</td>
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

            </div>

            {{-- input --}}
            <input type="hidden" name="result_ranking" value="{{json_encode($result_ranking)}}">
            <input type="hidden" name="period_id" value="{{request()->query('period_id')}}">

            <div class="card-footer">
                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('dss.index') }}" class="btn btn-default">Batal</a>
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
            $('#table-rangking').DataTable()
            $('#table-normalisasi-bobot').DataTable()
            $('#table-akar-normalisasi').DataTable()
            $('#table-jarak-alternatif').DataTable()
        })
    </script>
@endpush
