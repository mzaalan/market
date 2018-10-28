@extends('panel.layout')
@section('js')
  <script type="text/javascript">
    $(document).on('show.bs.modal', '#message-text-modal', function(event) {
      var link = $(event.relatedTarget);
      var modal = $(this);
      var resource = link.data('resource');
      modal.find('.description').html(resource.message);
    });
  </script>
@stop
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        رسائل الزوار
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> الرئيسة</a></li>
          <li class="active">رسائل الزوار</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="box box-solid">
          
          <div class="box-body">
            <div class="table-responsive">
              <div class="table-responsive">
                  <table class="table table-hover">
                  <thead>
                    <th>الاسم</th>
                    <th>نص الرسالة</th>
                    <th>رقم الجوال</th>
                    <th>الحالة</th>
                    <th class="text-center col-md-2">خيارات</th>
                  </thead>
                  <tbody>
                    @if($posts->isEmpty())
                        <tr>
                          <td colspan="5" class="text-center">لا يوجد أي بيانات للعرض</td>
                        </tr>
                      @endif
                    @foreach($posts as $post)
                      <tr>
                        <td>{{ data_get($post->data,'name') }}</td>
                        <td>
                          <a href="#" data-href="" class="text-primary" data-toggle="modal" data-method="GET" data-resource="{{ htmlentities($post->value) }}" data-target="#message-text-modal" rel="tooltip" title="عرض الرسالة" data-placement="top" >عرض الرسالة</a>
                        </td>
                        <td>{{ data_get($post->data,'mobile') }}</td>
                        <td>
                          <span class="label label-{{ $post->is_active == 1 ? 'danger':'success'}}">
                            {{ $post->is_active == 1 ? 'غير مجاب':'مجاب'}}
                          </span>
                        </td>
                        <td class="text-center">      
                        @if($post->is_active == 1)
                          <a href="#" class="text-success" data-toggle="modal" data-target="#answered-confirmation" rel="tooltip" title="التحويل لمجابة" data-resource="{{ htmlentities($post->value) }}" data-method="PUT" data-href="{{ action('ContactController@update', $post->id)}}">
                            <i class="fa fa-check"></i>
                          </a>
                        @else
                          <a href="#" class="text-danger" data-toggle="modal" data-target="#unanswered-confirmation" rel="tooltip" title="التحويل لغير مجاب"  data-resource="{{ htmlentities($post->value) }}" data-method="PUT" data-href="{{ action('ContactController@update', $post->id)}}">
                            <i class="fa fa-times"></i>
                          </a>
                        @endif                    
                          <a href="#" data-href="{{ action('ContactController@destroy', $post->id)}}" class="text-danger" data-toggle="modal" data-target="#delete-confirmation-modal" rel="tooltip" title="حذف" data-placement="top" ><i class="fa fa-trash-o"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="text-center">
              {{ $posts->render() }}
            </div>
          </div>
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->



<div class="modal fade dynamic-modal" id="unanswered-confirmation">
  <div class="modal-dialog">
    <div class="modal-content ajax-form-container">
      <form action="/" method="POST">
      {!! csrf_field() !!}
      <input name="_method" type="hidden" value="PUT">
      <input name="is_active" type="hidden" value="1">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">التواصل مع الزبائن</h4>
      </div>
       <div class="alert callout fade in hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
              <p>سيتم تحويل حالة الرسالة الى غير مجابة , هل تريد تأكيد العملية</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">موافق</button>
        <button class="btn btn-default" data-dismiss="modal" type="reset">الغاء الامر</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade dynamic-modal" id="answered-confirmation">
  <div class="modal-dialog">
    <div class="modal-content ajax-form-container">
      <form action="/" method="POST">
      {!! csrf_field() !!}
      <input name="_method" type="hidden" value="PUT">
      <input name="is_active" type="hidden" value="0">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">التواصل مع الزبائن</h4>
      </div>
      <div class="alert callout fade in callout-danger hidden">
        <h5 class="h4"></h5>
        <ul class="list-unstyled">
        </ul>
      </div>
      <div class="modal-body">
        <p>سيتم تحويل الرسالة الى مجابة , هل تريد اتمام العملية ؟</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">موافق</button>
        <button class="btn btn-default" data-dismiss="modal" type="reset">الغاء الامر</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="message-text-modal">
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