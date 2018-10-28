@extends('panel.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
المستخدمين
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
      <li class="active">المستخدمين</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-solid">
      <div class="box-header">
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
          <button class="btn-link" data-toggle="modal" data-target="#client-cu-modal" data-href="{{ action('UserController@store') }}" data-method="POST" >إضافة</button>
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>اسم المستخدم</th>
                <th>الاسم الظاهر</th>
                <th>الحالة</th>
                <th class="text-center">خيارات</th>
              </tr>
            </thead>
            <tbody>
              @if($users->isEmpty())
                <tr>
                  <td colspan="4" class="text-center">لا يوجد أي بيانات للعرض</td>
                </tr>
              @endif
              @foreach($users as $post)
              <tr>
                <td>{{ data_get($post,'username') }}</td>
                <td>{{ data_get($post,'name') }}</td>
                <td>
                  <span class="label label-{{ $post->is_active == 0 ? 'danger':'success'}}">
                    {{ $post->is_active == 1 ? 'فعال':'غير فعال'}}
                  </span>
                </td>
                <td class="text-center">
                   @if($post->is_active == 0)
                      <a href="#" class="text-success" data-toggle="modal" data-target="#activate-confirmation" rel="tooltip" title="الغاء تفعيل" data-resource="{{ htmlentities($post) }}" data-method="DELETE" data-href="{{ action('UserController@destroy', $post->id)}}">
                        <i class="fa fa-check"></i>
                      </a>
                    @else
                      <a href="#" class="text-danger" data-toggle="modal" data-target="#deactivate-confirmation" rel="tooltip" title="تفعيل"  data-resource="{{ htmlentities($post) }}" data-method="DELETE" data-href="{{ action('UserController@destroy', $post->id)}}">
                        <i class="fa fa-times"></i>
                      </a>
                    @endif       
                  <a href="#" data-href="{{ action('UserController@update', array($post->id))}}" data-readonly="true" class="text-primary" data-toggle="modal" data-method="PUT" data-resource="{{ htmlentities($post) }}" data-target="#client-cu-modal" rel="tooltip" title="تعديل" data-placement="top" ><i class="fa fa-edit"></i></a>

                  
              </tr>
               @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade dynamic-modal" id="client-cu-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST"  action="{{action('UserController@store')}}" />
         {!! csrf_field() !!}
        <input name="_method" type="hidden" value="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">إضافة / تعديل مستخدم</h4>
        </div>
        <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
        </div>
        <div class="modal-body">

          <div class="form-group">
              <label class="control-label">اسم المستخدم</label>
              <input type="text" class="form-control readonly" name="username"  placeholder="اسم المستخدم" required="required" />
          </div>
          <div class="form-group">
              <label class="control-label">الاسم الظاهر</label>
              <input type="text" class="form-control" name="name"  placeholder="الاسم الظاهر" required="required" />
          </div>
          <div class="form-group">
              <label class="control-label">كلمة المرور</label>
              <input type="password" class="form-control" name="password"  placeholder="كلمة المرور"  />
          </div>
          <div class="form-group">
              <label class="control-label">تأكيد كلمة المرور </label>
              <input type="password" class="form-control" name="repassword"  placeholder="تأكيد كلمة المرور" />
          </div>
          <div class="form-group">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="is_active"> فعال
              </label>
            </div>
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
        <h4 class="modal-title">تفعيل مستخدم</h4>
      </div>
       <div class="alert callout fade in hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
              <p>سيتم تحويل حالة المستخدم الى فعال , هل تريد المتايعه ؟</p>
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
        <h4 class="modal-title">إالغاء تفعيل مستخدم</h4>
      </div>
      <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
        <p>سيتم تحويل حالة المستخدم الى غير فعال, هل تريد المتابعة؟</p>
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

@section('js')
  <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@stop
