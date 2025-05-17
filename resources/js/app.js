import axios from "axios";

const phoneInput = document.querySelector("[name=phone]");

if (window.intlTelInput) {
    const iti = window.intlTelInput(phoneInput, {
        onlyCountries: ['uz', 'kz', 'tj', 'cn', 'lt', 'lv', 'tr', 'pk', 'af', 'cz', 'ir', 'ro'],
        // preferredCountries: ['uz', 'kz', 'cn'],
        initialCountry: "auto",
        separateDialCode: true,
        geoIpLookup: function (callback) {
            fetch('https://ipinfo.io?token=1ed7a75e950fbc')
                .then(res => res.json())
                .then(data => callback(data.country))
                .catch(() => callback('us'));
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
    });

    phoneInput.addEventListener("blur", function () {
        const fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.INTERNATIONAL);
        phoneInput.value = fullNumber.replace(/\s+/g, '');
    });
}

let isSubmitting = false;

document.getElementById('register_submit')?.addEventListener('click', function (e) {
    e.preventDefault();

    if (isSubmitting) return;

    let form = document.getElementById('register_form');
    let actionUrl = form.getAttribute('action');

    // Удаляем старые ошибки
    form.querySelectorAll('.input-error').forEach(el => el.remove());

    let data = {
        role_id: form.querySelector('[name="role_id"]').value,
        full_name: form.querySelector('[name="full_name"]').value,
        email: form.querySelector('[name="email"]').value,
        login: form.querySelector('[name="login"]').value,
        password: form.querySelector('[name="password"]').value,
        phone: form.querySelector('[name="phone"]').value,
        _token: form.querySelector('[name="_token"]')?.value,
    };

    isSubmitting = true;

    axios.post(actionUrl, data)
        .then(response => {
            if (response.data.success) {
                // window.location.href = response.data.redirect_url;
                // Сохраняем email для подтверждения
                document.getElementById('verification_email').value = data.email;

                // Показываем модалку подтверждения
                document.querySelector('[data-modal="modal-register"]')?.classList.remove('open');
                document.querySelector('[data-modal="modal-verify"]')?.classList.add('open');
            } else if (response.data?.error) {
                let box = document.createElement('div');
                box.className = 'form-global-error input-error';
                box.innerText = response.data.error;
                form.prepend(box);
            }
        })
        .catch(error => {
            if (error.response?.data?.errors) {
                const errors = error.response.data.errors;

                Object.keys(errors).forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        const msg = document.createElement('div');
                        msg.className = 'input-error';
                        msg.style.color = 'red';
                        msg.style.fontSize = '14px';
                        msg.style.marginTop = '5px';
                        msg.innerText = errors[field][0]; // Убираем префикс lang.

                        input.closest('.input__row')?.appendChild(msg);
                    }
                });
            }
        })
        .finally(() => {
            isSubmitting = false;
        });
});

let resendCooldown = 60;
let resendTimerInterval;

function startResendTimer() {
    let timer = resendCooldown;
    const timerSpan = document.getElementById('resend_timer');
    const infoBlock = document.getElementById('resend_info');
    const resendBtn = document.getElementById('resend_code_btn');

    if (!timerSpan || !infoBlock || !resendBtn) return;

    timerSpan.innerText = timer;
    infoBlock.style.display = 'block';
    resendBtn.style.display = 'none';

    resendTimerInterval = setInterval(() => {
        timer--;
        document.getElementById('resend_timer').innerText = timer;

        if (timer <= 0) {
            clearInterval(resendTimerInterval);
            document.getElementById('resend_info').style.display = 'none';
            document.getElementById('resend_code_btn').style.display = 'inline-block';
        }
    }, 1000);
}

// Запустить при первом открытии формы подтверждения
document.addEventListener('DOMContentLoaded', () => {
    startResendTimer();
});

