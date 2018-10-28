@extends('panel.layout')

@section('js')
<script src="{{ asset('build/assets/js/jquery-file-upload/jquery.fileupload.js') }}"></script>
<script type="text/javascript">
  $('.upload').on('click',function(){
       $('#magazine-bg').click();
       return false;
  });
  $('#magazine-bg').fileupload({
      url: '{{action("MagazineBGController@upload",$bg->id) }}',
      dataType: 'json',
      autoUpload: true,
      limitMultiFileUploads: 1,
      acceptFileTypes: /(\.|\/)(jpe?g|png)$/i,
      maxNumberOfFiles: 1,
      done: function (e, data) {
          location.reload();
      },
      submit: function(e, data){
        $('#loading').toggleClass('hide');
      }
  });
</script>
@stop

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
المجلة الدورية
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
      <li class="active">المجلة الدورية - الصورة الرئيسية</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" id="up-section">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">الصورة الرئيسية</h3>
        <div class="box-tools pull-right">
            <form method="POST" action="{{action('MagazineBGController@upload',$bg->id) }}" enctype="multipart/form-data" >
                {!! csrf_field() !!}
                <div class="hide">
                    <input name="file" id="magazine-bg" type="file" />
                </div>
            </form> 
            <button class="btn-link upload">تعديل الصورة</button> 
        </div>
      </div>
      <div class="box-body">
        <div class="col-md-8 col-md-offset-2">
          <img src="{{ $bg->url }}" class="img-responsive"/>
        </div>
      </div>
      <div id="loading" class="hide">
        <div id="loading-content" class="col-md-8 col-md-offset-2">
          <img src="{{asset('img/loading.gif')}}" />
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


@stop