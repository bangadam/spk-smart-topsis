<div class="form-group col-sm-12">
    {!! Form::label('period_id', 'Pilih Periode proses:') !!}
    {!! Form::select('period_id', $periods, null, ['class' => 'form-control', 'placeholder' => 'pilih', 'id' => 'select-period']) !!}
</div>

<div class="form-group col-sm-2">
    <a href="#!" id="btn-ambil-dataset" class="btn btn-warning" disabled>Ambil Dataset</a>
</div>

{{-- <div class="col-sm-12 mb-3">
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div> --}}
