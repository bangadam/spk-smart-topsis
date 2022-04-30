@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if(auth()->user()->hasRole('admin'))
            @include('dashboard.__admin')
        @elseif(auth()->user()->hasRole('surveyor'))
            @include('dashboard.__surveyor')
        @elseif(auth()->user()->hasRole('receiver'))
            @include('dashboard.__receiver')
        @endif
    </div>
    <!-- /.container-fluid -->
 </section>
 <!-- /.content -->

@endsection

@push('third_party_scripts')
<script src="{{asset('dashboard.js')}}"></script>
@endpush

