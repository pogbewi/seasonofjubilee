/**
 * Created by Esther on 2/27/2018.
 */

jQuery(function($) {
    $(document).on('click', '#event_registration', function(e) {
        e.preventDefault();
        var seat = $("input[name=seat]").val();
        var name = $("input[name=name]").val();
        var email = $("input[name=email]").val();
        var phone = $("input[name=phone]").val();
        var gender = $("select[name=gender]").val();
        var attend = $("input[name=attend]").val();
        var input_token = $("input[name=token]").val();

 /*       var formData = new FormData();
        formData.append('seat', seat);
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('gender', gender);
        formData.append('attend', attend);*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var panel_body = $('.notify');
        var url = $(this).attr('data-url');
        $.ajax({
            type: "POST",
            url: url,
            data: {
                'seat':seat,
                'name':name,
                'email':email,
                'phone':phone,
                'gender':gender,
                'attend':attend
            },
            async:true,
            dataType:"json",
            beforeSend: function(xhr){
                panel_body.html('<img src="/local/images/ajax-loader.gif" class="ajax-loader">');
            },
            success: function(data, status){
                panel_body.html('<span class="text-success">'+data['success']+'</span>');
                $('#booking').modal('hide')
                    .slideUp(20000);

            },
            error:function(data, status){

                var obj = $.parseJSON(data.responseText);
                if(data.responseJSON.message){
                    panel_body.html('<h4 class="text-info">'+ data.responseJSON.message +'</h4>');
                }
                if(obj.errors['seat']){
                    $('#seat-div').addClass('has-error');
                    $('#seat-error').html(obj.errors['seat']);
                }
                if(obj.errors['name']){
                    $('#name-div').addClass('has-error');
                    $('#name-error').html(obj.errors['name']);
                }
                if(obj.errors['email']){
                    $('#email-div').addClass('has-error');
                    $('#email-error').html(obj.errors['email']);
                }
                if(obj.errors['phone']){
                    $('#phone-div').addClass('has-error');
                    $('#phone-error').html(obj.errors['phone']);
                }
                if(obj.errors['gender']){
                    $('#gender-div').addClass('has-error');
                    $('#gender-error').html(obj.errors['gender']);
                }
                if(obj.errors['attend']){
                    $('#attend-div').addClass('has-error');
                    $('#attend-error').html(obj.errors['attend']);
                }
            },
            complete: function(){

            }
        });
    });
});