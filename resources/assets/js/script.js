$(document).ready(function(){
  $("a[rel^='lightbox']:visible").prettyPhoto( {  social_tools: false});
  $(".tooltips ").tooltip();
});

$(document).on('show.bs.modal', '#delete-confirmation-modal', function(event) {
  var link = $(event.relatedTarget);
  var modal = $(this);
  modal.find('form').attr('action', link.data('href'));
});

$(document).on('show.bs.modal', '.dynamic-modal', function(event) {
  var button = $(event.relatedTarget);
  if (!button.data('href')) {
    return;
  }
  var modal = $(this);
  modal.find('form')[0].reset();
  modal.find('form').attr('action', button.data('href'));
  var resource = button.data('resource');
  if (resource != undefined && resource instanceof Object) {
    $.each(resource, function(key, value) {
      var element = modal.find(':input[name="' + key + '"]');
      if (element.attr('type') != 'file') {
        if(element.attr('type') == 'checkbox')  {
            element.prop('checked',value).trigger('change');
            element.iCheck('update')
        }else{
            element.focus().val(value).blur().trigger('change');
        }
      }
    });
  }
  var disabledFields = button.data('disabled-fields');
  if (disabledFields != undefined) {
    disabledFields = disabledFields.split(',');
    $.each(disabledFields, function(key, value) {
      modal.find(':input[name="' + value + '"]').addClass('temp-disabled').attr('disabled', 'disabled');
    });
  }
  modal.find(':input[name="_method"]').val(button.data('method'));
  var readonly = button.data('readonly');
  (readonly == undefined) ?  modal.find(':input.readonly').removeAttr('readonly') : modal.find(':input.readonly').attr('readonly','readonly');
  $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        endDate: '+0d',
        autoclose: true,
        orientation: "auto left"
    }).on('changeDate', function(selected){
        var rel_name = $(this).data('rel');
        if(rel_name){
            var form = $(this).closest("form"),
            date = new Date(selected.date.valueOf());
            date.setDate(date.getDate(new Date(selected.date.valueOf())));
            $('[name='+rel_name+']',form).datepicker($(this).data('fn'), date);
        }
    });
});

$(document).on('hide.bs.modal', '.modal', function(event) {
  $(this).find('.alert').addClass('hidden');
  $(this).find(':input.temp-disabled').removeAttr('disabled');
});

$(document).on('submit', '.modal form,.ajax-request', function(event) {
  event.preventDefault();
  var form = $(this);
  var modal = $(this).hasClass('ajax-request') ? $(this) : form.closest('.modal');
  var button = form.find('[type="submit"]');

  button.prepend('<i class="fa fa-spinner fa-spin"></i> ');

  var url = decodeURIComponent(form.attr('action'));

  url = url.replace(/\{\w+\}/gi, function(match) {
    return $(form).find('[name=' + match.match(/\w+/i) + ']').val();
  });

  var isMultipartSubmit = form.attr('enctype') == 'multipart/form-data';

  if (isMultipartSubmit) {
    var formData = new FormData(form[0]);
  } else {
    var formData = form.serializeArray();
  }

  form.find(':input').attr('disabled', 'disabled');

  $.ajax({
      type: form.attr('method'),
      url: url,
      data: formData,
      dataType: 'json',
      async: isMultipartSubmit ? false : true,
      cache: isMultipartSubmit ? false : true,
      contentType: isMultipartSubmit ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
      processData: isMultipartSubmit ? false : true,
    })
    .done(function(data) {
      (modal.hasClass('ajax-request')) ?  '' : modal.modal('hide');
      setTimeout(function() {
          (data.redirect_url == undefined) ? location.reload() : location.href = data.redirect_url;
      }, 500)
    }).fail(function(jqXHR, textStatus, errorThrown) {
      var errorMessagesLsit = '';
      var data = jqXHR.responseJSON;
      if (data.errorDetails instanceof Object || data.errorDetails instanceof Array) {
        for (var i in data.errorDetails) {
          errorMessagesLsit += '<li>';
          errorMessagesLsit += data.errorDetails[i].join('<br />');
          errorMessagesLsit += '</li>';
        }
      } else {
        errorMessagesLsit += '<li>';
        errorMessagesLsit += data.errorDetails;
        errorMessagesLsit += '</li>';
      }

      modal.find('.alert').removeClass('hidden');
      modal.find('.alert h5').html(data.errorMessage);
      modal.find('.alert ul').html(errorMessagesLsit);
    }).always(function(data) {
      form.find(':input:not(.disabled, .temp-disabled)').removeAttr('disabled');
      button.find('.fa-spinner').remove();
    });
  return false;
});