document.getElementById('resend_code_btn')?.addEventListener('click', async () => {
    const email = document.getElementById('verification_email').value;
    const btn = document.getElementById('resend_code_btn');
    btn.disabled = true;
    btn.innerText = 'Отправка...';

    try {
        const res = await axios.post('/resend-code', { email });

        if (res.data.success) {
            startResendTimer(); // запустить заново
        } else {
            alert('Ошибка при повторной отправке');
        }
    } catch (err) {
        alert('Ошибка: ' + (err.response?.data?.error || 'Попробуйте позже'));
    } finally {
        btn.disabled = false;
        btn.innerText = 'Отправить код повторно';
    }
});


document.getElementById('verify_email_form')?.addEventListener('submit', async function (e) {
    e.preventDefault();
    const email = document.getElementById('verification_email').value;
    const code = document.getElementById('verification_code').value;

    document.querySelector('.error_box_verify').innerText = '';

    try {
        const res = await axios.post('/verify-code', {
            email: email,
            code: code
        });

        if (res.data.success) {
            window.location.href = res.data.redirect_url;
        }

    } catch (err) {
        if (err.response?.data?.errors) {
            document.querySelector('.error_box_verify').innerText = Object.values(err.response.data.errors).join('\n');
        } else {
            document.querySelector('.error_box_verify').innerText = err.response?.data?.error || 'Ошибка подтверждения.';
        }
    }
});

