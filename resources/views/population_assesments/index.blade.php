@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Riwayat Penilian</h1>
            </div>
            <div class="col-sm-6">
                {{-- <a class="btn btn-primary float-right"
                    href="{{ route('populationAssesments.create', ['population_id' => request()->query('population_id')]) }}">
                    Tambah Baru
                </a> --}}
                <a class="btn mr-2 btn-default float-right" href="{{ route('populations.index') }}">
                    Kembali
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
            @include('population_assesments.table')

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
