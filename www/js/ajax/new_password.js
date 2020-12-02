$(document).ready(function() {
    let newPasswordForm = $('#new_password');
    newPasswordForm.find('button').on('click', function(e) {
        e.preventDefault();
        newPassword(newPasswordForm);
    });
});

// ПРОГРАММЫ / ДУБЛИРОВАТЬ скрипт для создания новой программы путем копирования
function newPassword(form) {
    let password = form.find('#add-password').val();
    let repeat_password = form.find('#repeat-password').val();
    let verification_token = form.find('#verification_token').val();

    $.ajax({
        url: window.location.origin + '/ajax/new-password',
        method: 'POST',
        dataType: 'json',
        data: {
            password: password,
            repeat_password: repeat_password,
            verification_token: verification_token,
        },
        beforeSend: function(formData, jqForm, options) {
            form.find('.form-comment').text('');
            if (password !== repeat_password) {
                form.find('.form-comment').text('Пароли не совпадают');
                return false;
            }
            if (!password || !repeat_password) {
                form.find('.form-comment').text(
                    'Поля "пароль" и "повторить пароль" не могут быть пустыми');
                return false;
            }
        },
        success: function(data) {
            console.log(data);
            if (!data.error) {
                let parent_box = form.parent();
                form.remove();
                parent_box.append(
                    '<div class="service__message left"><p>Пароль успешно изменен</p><div class="service__back-link"><a href="/auth" class="link">войти на сайт</a></div></div>');
            } else {
                form.find('.form-comment').text(data.error['password']);
            }
        },
    });
}