document.querySelector('.modal-login form')?.addEventListener('submit', function (e) {
    e.preventDefault();

    // Проверка на то, что форма не отправляется несколько раз
    if (isSubmitting) return;

    let form = e.target;
    let actionUrl = form.getAttribute('action');

    // Удаляем старые ошибки
    form.querySelectorAll('.input-error').forEach(el => el.remove());

    let data = {
        login: form.querySelector('[name="login"]').value,
        password: form.querySelector('[name="password"]').value,
        remember: form.querySelector('[name="remember"]')?.checked ? 1 : 0, // 1, если "Запомнить", 0 — если нет
        _token: form.querySelector('[name="_token"]')?.value, // Laravel CSRF token
    };

    isSubmitting = true;

    // Отправляем данные через axios
    axios.post(actionUrl, data)
        .then(response => {
            if (response.data.success) {
                // Если авторизация успешна, делаем редирект
                window.location.href = response.data.redirect_url;
            }
        })
        .catch(error => {
            if (error.response?.data?.error) {
                // Если ошибка, выводим сообщение об ошибке
                let box = document.createElement('div');
                box.className = 'form-global-error input-error';
                box.innerText = error.response.data.error;
                form.prepend(box);
            }
            if (error.response?.data?.errors) {
                const errors = error.response.data.errors;
                Object.keys(errors).forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        const msg = document.createElement('div');
                        msg.className = 'input-error';
                        msg.style.color = 'red';
                        msg.style.fontSize = '14px';
                        msg.style.marginTop = '5px';
                        msg.innerText = errors[field][0];

                        input.closest('.input__row')?.appendChild(msg);
                    }
                });
            }
        })
        .finally(() => {
            isSubmitting = false;
        });
});

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('chatForm');
    const textarea = document.getElementById('chat_text');
    const fileInput = document.getElementById('download');
    const MAX_TEXT_LENGTH = 1000;
    const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10 MB

    if (!form || !textarea) return;

    textarea.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();

            form.dispatchEvent(new SubmitEvent('submit', {
                cancelable: true,
                bubbles: true
            }));
        }
    });

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const message = textarea.value.trim();

        if (message.length > MAX_TEXT_LENGTH) {
            alert(`Сообщение не может превышать ${MAX_TEXT_LENGTH} символов.`);
            return;
        }

        const files = fileInput?.files ?? [];
        for (let i = 0; i < files.length; i++) {
            if (files[i].size > MAX_FILE_SIZE) {
                alert(`Файл "${files[i].name}" превышает 10MB.`);
                return;
            }
        }

        const formData = new FormData(form);
        const action = form.action;

        try {
            const response = await axios.post(action, formData, {
                headers: {'Content-Type': 'multipart/form-data'}
            });

            form.reset();
            // сбрасываем textarea размеры
            document.getElementById('chat_text').style.height = 'auto';

            // очистка превью после успешной отправки
            const previewContainer = document.getElementById('filePreview');
            if (previewContainer) {
                previewContainer.innerHTML = '';
            }

            const chatWindow = document.querySelector('.chat-window');
            chatWindow.insertAdjacentHTML('beforeend', response.data.html);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        } catch (error) {
            if (error.response && error.response.status === 429) {
                alert('Слишком много сообщений. Подождите несколько секунд и попробуйте снова.');
            } else {
                alert('Ошибка при отправке сообщения. Попробуйте ещё раз.');
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('uploaded');
    const previewContainer = document.getElementById('filePreview');

    if (fileInput && previewContainer) {
        fileInput.addEventListener('change', () => {
            previewContainer.innerHTML = ''; // очистить перед обновлением

            const files = fileInput.files;
            if (!files.length) return;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                const item = document.createElement('div');
                item.className = 'file-preview-item';

                item.innerHTML = `
                    <svg width="14" height="14"><use xlink:href="#add"></use></svg>
                    <span>${file.name} (${(file.size / 1024).toFixed(1)} KB)</span>
                `;

                previewContainer.appendChild(item);
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('chatForm');
    const textarea = document.getElementById('chat_text_public');
    const MAX_TEXT_LENGTH = 1000;

    if (!form || !textarea) return;

    // Enter = отправить (без shift)
    textarea.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            form.dispatchEvent(new SubmitEvent('submit', {
                cancelable: true,
                bubbles: true
            }));
        }
    });

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const message = textarea.value.trim();

        if (message.length > MAX_TEXT_LENGTH) {
            alert(`Сообщение не может превышать ${MAX_TEXT_LENGTH} символов.`);
            return;
        }

        const formData = new FormData(form);
        const action = form.action;

        const recipientInput = document.getElementById('recipient_id');
        if (!recipientInput) {
            alert('Не найден recipient_id');
            return;
        }

        try {
            const response = await axios.post(action, formData, {
                headers: {'Content-Type': 'multipart/form-data'}
            });

            form.reset();
            textarea.style.height = 'auto';
        } catch (error) {
            if (error.response) {
                const status = error.response.status;
                const data = error.response.data;

                if (status === 422 && data.errors?.recipient_id) {
                    alert('Нельзя отправлять самому себе.');
                } else if (status === 429) {
                    alert('Слишком много сообщений. Подождите немного и попробуйте снова.');
                } else {
                    alert(data.message || 'Произошла ошибка при отправке сообщения.');
                }
            } else {
                alert('Сетевая ошибка. Проверьте соединение.');
            }
        }
    });
});

let reply_code = document.getElementById('reply_code');
let timerDiv = document.getElementById('timer');
let countdownInterval;
let startTime;

reply_code?.addEventListener('click', function () {

    if (isSubmitting) {
        return;
    }
    let lastClickTime = localStorage.getItem('lastClickTime');
    let currentTime = new Date().getTime();

    if (lastClickTime) {
        let elapsedTime = currentTime - parseInt(lastClickTime);
        let remainingTime = 60000 - elapsedTime;

        let data = {
            _token: document.querySelector('[name="_token"]')?.value
        };

        isSubmitting = true;

        axios.post(reply_code.dataset.action, data)
            .then(response => {
                console.log(response)
            })
            .catch(error => {
                alert(error.response.data.error)
            })
            .finally(() => {
                isSubmitting = false;
            });

        if (remainingTime > 0) {
            startCountdown(remainingTime);
            reply_code.disabled = true;
            return;
        }
    }

    localStorage.setItem('lastClickTime', currentTime);
    startCountdown(60000);
    reply_code.disabled = true;
});

