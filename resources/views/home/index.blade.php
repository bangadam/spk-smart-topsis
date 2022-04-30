@extends('home.layouts.app')

@section('content')
<!-- Masthead-->
<header class="masthead">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    <!-- Page heading-->
                    <h1 class="mb-5">Sistem Informasi Bantuan Sosial Tunai Covid-19</h1>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="#check-data" class="btn btn-primary btn-lg ">Cek data penerima bantuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Icons Grid-->
<section class="features-icons bg-light" id="check-data">
    <div class="container">
        {!! Form::open(['route' => 'dss.store']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class=" text-center features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                    <div class="features-icons-icon d-flex"><i class="bi bi-search m-auto text-primary"></i></div>
                    <h3>Cek Data Anda</h3>
                    <p class="lead mb-0">cek data penerima bantuan sosial tunai covid-19 disini</p>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('no_ktp', "Masukkan Nomor KTP anda:") !!}
                            {!! Form::number('no_ktp', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('no_kk', "Masukkan Nomor Kartu Keluarga anda:") !!}
                            {!! Form::number('no_kk', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group mt-2 d-grid ">
                            {!! Form::submit('Cek Data', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>
<!-- Image Showcases-->
<section class="showcase">
    <div class="container-fluid p-2">
        <div class="row g-0">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{asset('home/img/bg-showcase-1.png')}}')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2>Tentang Sistem Informasi Bantuan Sosial Tunai Covid-19</h2>
                <p class="lead mb-0">Sistem Informasi Bantuan Sosial Tunai Covid-19 adalah sistem yang dikembangkan untuk memastikan distribusi Bantuan Sosial Tunai Covid-19 tepat sasaran.
                </p>
                <p class="lead mb-1"> Mekanisme ini dilakukan dengan memetakan warga yang membutuhkan melalui verifikasi dari tingkat kelurahan dan puskessos untuk mendata warga terdampak dengan dokumen kependudukan yang sah (KTP dan KK)</p>
                <p class="lead mb-1">
                    Dengan adanya sistem ini diharapkan agar seluruh kuota bantuan sosial yang ada tepat sasaram, tidak ada penerima ganda serta dapat membantu kesulitan warga, terutama dengan adanya dampak Covid-19</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{asset('home/img/bg-showcase-2.png')}}')"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2>Siapa yang berhak mendapatkan bantuan sosial tunai covid-19 ?</h2>
                <ul class="list-group">
                    <li class="list-group-item">Keluarga Prasejahtera</li>
                    <li class="list-group-item">Tenaga Kerja yang di PHK</li>
                    <li class="list-group-item">Masyarakat tedampak Covid-19</li>
                    <li class="list-group-item">Masyarakat tedampak ekonomi secara signifikan</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials-->
<section class="testimonials text-center bg-light">
    <div class="container">
        <h2 class="mb-5">What people are saying...</h2>
        <div class="row">
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="{{asset('home/img/testimonials-1.jpg')}}" alt="..." />
                    <h5>Margaret E.</h5>
                    <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="{{asset('home/img/testimonials-2.jpg')}}" alt="..." />
                    <h5>Fred S.</h5>
                    <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                    <img class="img-fluid rounded-circle mb-3" src="{{asset('home/img/testimonials-3.jpg')}}" alt="..." />
                    <h5>Sarah W.</h5>
                    <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
