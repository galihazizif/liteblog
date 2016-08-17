/*========================================================
** Written By: 
**
** Galih Azizi Firmansyah
** galih@rempoah.com
**
** 14 Agustus 2016, Harapan Mulya, Kemayoran, Jakarta Pusat
**=======================================================*/


$(document).on('ajaxSend', function(e,xhr,settings) {
  
});
$(document).on('ajaxComplete ready', function() {
    $('.ajax-submit').off('submit').on('submit', function(e) {
        var myForm = $(this)[0];
        var formData = new FormData();
        for (i = 0; i <= myForm.childElementCount; i++) {
            if (myForm[i].type == 'file') {
                formData.append(myForm[i].name, myForm[i].files[0]);
            } else {
                formData.append(myForm[i].name, myForm[i].value);
            }
        }
        $.ajax({
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            xhr: function(){
                var mxhr = new XMLHttpRequest();
                $('#my-progress').css('width','0%');
                $('#progress-container').show(0);
                mxhr.upload.addEventListener("progress",function(e){
                    if(e.lengthComputable){
                        var diproses = e.loaded / e.total;
                        var persen = diproses*100;
                        $('#my-progress').css('width',persen+'%');
                        $('#my-progress').html(persen+'%');
                    }
                },false);
                mxhr.addEventListener("progress",function(e){
                    if(e.lengthComputable){
                        var diproses = e.loaded / e.total;
                        $('#my-progress').css('width',persen+'%');
                    }
                },false);
                return mxhr;
            },
            success: function(data) {
                $('#progress-container').hide(0);
                $('#modal-body').html(data);
            },
            beforeSend: function() {
                putLoadingIcon('#modal-body');
            }
        });
        e.preventDefault();
    });
    
    $('.ajax-submit-simple').off('submit').on('submit', function(e) {
        $.ajax({
            url: $(this).attr('action'),
            cache: false,
            data: $(this).serialize(),
            type: $(this).attr('method'),
            beforeSend: function() {
                putLoadingIcon('#modal-body');
            },
            success: function(data) {
                $('#modal-body').html(data);
            },
            error: function(xhr, status, e) {
                if (status == 'error') {
                    $('#modal-body').html(xhr.responseText + '<hr>' + e);
                }
            },
        });
        e.preventDefault();
    });
    
    $('.btn-modal').off('click').on('click', function(e) {

        $.ajax({
            url: $(this).attr('href'),
            cache: false,
            type: 'GET',

            async: true,
            success: function(data) {
                $('#modal-body').html(data);
            },
            beforeSend: function(xhr, obj) {
                putLoadingIcon('#modal-body');$('.img-beautiful').on('load',function(){
        $(this).show();
    });
            },
        });

        $('#modal').modal('show');

        e.preventDefault();

    });

    $('.btn-modal-post').off('click').on('click',function(e){
        $.ajax({
            url: $(this).attr('href'),
            data: {"_csrf":$(this).attr('data-csrf')},
            cache: false,
            type: 'POST',
            success: function(data) {
                $('#modal-body').html(data);
            },
            beforeSend: function(xhr, obj) {
                putLoadingIcon('#modal-body');
            },
        });
        $('#modal').modal('show');
        e.preventDefault();
    });
    $('[data-toggle="tooltip"]').tooltip();
    $('.x-close').on('click',function(){
        $('#'+$(this).attr('data-dismiss')).removeClass('animated bounceInDown visible-lg visible-md').hide(300);
    });

    var pageHeight = $(document).height();

    $('.img-beautiful').one('load',function(){
        $(this).show();
    }).each(function(){
        if(this.complete) $(this).load();
    });

    $('#loading-overlay').slideUp(800);

    $(window).on('beforeunload',function(){
        $('#loading-overlay').show(0);
    });

});