function currentTime() {
    let lastClickTime = localStorage.getItem('lastClickTime');
    let currentTime = new Date().getTime();

    if (lastClickTime) {
        let elapsedTime = currentTime - parseInt(lastClickTime);
        let remainingTime = 60000 - elapsedTime;

        if (remainingTime > 0) {
            startCountdown(remainingTime);
            reply_code.disabled = true;
        }
    }
}

currentTime();

function startCountdown(duration) {
    clearInterval(countdownInterval);

    startTime = new Date().getTime();
    updateTimer(duration);

    countdownInterval = setInterval(function () {
        let elapsedTime = new Date().getTime() - startTime;
        let remainingTime = duration - elapsedTime;

        if (remainingTime <= 0) {
            clearInterval(countdownInterval);
            timerDiv.textContent = '';
            reply_code.disabled = false;
            return;
        }

        updateTimer(remainingTime);
    }, 1000);
}


function updateTimer(remainingTime) {
    let minutes = Math.floor(remainingTime / 60000);
    let seconds = Math.floor((remainingTime % 60000) / 1000);
    timerDiv.textContent = minutes.toString() + ':' + (seconds < 10 ? '0' : '') + seconds.toString();
}


let comments_form = document?.querySelector('.comments-form');
let add_comment = document?.getElementById('add_comment');
let reply_input = comments_form?.querySelector('[name="reply_message"]');
let notification = document?.querySelector('.notifications_comments');

add_comment?.addEventListener('click', function (e) {
    e.preventDefault();

    if (isSubmitting) {
        return; // Если да, то выходим из функции
    }

    notification.innerHTML = '';

    let spanElement;
    spanElement = document.createElement('span');
    spanElement.className = 'form-text';
    let url = comments_form.getAttribute('action');
    let content_comment = comments_form.querySelector('[name="comment"]')

    let data = {
        _token: document.querySelector('[name="_token"]')?.value,
        content: content_comment.value,
        parent_id: reply_input.value ?? null,
    };

    isSubmitting = true;

    axios.post(url, data)
        .then(response => {
            spanElement.innerText = response.data.message;
            notification.append(spanElement);
            content_comment.value = '';
        })
        .catch(error => {
            for (let item of error.response.data.errors.content ?? []) {
                spanElement.innerText = item;
                notification.append(spanElement);
            }
        })
        .finally(() => {
            isSubmitting = false;
        });
});

// Ответ на комментарии
let reply_comments = document.querySelectorAll('.reply_comments');
if (reply_comments.length > 0) {
    for (let reply of reply_comments) {
        reply?.addEventListener('click', function (e) {
            reply_input.value = e.target.parentNode.dataset.comment;
        });
    }
}


// Feedback
let feedback_form = document?.getElementById('feedback');
let feedback_btn = document?.getElementById('feedback_btn');
let preloader = document?.getElementById('preloader');
let notification_feedback = document?.querySelector('.notification');

let feedback_categories = document.querySelectorAll('[name="feedback_category"]');
let category = feedback_form?.querySelector('[name="category"]');

for (let item of feedback_categories) {
    item.addEventListener('change', function (e) {
        category.value = item.value;
    })
}

