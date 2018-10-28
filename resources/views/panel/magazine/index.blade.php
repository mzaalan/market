@extends('panel.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
المجلة الدورية
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
      <li class="active">المجلة الدورية</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title">الأعداد</h3>
        <div class="box-tools pull-right">
          <button class="btn-link" data-toggle="modal" data-target="#magazine-cu-modal" data-href="{{ action('MagazineController@store') }}" data-method="POST" >إضافة</button>
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <div class="table-responsive">
              <table class="table table-hover">
              <thead>
                <th>العدد</th>
                <th>عدد الصفحات</th>
                <th>الحالة</th>
                <th class="text-center" >خيارات</th>
              </thead>
              <tbody>
                @if($posts->isEmpty())
                    <tr>
                      <td colspan="3" class="text-center">لا يوجد أي بيانات للعرض</td>
                    </tr>
                  @endif
                @foreach($posts as $post)
                  <tr>
                    <td><a href="{{ action('MagazineController@show', array($post->id))}}">
                      {{ data_get($post->data,'title') }}</a>
                    </td>
                    <td>{{$post->images->count()}}</td>
                    <td>
                      <span class="label label-{{ $post->is_active == 0 ? 'danger':'success'}}">
                        {{ $post->is_active == 1 ? 'منشور':'غير منشور'}}
                      </span>
                    </td>
                    <td class="text-center">
                      @if($post->is_active == 0)
                        <a href="#" class="text-success" data-toggle="modal" data-target="#activate-confirmation" rel="tooltip" title=" نشر المجلة" data-resource="{{ htmlentities($post) }}" data-method="POST" data-href="{{ action('MagazineController@activate', $post->id)}}">
                          <i class="fa fa-check"></i>
                        </a>
                      @else
                        <a href="#" class="text-danger" data-toggle="modal" data-target="#deactivate-confirmation" rel="tooltip" title=" إلغاء النشر"  data-resource="{{ htmlentities($post) }}" data-method="POST" data-href="{{ action('MagazineController@activate', $post->id)}}">
                          <i class="fa fa-times"></i>
                        </a>
                      @endif 
                      <a href="#" data-href="{{ action('MagazineController@update', array($post->id))}}" class="text-primary" data-toggle="modal" data-method="PUT" data-resource="{{ htmlentities($post->value) }}" data-target="#magazine-cu-modal" rel="tooltip" title="تعديل" data-placement="top" ><i class="fa fa-edit"></i></a>

                      <a href="#" data-href="{{ action('MagazineController@destroy', $post->id)}}" class="text-danger" data-toggle="modal" data-target="#delete-confirmation-modal" rel="tooltip" title="حذف" data-placement="top" ><i class="fa fa-trash-o"></i></a>
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


<div class="modal fade dynamic-modal" id="magazine-cu-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{action('MagazineController@store') }}"  enctype="multipart/form-data" >
        {!! csrf_field() !!}
        <input name="_method" type="hidden" value="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">التحكم بالأعداد</h4>
        </div>
        <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">عنوان العدد</label>
            <input type="text" class="form-control" name="title"  placeholder="عنوان العدد" required="required" />
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


<div class="modal fade dynamic-modal" id="activate-confirmation">
  <div class="modal-dialog">
    <div class="modal-content ajax-form-container">
      <form action="/" method="POST">
      {!! csrf_field() !!}
      <input name="_method" type="hidden" value="PUT">
      <input name="is_active" type="hidden" value="1">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">نشر المجلة</h4>
      </div>
       <div class="alert alert-danger callout fade in hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
              <p>عند قيامك بنشر المجله ستصبح متاحة لكافة المستخدمين , هل تريد المتايعه ؟</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">موافق</button>
        <button class="btn btn-default" data-dismiss="modal" type="reset">الغاء الامر</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade dynamic-modal" id="deactivate-confirmation">
  <div class="modal-dialog">
    <div class="modal-content ajax-form-container">
      <form action="/" method="POST">
      {!! csrf_field() !!}
      <input name="_method" type="hidden" value="PUT">
      <input name="is_active" type="hidden" value="0">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">إالغاء تفعيل المجله</h4>
      </div>
      <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
        <p>سيتم تحويل حالة المجلة الى غير فعالة و لن يتمكن المستخدمين من رؤيتها الا في حال اعادة نشرها , هل تريد المتابعه ؟</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">موافق</button>
        <button class="btn btn-default" data-dismiss="modal" type="reset">الغاء الامر</button>
      </div>
      </form>
    </div>
  </div>
</div>
@stop