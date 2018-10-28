@extends('panel.layout')

@section('js')
<script src="{{ asset('assets/js/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/dropzone-config.js') }}"></script>
<script type="text/javascript">
$( ".sortable" ).sortable({
    revert: true,
    cursor: "move",
    forcePlaceholderSize: true,
    forceHelperSize: true,
    handle: ".segment-move",
    helper: "clone",
    items: ".admin-gall-box",
    start: function(event, ui) {
        $(this).addClass('processing');
        ui.placeholder.height(ui.item.height());
    },
    stop: function (event, ui) {
        $(this).removeClass('processing');
        var orders = $(this).find('div.admin-gall-box').map(function(){
            return $(this).data('id');
        });

        orders = orders.get();
        if(orders.length == 0){
            return;
        }
        page = '{{$posts->currentPage()}}';
        per_page = '{{$posts->perPage()}}';
        $.post('{{action('PhotoController@store')}}', { 'ids': orders , 'page' : page , 'per_page' : per_page ,'_token' : '{{csrf_token()}}'  });

    }
}).disableSelection();
</script>
@stop
@section('content')  
<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">
 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        {{$magazine->title}}
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
          <li class="active">صور العدد</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
<!-- Dropzone Preview Template -->
    <div id="preview-template11" style="display: none;">

        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img data-dz-thumbnail=""></div>

            <div class="dz-details">
                <div class="dz-size"><span data-dz-size=""></span></div>
                <div class="dz-filename"><span data-dz-name=""></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

            

            

        </div>
    </div>
    <!-- End Dropzone Preview Template -->
<div id="preview-template" style="display: none;">
      <div class="col-md-4 no-right-padding admin-gall-box" data-id="">
                        <div >

                        <div class="panel panel-primary">
                        
                        <div class="panel-body">
                        <a class="segment-move  fa fa-arrows hide" title="Move"></a>
                        <div class="panel-body-img red-border ">

                        <div class="dz-image">
                        <a  rel="lightbox2[group]" href="{{asset('img/loading.gif')}}"  >
                        <img data-dz-thumbnail="">
                        </a>
                        </div>
                        
                        
                        <!--/********************/-->
                        <div class="col-md-12 gall-edit hide">
                        <button  class="btn btn-default btn-table remove-img" data-href="{{ action('MagazineImageController@destroy', 1)}}" class="text-danger" data-toggle="modal" data-target="#delete-confirmation-modal"  > 
                        <i class="fa fa-times "> </i>   </button>                        


                        
                        </div>
                        <div id="loading">
                          <div id="loading-content">
                            <img src="{{asset('img/loading.gif')}}" />
                          </div>
                        </div>

                        </div>

                        </div>
                        

                        <div class="clearfix"></div>
                        </div>
                        </div>

                        </div>    
</div>





      <!-- ******************************************** -->
            
                        
                         <div class="dz-message">

                </div>

                

                

                 <div class="col-md-12 no-right-padding admin-gall-box" >
                        <div >

                        <div class="panel panel-primary">
                        

                        <div class="panel-body">
                        <form method="POST" action="{{action('MagazineImageController@store') }}" class="dropzone dash-border" enctype="multipart/form-data" id='real-dropzone'>
                            {!! csrf_field() !!}
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                        <div class="dz-default dz-message new-div">
                                <div class="plus">
                                      <div class="plus_img"></div>اضافة صورة جديدة
                                      <input type="hidden" name="parent_id" value="{{$magazine->id}}">
                                </div>
                        </div>
                        </form>

                        </div>
                        

                        <div class="clearfix"></div>
                        </div>
                        </div>

                        </div>  
                        <div class="dropzone-previews sortable col-md-12" id="dropzonePreview">
                        @foreach($posts as $post)
                        <div class="col-md-4 no-right-padding admin-gall-box" data-id="{{$post->id}}">
                        <div >

                        <div class="panel panel-primary">
                        
                        <div class="panel-body">
                        <a class="segment-move green-color fa fa-arrows" title="Move"></a>
                        <div class="panel-body-img red-border ">
                        <a  rel="lightbox2[group]" href="{{$post->image_url}}"  >

                        <img src="{{$post->image_url}}" class="img-responsive" alt="">
                        <div class="clearfix"></div>
                        </a>
                        
                        
                        <!--/********************/-->
                        <div class="col-md-12 gall-edit">
                        <button class="btn btn-default btn-table" data-href="{{ action('MagazineImageController@destroy', $post->id)}}" class="text-danger" data-toggle="modal" data-target="#delete-confirmation-modal"  > 
                        <i class="fa fa-times "> </i>   </button>


                        
                        </div>
                        
                        </div>

                        </div>
                        

                        <div class="clearfix"></div>
                        </div>
                        </div>

                        </div>    
                        @endforeach
                        </div>
      </section>
      <div class="row" style="margin: auto;">
          <div class="col-md-12">
              <center>
                  {{ $posts->links()}}
              </center>
          </div>
        </div>
</div>
@stop