feedback_btn?.addEventListener('click', function (e) {
    e.preventDefault();

    if (isSubmitting) {
        return;
    }

    notification_feedback.innerHTML = '';

    let spanElement;
    spanElement = document.createElement('p');
    spanElement.className = 'form-input__text done';
    let url = feedback_form.getAttribute('action');
    let name = feedback_form.querySelector('[name="name"]');
    let city = feedback_form.querySelector('[name="city"]');
    let phone = feedback_form.querySelector('[name="phone"]');
    let category = feedback_form.querySelector('[name="category"]');
    let message = feedback_form.querySelector('[name="message"]');

    let data = {
        _token: feedback_form.querySelector('[name="_token"]')?.value,
        category: category.value,
        name: name.value,
        city: city.value,
        phone: phone.value,
        message: message.value,
    };

    isSubmitting = true;
    preloader.style.display = 'block';

    axios.post(url, data)
        .then(response => {
            spanElement.innerText = response.data.message;
            notification_feedback.append(spanElement);

            if (name.parentElement.classList.contains('error')) {
                name.parentElement.classList.remove('error');
            }
            if (city.parentElement.classList.contains('error')) {
                city.parentElement.classList.remove('error');
            }
            if (phone.parentElement.classList.contains('error')) {
                phone.parentElement.classList.remove('error');
            }
            feedback_form.reset();
        })
        .catch(error => {
            if (error.response.status === 422) {
                let errors = error.response.data.errors;
                for (let key in errors) {
                    document.querySelector(`[name="${key}"]`).parentElement.classList.toggle('error');
                    // spanElement.innerText = errors[key][0];
                    // notification_feedback.append(spanElement);
                }
            }
        })
        .finally(() => {
            setTimeout(function () {
                notification_feedback.innerHTML = '';
            }, 4000);

            preloader.style.display = 'none';
            isSubmitting = false;
        });

});

// Cargo
// document.addEventListener("DOMContentLoaded", function () {
//     const packagingBtn = document.getElementById('add_package');
//     const packageContainer = document.getElementById('packages_container');
//
//     packagingBtn.addEventListener('click', function (e) {
//         e.preventDefault();
//
//         // Показать все скрытые <label> внутри контейнера
//         const hiddenLabels = packageContainer.querySelectorAll('label[style*="display: none"]');
//         hiddenLabels.forEach(label => {
//             label.style.display = 'flex'; // flex для выравнивания, можно и 'block' если нужно
//             label.style.gap = '6px'; // чтобы поля не слипались (опционально)
//         });
//     });
// });


