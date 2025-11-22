$(document).ready(function() {
    $(".likeForm").on("submit", function(e){
        e.preventDefault();
        
        var $form = $(this);
        var $btn = $form.find('.btn-like');
        
        if ($form.data('submitted')) {
            return;
        }
        
        $form.data('submitted', true);
        var idPeople = $form.find('input[name="idPeople"]').val();
        var $icon = $form.find('.icon-like');
        
        $btn.prop('disabled', true);
        $icon.css('opacity', '0.6');
        
        $.ajax({
            url: '../request/like.php',
            method: 'GET',
            dataType: 'json',
            data: {
                idPeople: idPeople
            },
            success: function(data){
                if (data.success) {
                    $icon.css('color', '#ff0000');
                    $btn.prop('disabled', true);
                    $form.data('permanentlyDisabled', true);
                } else {
                    alert('Ошибка: ' + data.message);
                    $form.data('submitted', false);
                    $btn.prop('disabled', false);
                }
                $icon.css('opacity', '1');
            },
            error: function(xhr, status, error) {
                alert('Ошибка сети: ' + error);
                $form.data('submitted', false);
                $btn.prop('disabled', false);
                $icon.css('opacity', '1');
            }
        });
    });
});