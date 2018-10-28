@extends('panel.layout')

@section('js')
<script src="{{ asset('assets/js/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/dropzone-config.js') }}"></script>
@stop
@section('content')  
<style>


</style>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        مجلة النقاط
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
          <li class="active">مجلة النقاط</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
<div id="preview-template" style="display: none;">
      <div class="col-md-4 no-right-padding admin-gall-box" >
                        <div >

                        <div class="panel panel-primary">
                        
                        <div class="panel-body">
                        <div class="panel-body-img red-border ">

                        <a  rel="lightbox2[group]" href="{{asset('img/scan.jpg')}}"  >

                        <img src="{{asset('img/scan.jpg')}}" class="img-responsive" alt="">
                        <div class="clearfix"></div>
                        </a>
                        
                        
                        <!--/********************/-->
                        <div class="col-md-12 gall-edit">
                        <button class="btn btn-default btn-table" data-href="{{ action('NotificationsController@destroy', 1)}}" class="text-danger" data-toggle="modal" data-target="#delete-confirmation-modal"  > 
                        <i class="fa fa-times "> </i>   </button>


                        
                        </div>
                        </div>

                        </div>
                        

                        <div class="clearfix"></div>
                        </div>
                        </div>

                        </div>    
</div>




    <div class="dropzone-previews" id="dropzonePreview"></div>

      <!-- ******************************************** -->
             <div class="col-md-4 no-right-padding admin-gall-box" >
                        <div >

                        <div class="panel panel-primary">
                        

                        <div class="panel-body">
                        <div class="panel-body-img dash-border ">
                        <form method="POST" action="{{action('NotificationsController@store') }}" class="dropzone" enctype="multipart/form-data" id='real-dropzone'>    
                          <div class="new-div">
                                <div class="plus">
                                      <div class="plus_img"></div>اضافة صورة جديدة
                                </div>
                                <input type="file" name="file" id="DocumentFile" class="upload fileUpload" multiple>
                          </div>
                        </form>
                        
                        
                        </div>

                        </div>
                        

                        <div class="clearfix"></div>
                        </div>
                        </div>

                        </div>      
      </section>
</div>
@stop