document.addEventListener("DOMContentLoaded", function () {
    const packagingBtn = document?.getElementById('add_package');
    const packageContainer = document.getElementById('packages_container');

    packagingBtn?.addEventListener('click', function (e) {
        e.preventDefault();
        packageContainer.style.display = 'flex';

        const labels = packageContainer.querySelectorAll('label[style*="display: none"]');
        labels.forEach(label => {
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.gap = '5px';
        });

        packagingBtn.style.display = 'none';

        if (!document.getElementById('remove_package')) {
            const removeBtn = document.createElement('button');
            removeBtn.id = 'remove_package';
            removeBtn.type = 'button';
            removeBtn.classList.add('remove-packaging-btn');
            removeBtn.innerHTML = `<svg style="width: 15px"><use xlink:href="#close"></use></svg>`;

            removeBtn.addEventListener('click', () => {
                labels.forEach(label => {
                    label.style.display = 'none';
                    const input = label.querySelector('input, select');
                    if (input) input.value = '';
                });

                packagingBtn.style.display = 'inline-flex';
                packageContainer.style.display = 'none';
                removeBtn.remove();
            });

            packageContainer.appendChild(removeBtn);
        }
    });

    const dimensionsBtn = document.getElementById('add_dimensions');
    const dimensionsContainer = document.getElementById('dimensions_container');

    dimensionsBtn?.addEventListener('click', function (e) {
        e.preventDefault();
        dimensionsContainer.style.display = 'flex';

        const labels = dimensionsContainer.querySelectorAll('label[style*="display: none"]');
        labels.forEach(label => {
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.gap = '5px';
        });

        dimensionsBtn.style.display = 'none';

        if (!document.getElementById('remove_dimensions')) {
            const removeBtn = document.createElement('button');
            removeBtn.id = 'remove_dimensions';
            removeBtn.type = 'button';
            removeBtn.classList.add('remove-dimensions-btn');
            removeBtn.innerHTML = `<svg style="width: 15px"><use xlink:href="#close"></use></svg>`;

            removeBtn.addEventListener('click', () => {
                labels.forEach(label => {
                    label.style.display = 'none';
                    const input = label.querySelector('input');
                    if (input) input.value = '';
                });

                dimensionsBtn.style.display = 'inline-flex';
                dimensionsContainer.style.display = 'none';
                removeBtn.remove();
            });

            dimensionsContainer.appendChild(removeBtn);
        }
    });

    const upload_timeBtn = document.getElementById('add_time');
    const upload_time_containerContainer = document.getElementById('upload_time_container');

    upload_timeBtn?.addEventListener('click', function (e) {
        e.preventDefault();
        upload_time_containerContainer.style.display = 'flex';

        const labels = upload_time_containerContainer.querySelectorAll('label[style*="display: none"]');
        labels.forEach(label => {
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.gap = '5px';
        });

        upload_timeBtn.style.display = 'none';

        if (!document.getElementById('remove_upload_time')) {
            const removetimeBtn = document.createElement('button');
            removetimeBtn.id = 'remove_upload_time';
            removetimeBtn.type = 'button';
            removetimeBtn.classList.add('remove-dimensions-btn');
            removetimeBtn.innerHTML = `<svg style="width: 15px"><use xlink:href="#close"></use></svg>`;

            removetimeBtn.addEventListener('click', () => {
                labels.forEach(label => {
                    label.style.display = 'none';
                    const input = label.querySelector('input');
                    if (input) input.value = '';
                });

                upload_timeBtn.style.display = 'inline-flex';
                upload_time_containerContainer.style.display = 'none';
                removetimeBtn.remove();
            });

            upload_time_containerContainer.appendChild(removetimeBtn);
        }
    });

    const upload_finalBtn = document.getElementById('add_final');
    const upload_final_containerContainer = document.getElementById('upload_final_container');

    upload_finalBtn?.addEventListener('click', function (e) {
        e.preventDefault();
        upload_final_containerContainer.style.display = 'flex';

        const labels = upload_final_containerContainer.querySelectorAll('label[style*="display: none"]');
        labels.forEach(label => {
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.gap = '5px';
        });

        upload_finalBtn.style.display = 'none';

        if (!document.getElementById('remove_final_time')) {
            const removefinalBtn = document.createElement('button');
            removefinalBtn.id = 'remove_final_time';
            removefinalBtn.type = 'button';
            removefinalBtn.classList.add('remove-dimensions-btn');
            removefinalBtn.innerHTML = `<svg style="width: 15px"><use xlink:href="#close"></use></svg>`;

            removefinalBtn.addEventListener('click', () => {
                labels.forEach(label => {
                    label.style.display = 'none';
                    const input = label.querySelector('input');
                    if (input) input.value = '';
                });

                upload_finalBtn.style.display = 'inline-flex';
                upload_time_containerContainer.style.display = 'none';
                removefinalBtn.remove();
            });

            upload_final_containerContainer.appendChild(removefinalBtn);
        }
    });
});

// Block когда
document.addEventListener('DOMContentLoaded', function () {
    const whenSelect = document.getElementById('when_type');
    const readyBlock = document.getElementById('ready_block');
    const constantBlock = document.getElementById('constant_block');

    function updateWhenType() {
        const value = whenSelect?.value;

        if (value === '1') {
            // Готов к загрузке
            readyBlock.style.display = 'flex';
            constantBlock.style.display = 'none';
        } else if (value === '2') {
            // Постоянно
            if (readyBlock) {
            readyBlock.style.display = 'none';
            constantBlock.style.display = 'flex';
            }
        } else {
            // Груза нет — скрыть всё
            if (readyBlock) {
            readyBlock.style.display = 'none';
            constantBlock.style.display = 'none';
            }
        }
    }

    whenSelect?.addEventListener('change', updateWhenType);

    // Инициализируем при загрузке
    updateWhenType();
});


