<style>
  .slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
  }

  .slider {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    white-space: nowrap;
    scrollbar-width: none;
    /* Hide scrollbar */
  }

  .slider::-webkit-scrollbar {
    display: none;
  }

  .slide {
    flex: 0 0 auto;
    /* Jangan mengecil */
    width: 300px;
  }

  .slide img {
    width: 100%;
    user-select: none;
    pointer-events: none;
  }
</style>
<?php use Carbon\Carbon; ?>
@extends('layouts.app')
@section('title', 'Noosa - SNBT')
@section('breadcrumb')
  <h1>Dashboard</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Selamat datang</li>
  </ol>
  <div><br></div>
  <div class="slider-container">
    <div class="slider">
      <div class="slide"><img src="{{ url('/assets/img/ongoing1.png') }}" class="mr-4 h-11" alt="Slide 1"></div>
      <div class="slide"><img src="{{ url('/assets/img/ongoing1.png') }}" class="mr-4 h-11" alt="Slide 1"></div>
      <div class="slide"><img src="{{ url('/assets/img/ongoing1.png') }}" class="mr-4 h-11" alt="Slide 1"></div>
      <div class="slide"><img src="{{ url('/assets/img/ongoing1.png') }}" class="mr-4 h-11" alt="Slide 1"></div>
      <div class="slide"><img src="{{ url('/assets/img/ongoing1.png') }}" class="mr-4 h-11" alt="Slide 1"></div>
      <div class="slide"><img src="{{ url('/assets/img/ongoing1.png') }}" class="mr-4 h-11" alt="Slide 1"></div>
    </div>
  </div>
  <div><br></div>
@endsection
@section('content')
  <?php include(app_path().'/functions/myconf.php'); ?>
  @if(Auth::user()->status == 'A')
    <div class="callout callout-info">
      <h4>Hai, <b>{{ Auth::user()->nama }} (Admin)</b></h4>
    </div>
  @endif
  @if(Auth::user()->status == 'A' || Auth::user()->status == 'G')
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-light">
                <i class="fa fa-desktop" style="color: gray;"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Try Out</span>
                <span class="info-box-number" style="font-size: 24px; font-weight: bold;">{{ number_format($gurus) }}</span>
                <hr>
                <a href="#" style="color: blue; text-decoration: none;">Akses Try Out SNBT</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-light">
                <i class="fa fa-book" style="color: gray;"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Materi</span>
                <span class="info-box-number" style="font-size: 24px; font-weight: bold;">{{ number_format($gurus) }}</span>
                <hr>
                <a href="#" style="color: blue; text-decoration: none;">Akses Modul Belajar</a>
                <hr>
                <a href="#" style="color: blue; text-decoration: none;">Akses Video Belajar</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-light">
                    <i class="fa fa-user-check" style="color: gray;"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Lulus Try Out</span>
                    <span class="info-box-number" style="font-size: 24px; font-weight: bold;">{{ number_format($gurus) }}</span>
                    <hr>
                    <a href="#" style="color: blue; text-decoration: none;">Lihat Semua Pembahasan</a>
                    <hr>
                    <a href="#" style="color: blue; text-decoration: none;">Lihat Peringkat Nasional</a>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Paket soal</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-hover table-striped" id="table_soal">
            @if (Auth::user()->status == 'G')
              <caption>Data paket soal yang Anda buat</caption>
            @else
              <caption>Data paket soal</caption>
            @endif
            <thead>
              <tr>
                <th>Nama Paket</th>
                <th>Deskripsi</th>
                <th>Jenis</th>
                <th style="text-align: center;">KKM</th>
                <th style="text-align: center; width: 70px">Waktu</th>
                <th style="text-align: center; width: 110px">Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Aktifitas Terkini</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            @if($aktifitas->count())
            @foreach($aktifitas as $data_aktifitas)
            <li class="item">
              <div class="product-img">
                @if($data_aktifitas->dataAktifitasUser->gambar != "")
                <img src="{{ url('/assets/img/user/'.$data_aktifitas->dataAktifitasUser->gambar) }}" alt="user img">
                @else
                <img src="{{ url('/assets/img/noimage.jpg') }}" alt="user img">
                @endif
              </div>
              <div class="product-info">
                <a href="javascript:void(0)" class="product-title">{{ $data_aktifitas->dataAktifitasUser->nama }}
                  <span class="label label-warning pull-right">{{ $data_aktifitas->created_at->diffForHumans() }}</span>
                </a>
                <span class="product-description">
                  {{ $data_aktifitas->nama }}
                </span>
              </div>
            </li>
            @endforeach
            @endif
          </ul>
          <a href="{{ url('/activity') }}" class="btn btn-info btn-sm btn-block">Selengkapnya</a>
        </div>
      </div>
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title" style="color: coral"><i class="fa fa-info-circle"></i> Informasi</h3>
        </div>
        <div class="box-body">
          <p>Terimakasih telah menggunakan website ujian (<b>Noosa SNBT</b>) ini.</i>.</p>
        </div>
      </div>
    </div>
  @else
    <div class="alert" style="background: #fff; border: solid thin #d8d5d5;">
      <p>Hai {{ Auth::user()->nama }}, Selamat datang di Noosa SNBT. Disini kamu bisa temukan materi yang telah disiapkan serta mengerjakan soal latihan dan ujian.</p>
      <p>Pantau perkembangan kamu dengan melihat nilai-nilai latihan dan ujian dengan cepat.</p>
    </div>
  @endif
@endsection
@push('css')
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css')}}">
@endpush
@push('scripts')
  <script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>
  <script>
  $(document).ready(function (){
    table_soal = $('#table_soal').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      lengthChange: true,
      ajax: {
        url: '{!! route('elearning.get-soal-home') !!}',
        
      },
      columns: [
        {data: 'paket', name: 'paket', orderable: true, searchable: true },
        {data: 'deskripsi', name: 'deskripsi', orderable: true, searchable: true },
        {data: 'jenis', name: 'jenis', orderable: true, searchable: true },
        {data: 'kkm', name: 'kkm', orderable: true, searchable: true },
        {data: 'waktu', name: 'waktu', orderable: true, searchable: true },
        {data: 'action', name: 'action', orderable: false, searchable: false, },
      ],
      "drawCallback": function (setting) {}
    });
    $("#btn-wrap-info").click(function() {
      $(this).hide();
      $("#wrap-info").show();
    });
  });
  </script>
  <script>
  const slider = document.querySelector(".slider");
  let isDown = false;
  let startX, scrollLeft;

  // Dragging dengan mouse
  slider.addEventListener("mousedown", (e) => {
    isDown = true;
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
    slider.style.cursor = "grabbing";
  });

  slider.addEventListener("mouseleave", () => {
    isDown = false;
    slider.style.cursor = "grab";
  });

  slider.addEventListener("mouseup", () => {
    isDown = false;
    slider.style.cursor = "grab";
  });

  slider.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 2;
    slider.scrollLeft = scrollLeft - walk;
  });

  // Swipe dengan Touchscreen
  slider.addEventListener("touchstart", (e) => {
    startX = e.touches[0].pageX;
    scrollLeft = slider.scrollLeft;
  });

  slider.addEventListener("touchmove", (e) => {
    const x = e.touches[0].pageX;
    const walk = (x - startX) * 2;
    slider.scrollLeft = scrollLeft - walk;
  });
</script>
@endpush