document.getElementById('photoUpload').addEventListener('click', function() {
    document.getElementById('photoInput').click();
});

document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('previewImage');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

const textarea = document.querySelector('textarea');
const charCount = document.querySelector('.character-count');

textarea.addEventListener('input', function() {
    const count = this.value.length;
    charCount.textContent = `${count}/300 символов`;
    
    if (count > 250) {
        charCount.style.color = '#dc3545';
    } else if (count > 200) {
        charCount.style.color = '#ffc107';
    } else {
        charCount.style.color = '#666';
    }
});

const photoUpload = document.getElementById('photoUpload');

photoUpload.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.borderColor = '#764ba2';
    this.style.background = 'rgba(102, 126, 234, 0.2)';
});

photoUpload.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.borderColor = '#667eea';
    this.style.background = 'rgba(102, 126, 234, 0.05)';
});

photoUpload.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.borderColor = '#667eea';
    this.style.background = 'rgba(102, 126, 234, 0.05)';
    
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        document.getElementById('photoInput').files = e.dataTransfer.files;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('previewImage');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

$(document).ready(function() {
    $(".dating-form").on("submit", function(e){
        e.preventDefault();
        
        var $form = $(this);
        var $submitBtn = $form.find('.submit-btn');
        var originalText = $submitBtn.html();
        
        // Блокируем кнопку
        $submitBtn.prop('disabled', true);
        $submitBtn.html('<i class="bi bi-arrow-repeat spinner"></i> Создание...');
        
        var formData = new FormData(this);
        
        $.ajax({
            url: '../request/create.user.php',
            method: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                if (data.success) {
                    showNotification('Анкета успешно создана!', 'success');
                    
                    $form[0].reset();
                    $('#previewImage').hide();
                    $('.character-count').text('0/300 символов').css('color', '#666');
                    
                } else {
                    showNotification('Ошибка: ' + data.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                showNotification('Ошибка сети: ' + error, 'error');
            },
            complete: function() {
                $submitBtn.prop('disabled', false);
                $submitBtn.html(originalText);
            }
        });
    });
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 10px;
        color: white;
        font-weight: bold;
        z-index: 10000;
        max-width: 400px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        ${type === 'success' ? 'background: #28a745;' : 'background: #dc3545;'}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 500);
    }, 5000);
}

const style = document.createElement('style');
style.textContent = `
    .spinner {
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);