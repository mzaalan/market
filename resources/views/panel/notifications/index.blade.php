@extends('panel.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      الإشعارات
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
      <li class="active">الإشعارات</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">الإشعارات</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-primary" data-toggle="modal" data-target="#service-cu-modal" data-href="{{action('NotificationsController@store') }}" data-method="POST" >إضافة</button>
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <th>نص الإشعار</th>
              <th class="text-center col-md-2">خيارات</th>
            </thead>
            <tbody>
              @if($posts->isEmpty())
              <tr>
                <td colspan="3" class="text-center">لا يوجد أي بيانات للعرض</td>
              </tr>
              @endif
              @foreach($posts as $post)
              <tr>
                <td>{{ data_get($post->data,'message') }}</td>
                <td class="text-center">
                  <a href="#" data-href="{{ action('NotificationsController@update', array($post->id))}}" class="text-primary" data-toggle="modal" data-method="PUT" data-resource="{{ htmlentities($post->value) }}" data-target="#service-cu-modal" rel="tooltip" title="تعديل" data-placement="top" ><i class="fa fa-edit"></i></a>

                  <a href="#" data-href="{{ action('NotificationsController@destroy', $post->id)}}" class="text-danger" data-method="DELETE" data-toggle="modal" data-target="#delete-confirmation-modal" rel="tooltip" title="حذف" data-placement="top" ><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="col-md-12">
          <center>
            {{ $posts->links()}}
          </center>
        </div>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade dynamic-modal" id="service-cu-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST"  action="{{action('NotificationsController@store')}}" />
      {!! csrf_field() !!}
      <input name="_method" type="hidden" value="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">إضافة / تعديل اشعار</h4>
      </div>
      <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="control-label">نص الإشعار</label>
          <input type="text" class="form-control" name="message"  placeholder="نص الإشعار" required="required" />
          <input type="hidden" name="type" value="notification" />
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