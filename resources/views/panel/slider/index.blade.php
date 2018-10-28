@extends('panel.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      صفحة صور السلايدر
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
      <li class="active">صور السلايدر</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">صور السلايدر</h3>
        <div class="box-tools pull-right">
          <button class="btn-link" data-toggle="modal" data-target="#slide-cu-modal" data-href="{{ action('SliderController@store') }}" data-method="POST" >إضافة</button>
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <div class="table-responsive">
              <table class="table table-hover">
              <thead>
                <th>الصورة</th>
                <th class="text-center" >خيارات</th>
              </thead>
              <tbody>
                @if($posts->isEmpty())
                    <tr>
                      <td colspan="2" class="text-center">لا يوجد أي بيانات للعرض</td>
                    </tr>
                  @endif
                @foreach($posts as $post)
                  <tr>
                    <td><a rel="lightbox" href="{{$post->image_url}}">عرض الصورة</a></td>
                    <td class="text-center">
                      <a href="#" data-href="{{ action('SliderController@update', array($post->id))}}" class="text-primary" data-toggle="modal" data-method="PUT" data-resource="{{ htmlentities($post->value) }}" data-target="#slide-cu-modal" rel="tooltip" title="تعديل" data-placement="top" ><i class="fa fa-edit"></i></a>

                      <a href="#" data-href="{{ action('SliderController@destroy', $post->id)}}" class="text-danger" data-toggle="modal" data-target="#delete-confirmation-modal" rel="tooltip" title="حذف" data-placement="top" ><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade dynamic-modal" id="slide-cu-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{action('SliderController@store') }}"  enctype="multipart/form-data" >
       {!! csrf_field() !!}
        <input name="_method" type="hidden" value="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">إضافة / تعديل صورة</h4>
        </div>
        <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label">الصورة</label>
            <input type="file" class="form-control" name="file" accept=".png,.jpg,.jpeg" placeholder="اضغط لاختيار صورة توضيحية" />
            <p></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit"   class="btn btn-primary">حفظ</button>
          <button type="reset" data-dismiss="modal"  class="btn btn-default pull-left">إالغاء الأمر</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop