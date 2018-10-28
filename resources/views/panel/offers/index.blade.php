@extends('panel.layout')

@section('js')
<script type="text/javascript">
  $(document).on('show.bs.modal', '#offer-text-modal', function(event) {
    var link = $(event.relatedTarget);
    var modal = $(this);
    var resource = link.data('resource');
    modal.find('.description').html(resource.description);
  });
</script>
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      صفحة العروض
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
      <li class="active">العروض</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">العروض</h3>
        <div class="box-tools pull-right">
          <button class="btn-link" data-toggle="modal" data-target="#offer-cu-modal" data-href="{{ action('OffersController@store') }}" data-method="POST" >إضافة</button>
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <th class="text-center col-md-3">عنوان العرض</th>
                <th class="text-center col-md-1">السعر القديم</th>
                <th class="text-center col-md-1">السعر الجديد</th>
                <th class="text-center col-md-2">بداية العرض</th>
                <th class="text-center col-md-2">نهاية العرض</th>
                <th class="text-center col-md-1">الصورة</th>
                <th class="col-md-1 text-center">التفاصيل</th>
                <th class="text-center col-md-1" >خيارات</th>
              </thead>
              <tbody>
                @if($posts->isEmpty())
                <tr>
                  <td colspan="7" class="text-center">لا يوجد أي بيانات للعرض</td>
                </tr>
                @endif
                @foreach($posts as $post)
                <tr>
                  <td class="text-center">{{data_get($post->data,'title')}}</td>
                  <td class="text-center">{{data_get($post->data,'old_salary')}}</td>
                  <td class="text-center">{{data_get($post->data,'new_salary')}}</td>
                  <td class="text-center">{{data_get($post,'start_date')}}</td>
                  <td class="text-center">{{data_get($post,'end_date', 'حتى نفاذ الكمية')}}</td>
                  <td class="text-center"><a rel="lightbox" href="{{$post->image_url}}">عرض الصورة</a></td>
                  <td class="text-center">
                    <a href="#" data-href="" class="text-primary" data-toggle="modal" data-method="GET" data-resource="{{ htmlentities($post->value) }}" data-target="#offer-text-modal" rel="tooltip" title="تفاصيل العرض" data-placement="top" >التفاصيل</a>
                  </td>
                  <td class="text-center">
                    <a href="#" data-href="{{ action('OffersController@update', array($post->id))}}" class="text-primary" data-toggle="modal" data-method="PUT" data-resource="{{ htmlentities($post->value) }}" data-target="#offer-cu-modal" rel="tooltip" title="تعديل" data-placement="top" ><i class="fa fa-edit"></i></a>

                    <a href="#" data-href="{{ action('OffersController@destroy', $post->id)}}" class="text-danger" data-toggle="modal" data-target="#delete-confirmation-modal" rel="tooltip" title="حذف" data-placement="top" ><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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


<div class="modal fade dynamic-modal" id="offer-cu-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{action('OffersController@store') }}"  enctype="multipart/form-data" >
       {!! csrf_field() !!}
       <input name="_method" type="hidden" value="POST">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">إضافة / تعديل العرض</h4>
      </div>
      <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="control-label">عنوان العرض </label>
          <input type="text"  class="form-control"  name="title"  placeholder="عنوان العرض " required="required" />
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">السعر القديم</label>
              <input type="text"  class="form-control " name="old_salary" placeholder="السعر القديم" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">السعر الجديد</label>
              <input type="text"  class="form-control " name="new_salary" placeholder="السعر الجديد" />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">تفاصيل العرض</label>
          <textarea rows="5" class="form-control" name="description"  placeholder="تفاصيل العرض" required="required"></textarea>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">تاريخ البداية</label>
              <input type="text" data-rel='end_date' data-fn='setStartDate' class="form-control datepicker" name="start_date" placeholder="تاريخ بداية العرض" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">تاريخ نهاية العرض</label>
              <input type="text" data-rel='start_date' data-fn='setEndDate'class="form-control datepicker" name="end_date" placeholder="تاريخ نهاية العرض" />
            </div>
          </div>
        </div>
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

<div class="modal fade" id="offer-text-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">تفاصيل العرض</h4>
      </div>
      
      <div class="modal-body">
        <div class="description"></div>
      </div>
    </div>
  </div>
</div>
@stop