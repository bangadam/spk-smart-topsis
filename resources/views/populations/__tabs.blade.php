{{-- tabs --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Data Penduduk</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Keadaan Penduduk</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            @include('populations.__fields')
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            @include('populations.__conditions')

                            {{-- button save --}}
                            <div class="col-sm-12">
                                <div class="float-right">
                                    {{-- back --}}
                                    <a href="{{ route('populations.index') }}" class="btn btn-default">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                    {!! Form::submit('Simpan', ['class' => 'btn bnt-block btn-primary']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