document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('date');
    const dateLabel = document.getElementById('date-label-text');

    dateInput?.addEventListener('change', function () {
        if (this.value) {
            const formatted = new Date(this.value).toLocaleDateString('ru-RU');
            dateLabel.textContent = formatted;
        } else {
            dateLabel.textContent = 'выберите дату';
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const currencySelect = document.getElementById('currency');

    currencySelect?.addEventListener('change', function () {
        const selectedCurrency = this.options[this.selectedIndex].textContent;

        // Находим все <p>, содержащие валюту после input
        const bidRows = document.querySelectorAll('.add-goods__bid-row');

        bidRows.forEach((row, index) => {
            const input = row.querySelector('input[type="number"]');
            const pTags = row.querySelectorAll('p');

            // Условие: обновляем только второй и третий блок (начиная с index 1)
            if (index > 0 && input && pTags.length === 2) {
                pTags[1].textContent = selectedCurrency;
            }
        });
    });
});

// Autocomplete
document.addEventListener('DOMContentLoaded', () => {
    const titleInput = document.getElementById('cargo-name');
    const weightInput = document.getElementById('weight');
    const weightTypeSelect = document.getElementById('weight_type');
    const volumeInput = document.getElementById('volume');

    const packageSelect = document.getElementById('package_id');
    const quantityInput = document.getElementById('quantity');

    const lengthInput = document.getElementById('length');
    const widthInput = document.getElementById('width');
    const heightInput = document.getElementById('height_d');
    const diameterInput = document.getElementById('diameter');

    const sidebarCargoText = document.querySelector('.side-bar__goods-info p');

    function updateCargoSummary() {
        const summary = [];

        const title = titleInput.value.trim();
        const weight = weightInput.value.trim();
        const weightType = weightTypeSelect.value;
        const volume = volumeInput.value.trim();
        const quantity = quantityInput.value.trim();
        const packaging = packageSelect.options[packageSelect.selectedIndex]?.text?.trim();

        const length = lengthInput?.value?.trim();
        const width = widthInput?.value?.trim();
        const height = heightInput?.value?.trim();
        const diameter = diameterInput?.value?.trim();

        if (title) summary.push(title);
        if (weight) summary.push(`${weight} ${weightType}`);
        if (volume) summary.push(`${volume} м³`);

        if (quantity && packaging) {
            summary.push(`${quantity} × ${packaging}`);
        }

        const dimensions = [];
        if (length) dimensions.push(`Д: ${length} м`);
        if (width) dimensions.push(`Ш: ${width} м`);
        if (height) dimensions.push(`В: ${height} м`);
        if (diameter) dimensions.push(`Ø ${diameter} м`);

        if (dimensions.length) summary.push(dimensions.join(', '));

        sidebarCargoText.textContent = summary.length ? summary.join(', ') : 'не заполнено';
    }

    const inputs = [
        titleInput, weightInput, weightTypeSelect, volumeInput,
        quantityInput, packageSelect,
        lengthInput, widthInput, heightInput, diameterInput
    ];

    inputs?.forEach(el => el?.addEventListener('input', updateCargoSummary));
});

document.addEventListener('DOMContentLoaded', () => {
    const whenType = document.getElementById('when_type');
    const readyDate = document.getElementById('date');
    const archiveDays = document.getElementById('archive_after_days');
    const constantFrequency = document.querySelector('[name="constant_frequency"]');

    const whenSummaryBlock = document.querySelector('.side-bar__goods.when-summary');
    const whenSummaryText = whenSummaryBlock?.querySelector('p');

    function updateWhenSummary() {
        let summary = '';

        switch (whenType?.value) {
            case '1': // Готов к загрузке
                const date = readyDate.value;
                const days = archiveDays.value;
                summary = date ? `Готов с ${date}` : '';
                if (days && days !== '0') {
                    summary += `, актуален ${days} дн.`;
                }
                break;

            case '2': // Постоянно
                summary = constantFrequency?.value === 'workdays'
                    ? 'Постоянно, по рабочим дням'
                    : 'Постоянно, ежедневно';
                break;

            case '3': // Запрос ставки
                summary = 'Груза нет, запрос ставки';
                break;
        }

        if (whenSummaryText && whenSummaryBlock) {
            whenSummaryText.textContent = summary || 'не заполнено';
            whenSummaryBlock.classList.toggle('active', summary !== '');
        }
    }

    [whenType, readyDate, archiveDays, constantFrequency].forEach(el => {
        if (el) el.addEventListener('input', updateWhenSummary);
    });

    updateWhenSummary(); // инициализация
});

document?.addEventListener('DOMContentLoaded', () => {
    const loadCity = document.getElementById('place');
    const loadAddress = document.getElementById('address');
    const unloadCity = document.getElementById('final_unload_city');
    const unloadAddress = document.getElementById('final_unload_address');

    const routeSummaryBlock = document.querySelector('.side-bar__goods.route-summary');
    const routeSummaryText = routeSummaryBlock?.querySelector('p');

    function updateRouteSummary() {
        const parts = [];

        const fromCity = loadCity?.value.trim();
        const fromAddr = loadAddress?.value.trim();
        const toCity = unloadCity?.value.trim();
        const toAddr = unloadAddress?.value.trim();

        if (fromCity) parts.push(`от: ${fromCity}`);
        if (fromAddr) parts.push(fromAddr);
        if (toCity) parts.push(`до: ${toCity}`);
        if (toAddr) parts.push(toAddr);

        const full = parts.join(', ');
        if (routeSummaryText && routeSummaryBlock) {
            routeSummaryText.textContent = full || 'не заполнено';
            routeSummaryBlock.classList.toggle('active', full !== '');
        }
    }

    [loadCity, loadAddress, unloadCity, unloadAddress].forEach(el => {
        if (el) el.addEventListener('input', updateRouteSummary);
    });

    updateRouteSummary(); // инициализация
});

document?.addEventListener('DOMContentLoaded', () => {
    const withVatInput = document.getElementById('with_vat_cashless');
    const currencySelect = document.getElementById('currency');
    const withoutVatInput = document.getElementById('without_vat_cashless');
    const cashInput = document.getElementById('cash');
    const onCardCheckbox = document.getElementById('on_cart');
    const counterOffersCheckbox = document.getElementById('counter_offers');

    const paymentBlock = document.querySelector('.side-bar__goods.payment-summary');
    const paymentText = paymentBlock?.querySelector('p');

    function updatePaymentSummary() {
        const parts = [];

        if (withVatInput?.value?.trim()) {
            let currency = currencySelect.options[currencySelect.selectedIndex]?.text || '';
            parts.push(`С НДС: ${withVatInput.value} ${currency}`);
        }

        if (withoutVatInput?.value?.trim()) {
            let currency = currencySelect.options[currencySelect.selectedIndex]?.text || '';
            parts.push(`Без НДС: ${withoutVatInput.value} ${currency}`);
        }

        if (cashInput?.value?.trim()) {
            let currency = currencySelect.options[currencySelect.selectedIndex]?.text || '';
            parts.push(`Наличные: ${cashInput.value} ${currency}`);
        }

        if (onCardCheckbox?.checked) {
            parts.push('на карту');
        }

        if (counterOffersCheckbox?.checked) {
            parts.push('встречные предложения');
        }

        const full = parts.join(', ');
        if (paymentText && paymentBlock) {
            paymentText.textContent = full || 'не заполнено';
            paymentBlock.classList.toggle('active', full !== '');
        }
    }

    [
        withVatInput, currencySelect, withoutVatInput,
        cashInput, onCardCheckbox, counterOffersCheckbox
    ]?.forEach(el => el?.addEventListener('input', updatePaymentSummary));

    updatePaymentSummary(); // инициализация
});
