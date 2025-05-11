function summernote() {
        tinyMCE.init({
            selector: "textarea.summernote",
            height: 400,
            branding: false,
            plugins: [
                "media advlist autolink lists  image link",
                "visualchars noneditable visualblocks",
                "code fullscreen charmap nonbreaking template visualblocks",
            ],
            init_instance_callback: function (editor) {
                // Событие для отслеживания изменений
                editor.on('change keyup', function () {
                    editor.save(); // Обновляет значение в <textarea>
                });
            },
            menubar: false,
            inline_styles: false,
            toolbar_items_size: 'small',
            toolbar: "formatselect | blockquote bold italic underline | bullist | link unlink | fullscreen code removeformat | image media | template | visualblocks",  //emoticons visualblocks visualchars
            block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3',
            statusbar: false,
            // Если для этого параметра установлено значение true, все URL-адреса, возвращаемые MCFileManager, будут относительными от указанного document_base_url. Если установлено значение false, все URL-адреса будут преобразованы в абсолютные URL-адреса.
            relative_urls: false,
            language: "ru",
            /* Замена тега P на BR при разбивке на абзацы */
            force_br_newlines: false,
            force_p_newlines: true,
            forced_root_block: '',
            // уберает ширину и высоту у картинок
            image_dimensions: false,
            media_dimensions: false,
            media_poster: false,
            file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = '/admin/' + 'filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            },
            templates: [
                {
                    title: 'Новостной блок',
                    description: '',
                    content: `
                    <div class="anons">
                      <div class="anons-top">
                        <p class="anons-top__subtitle">Статья по теме</p>
                        <p><strong class="anons-top__title">В столице состоялось открытие Ташкентского международного кинофестиваля</strong></p>
                      </div>
                      <blockquote class="anons-blockquote blockquote">
                        <div class="blockquote__top">
                          <div class="blockquote__image">
                              <img src="/storage/photos/shares/image-01.jpg" width="200" alt="">
                          </div>
                          <div class="blockquote__info">
                            <cite class="blockquote__cite">Егор Лапатин</cite>
                            <p class="blockquote__text">Журналист Uznews</p>
                          </div>
                        </div>
                        <div class="blockquote__content">
                          <p>Вместе с тем, мы постоянно внедряем новейшие технологии и инновации, чтобы гарантировать вашу безопасность на самом высоком уровне.</p>
                          <p>Мы инвестируем в системы контроля, автоматизации и мониторинга, чтобы убедиться, что каждый поезд нашего отделения работает с безупречной точностью и безопасностью</p>
                        </div>
                      </blockquote>
                    </div>
                    <p>Дополнительный текст</p>
                    `
                },
            ],
        });
}


let toTranslit = function(text) {
    return text.replace(/([а-яё])|([\s_-])|([^a-z\d])/gi,
        function(all, ch, space, words, i) {
            if (space || words) {
                return space ? '-' : '';
            }
            let code = ch.charCodeAt(0),
                index = code == 1025 || code == 1105 ? 0 :
                    code > 1071 ? code - 1071 : code - 1039,
                t = ['yo', 'a', 'b', 'v', 'g', 'd', 'e', 'zh',
                    'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
                    'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                    'shch', '', 'y', '', 'e', 'yu', 'ya'
                ];
            return t[index];
        }).toLowerCase();
};


$(document).ready(function() {
    $("#name").on("keyup", function(e) {
        $("#slug").val(toTranslit($("#name").val()));
        $("#meta_title_ru").val($("#name").val());
    });
});

$(document).ready(function() {
    $("#question_name").on("keyup", function(e) {
        $("#question_slug").val(toTranslit($("#question_name").val()));
    });
});

//Sort element
function sortElem(elem, url) {
    const csrf = document.querySelector('[name="csrf"]').content;
    $(elem).sortable({
        items: "> tr",
        opacity: 0.5,
        revert: true,
        scroll: true,
        tolerance: "pointer",
        handle: ".move_zone",
        scrollSensitivity: 50,
        scrollSpeed: 50,
        cursor: "move",
        connectWith: '.sections_list',
        placeholder: "ui-sortable-handle",
        update: function(event, ui) {
            let sections = [];

            $(`${elem} tr`).each(function() {
                sections.push($(this).attr("data-id"));
            });
            $.ajax({
                url: url,
                method:"POST",
                data:{ sectionIds: sections, _token: csrf, action: 'sort'},
                success:function(data) {
                    $("#section").load(`#sections ${elem} > tr`);
                }
            });
        }
    }).disableSelection();
}

// sortElem('#block_list','/admin/sections/update/sort');


// append elements block
function appElement(locale, content) {
    let parent = document.getElementById(content);
    let countElements = parent.querySelectorAll('.elements');
    let lastElement;

    if(countElements.length > 0) {
        lastElement = countElements[countElements.length - 1].dataset.key * 1 + 1;
    } else {
        lastElement = 0;
    }


    $(`#`+content).append(`
        <div class="elements" style="position: relative;border-top: 2px solid rgb(40, 167, 69);padding: 5px;border-radius: 5px;" data-key="${lastElement}">
        <div class="btn btn-danger" style="position: absolute; right: 0; z-index: 99;" onmouseover="$(this).parent().css('z-index',2);$(this).parents().eq(0).find('.deleteOverlay').show();" onmouseout="$(this).parent().css('z-index','');$(this).parents().eq(0).find('.deleteOverlay').hide();" onclick="removeElement(this)">Удалить</div>
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" class="form-control" name="markup[${locale}][elements][${lastElement}][title]" placeholder="Заголовок" value="">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea id="description" class="form-control summernote" name="markup[${locale}][elements][${lastElement}][description]"></textarea>
            </div>
            <div class="deleteOverlay" style="display: none;"></div>
        </div>
        `);



    tinyMCE.remove();

    summernote();
}


// Функция добавления нового аккордеона для указанного языка
function addAccordion(language) {
    const accordionContainer = document.getElementById(`accordionContainer_${language}`);
    const accordionId = `accordion_${language}_${Date.now()}`; // Уникальный ID для аккордеона

    const newAccordion = document.createElement("div");
    newAccordion.className = "accordion my-3";
    newAccordion.id = accordionId;

    newAccordion.innerHTML = `
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" id="heading${accordionId}">
                <h5 class="mb-0 col-md-6">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse${accordionId}" aria-expanded="true" aria-controls="collapse${accordionId}">
                        Новый аккордеон (${language})
                    </button>
                    <input type="text" class="form-control mt-2" placeholder="Заголовок" onchange="updateJSON()">
                </h5>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeAccordion('${accordionId}', '${language}')">Удалить аккордеон</button>
            </div>
            <div id="collapse${accordionId}" class="collapse" aria-labelledby="heading${accordionId}" data-parent="#accordionContainer_${language}">
                <div class="card-body">
                    <div id="items${accordionId}" class="accordion-items">
                        <button type="button" class="btn btn-secondary mb-2" onclick="addItem('${accordionId}', '${language}')">Добавить элемент</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    accordionContainer.appendChild(newAccordion);
    updateJSON(); // Обновляем JSON после добавления нового аккордеона
}

// Функция добавления элемента в аккордеон для указанного языка
function addItem(accordionId, language) {
    const itemsContainer = document.getElementById(`items${accordionId}`);
    const itemId = `item_${language}_${Date.now()}`;

    const newItem = document.createElement("div");
    newItem.className = "accordion-item mb-2";
    newItem.id = itemId;

    newItem.innerHTML = `
        <input type="text" class="form-control mb-1" placeholder="Описание элемента" onchange="updateJSON()">
        <div class="row col-md">
            <input type="text" class="form-control mb-1 col-md-6" placeholder="Описание элемента" onchange="updateJSON()">
            <input type="checkbox" class="form-control mb-1 col-md-1">
        </div>
        <textarea class="form-control mb-1 summernote" placeholder="Содержимое элемента" rows="5"></textarea>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeItem('${itemId}', '${accordionId}', '${language}')">Удалить элемент</button>
    `;

    itemsContainer.appendChild(newItem);
    updateJSON(); // Обновляем JSON после добавления нового элемента
    summernote();
}

// Функция удаления элемента
function removeItem(itemId, accordionId, language) {
    const item = document.getElementById(itemId);
    item.remove();
    updateJSON(); // Обновляем JSON после удаления элемента
}

// Функция удаления аккордеона
function removeAccordion(accordionId, language) {
    const accordion = document.getElementById(accordionId);
    accordion.remove();
    updateJSON(); // Обновляем JSON после удаления аккордеона
}

// Функция обновления JSON-структуры и сохранения в скрытое поле
function updateJSON() {
    const languages = ["ru", "uz", "en"];
    const data = {};

    languages.forEach(language => {
        const accordions = Array.from(document.querySelectorAll(`#accordionContainer_${language} .accordion`));

        data[language] = accordions.map(accordion => {
            const title = accordion.querySelector("input[type='text']").value;

            const items = Array.from(accordion.querySelectorAll(".accordion-item")).map(item => ({
                description: item.querySelector("input[type='text']").value,
                content: item.querySelector("textarea").value,
                checked: item.querySelector("input[type='checkbox']").checked
            }));

            return {title, items};
        });
    });

    if (document.getElementById("markupData")) {
        document.getElementById("markupData").value = JSON.stringify(data);
    }
}

// append questions block
function appQuestion() {
    $('#questions').append(`
        <div class="elements" style="position: relative;">
        <div class="btn btn-danger" style="position: absolute; right: 0; z-index: 99;" onmouseover="$(this).parent().css('z-index',2);$(this).parents().eq(0).find('.deleteOverlay').show();" onmouseout="$(this).parent().css('z-index','');$(this).parents().eq(0).find('.deleteOverlay').hide();" onclick="removeElement(this)">Удалить</div>
            <div class="form-group">
                <label for="title">Вопрос</label>
                <input type="text" class="form-control" name="title" placeholder="Заголовок" value="">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea id="description" class="form-control summernote" name="description"></textarea>
            </div>
            <div class="deleteOverlay" style="display: none;"></div>
        </div>
        `);

    tinyMCE.remove();
    summernote();
}

function removeElement(elem) {
    elem.parentElement.remove();
}

// accordion block generate json
// function save() {
//     let cats = [];
//
//     document.querySelectorAll('.elements').forEach((el) => {
//         let questions = {};
//         questions['title'] = el.querySelector('[name="title"]').value;
//         questions['description'] = el.querySelector('[name="description"]').value;
//         cats.push(questions);
//     });
//
//     let connect = document.querySelector('[name="connect"]');
//     connect.value = JSON.stringify(cats);
// }


//remove images
// $('.card-body').on('click', '.del-img', function () {
//     $(this).closest('.product-img-upload').empty();
//     $('#thumbnail').val('');
//     return false;
// });

function removeGallery(elem, slider = false) {
    const csrf = document.querySelector('[name="csrf"]').content;
    // let images = document.getElementById('gallery-img-output');
    let thumbnail = document.getElementById('thumbnail');
    let url = elem.parentNode.dataset.delete ?? null;

    // let data_id = elem.closest('.product-img-upload').dataset.id;
    // let data_orig = elem.closest('.product-img-upload').dataset.orig;

    // Эта реализация для доп элементов после основного (например модалки)
    if(slider && elem.parentNode.nextElementSibling) {
        elem.parentNode.nextElementSibling.remove();
    }

    elem.closest('.product-img-upload').remove();

    if(thumbnail) {
        thumbnail.value = '';
        let images = document.querySelectorAll('.product-img-upload');
        thumbnail.value = Array.from(images).map(function (item) {
            return item.dataset.orig;
        }).join(',');
    }

    if (url) {
        $.ajax({
            url: `${url}`,
            method:"POST",
            data:{_token: csrf},
            success:function(result) {
                console.log(result);
            }
        });
    }

}

// change status
function changeStatus(id, url) {
    const csrf = document.querySelector('[name="csrf"]').content;
    let choiceVal = $('.status_selection#'+id).attr('value');

    $.post(url, { id: id, _token: csrf, choice: choiceVal, action: 'status' }, function(data){
        if (data.choice === 1){
            $('.status_selection#'+id).attr('value', data.choice);
            $('.status_selection#'+id+' span').attr('class', 'fa fa-eye');
        } else {
            $('.status_selection#'+id).attr('value', data.choice);
            $('.status_selection#'+id+' span').attr('class', 'fa fa-eye-slash');
        }
    }, 'json');
}

//blocks general image add
// function popupBaseImage(elem = null) {
//     CKFinder.modal( {
//         chooseFiles: true,
//         onInit: function( finder ) {
//             finder.on( 'files:choose', function( evt ) {
//                 let file = evt.data.files.first();
//
//                 let baseImgOutput = document.getElementById( 'base-img-output' );
//
//                 // if (elem) {
//                 //     baseImgOutput = elem.previousElementSibling;
//                 // }
//
//                 baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + baseUrl + file.getUrl() + '"><input type="hidden" name="images" value="' + file.getUrl() + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
//             } );
//             finder.on( 'file:choose:resizedImage', function( evt ) {
//                 const baseImgOutput = document.getElementById( 'base-img-output' );
//                 baseImgOutput.innerHTML = '<div class="product-img-upload"><img src="' + baseUrl + evt.data.resizedUrl + '"><input type="hidden" name="images" value="' + evt.data.resizedUrl + '"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
//             } );
//         }
//     } );
// }


//blocks gallerys add
// function popupGalleryImage() {
//     CKFinder.modal( {
//         chooseFiles: true,
//         onInit: function( finder ) {
//             finder.on( 'files:choose', function( evt ) {
//                 let files = evt.data.files;
//                 const galleryImgOutput = document.getElementById( 'gallery-img-output' );
//
//                 let num = 0;
//                 if (document.querySelector('.product-img-upload')) {
//                     if (galleryImgOutput.lastElementChild) {
//                         num = galleryImgOutput.lastElementChild.dataset.id * 1 + 1;
//                     }
//                 }
//                 // вывод языковых элементов инпут - textarea
//                 files.forEach( ( node, index ) => {
//                     if (galleryImgOutput.innerHTML) {
//                         galleryImgOutput.innerHTML += '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden"  name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '"><button class="del-img btn btn-app bg-danger" type="button" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button></div>';
//                     } else {
//                         galleryImgOutput.innerHTML = '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden" name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '"><button class="del-img btn btn-app bg-danger" type="button" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button></div>';
//                     }
//                 });
//
//             } );
//             finder.on( 'file:choose:resizedImage', function( evt ) {
//                 const baseImgOutput = document.getElementById( 'base-img-output' );
//
//                 files.forEach( ( node, index ) => {
//                     if (baseImgOutput.innerHTML) {
//                         baseImgOutput.innerHTML += '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden" name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '"><input type="text" class="form-control" name="'+(num + index)+'" placeholder="Заголовок"><textarea style="height: 150px" class="form-control" name="gallery['+(num + index)+'][description]" placeholder="Описание"></textarea><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
//                     } else {
//                         baseImgOutput.innerHTML = '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden" name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '"><input type="text" class="form-control" name="gallery['+(num + index)+'][name]" placeholder="Заголовок"><textarea style="height: 150px" class="form-control" name="gallery['+(num + index)+'][description]" placeholder="Описание"></textarea><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
//                     }
//                 });
//
//
//             } );
//         }
//     } );
// }

// initialization summernote
summernote();


// function tabsGalleryImage(elem) {
//     CKFinder.modal( {
//         chooseFiles: true,
//         onInit: function( finder ) {
//             finder.on( 'files:choose', function( evt ) {
//                 let files = evt.data.files;
//                 const galleryImgOutput = elem.nextElementSibling;
//
//                 let num = 0;
//                 if (document.querySelector('.product-img-upload')) {
//                     if (galleryImgOutput.lastElementChild) {
//                         num = galleryImgOutput.lastElementChild.dataset.id * 1 + 1;
//                     }
//                 }
//                 // вывод языковых элементов инпут - textarea
//                 files.forEach( ( node, index ) => {
//                     if (galleryImgOutput.innerHTML) {
//                         galleryImgOutput.innerHTML += '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden"  name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '" id="image"><input type="text" class="form-control mt-2" name="gallery['+(num + index)+'][name]" placeholder="Заголовок" id="image_title"><button class="del-img btn btn-app bg-danger" type="button" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button></div>';
//                     } else {
//                         galleryImgOutput.innerHTML = '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden" name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '" id="image"><input type="text" class="form-control mt-2" name="gallery['+(num + index)+'][name]" placeholder="Заголовок" id="image_title"><button class="del-img btn btn-app bg-danger" type="button" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button></div>';
//                     }
//                 });
//
//             } );
//             finder.on( 'file:choose:resizedImage', function( evt ) {
//                 const baseImgOutput = document.getElementById( 'base-img-output' );
//
//                 files.forEach( ( node, index ) => {
//                     if (baseImgOutput.innerHTML) {
//                         baseImgOutput.innerHTML += '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden" name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '" id="image"><input type="text" class="form-control mt-2" name="'+(num + index)+'" placeholder="Заголовок" id="image_title"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
//                     } else {
//                         baseImgOutput.innerHTML = '<div class="product-img-upload" data-id="'+(num + index)+'"><img src="' + baseUrl + node.getUrl() + '"><input type="hidden" name="gallery['+(num + index)+'][fileName]" value="' + node.getUrl() + '" id="image"><input type="text" class="form-control mt-2" name="gallery['+(num + index)+'][name]" placeholder="Заголовок" id="image_title"><button class="del-img btn btn-app bg-danger"><i class="far fa-trash-alt"></i></button></div>';
//                     }
//                 });
//
//             } );
//         }
//     } );
// }



// append tabs
// onclick="addContent(this)"
function appTabs() {

    let elements = document.querySelectorAll('.elements_tabs');

    $('#tabs').append(`
        <div class="elements_tabs mb-4 col-md-4">
            <div class="btn btn-danger" onmouseover="$(this).parent().css('z-index',2);$(this).parents().eq(0).find('.deleteOverlay').show();" onmouseout="$(this).parent().css('z-index','');$(this).parents().eq(0).find('.deleteOverlay').hide();" onclick="removeElement(this)" id="deleteTabs">Удалить</div>
            <div class="form-group mb-2">
                <label for="title">Заголовок блока ru</label>
                <input type="text" class="form-control" name="title_ru" >

                <label for="title">Заголовок блока uz</label>
                <input type="text" class="form-control" name="title_uz" >

                <label for="title">Заголовок блока en</label>
                <input type="text" class="form-control" name="title_en" >

                <div class="btn btn-success mt-2" data-toggle="modal" onclick="changeItem(this)" data-target="#exampleModalCenter" data-block="${elements.length + 1}">
                <span>Добавить вопрос</span>
                <i class="fa fa-plus"></i>
                </div>

                <div id="contentTabs">
                <div class="card-body table-responsive p-0 pt-4 pb-4">
                    <table class="table table-hover text-nowrap">
                        <tbody class="selectable-demo-list sections_list" data-step="${elements.length + 1}" id="question_list">
                        </tbody>
                    </table>
                </div>
                <div class="deleteOverlay"></div>

            </div>
        </div>

    `);

}





// append content
// function addContent(elem) {
//     let contentTabs = elem.nextElementSibling;
//
//     $(contentTabs).append(`
//         <div class="form-group ml-3 mt-3 class-el" style="position: relative">
//
//             <label for="title">Класс</label>
//             <input type="text" class="form-control" name="class_title" placeholder="Экономический класс.." >
//             <div class="btn btn-danger" onmouseover="$(this).parent().css('z-index',2);$(this).parents().eq(0).find('.deleteOverlay').show();" onmouseout="$(this).parent().css('z-index','');$(this).parents().eq(0).find('.deleteOverlay').hide();" onclick="removeElement(this)" id="deleteTabs">Удалить</div>
//
//             <div class="form-group mt-3">
//                 <div class="col-md-12">
//                     <div class="card card-outline card-success">
//                         <div class="card-header">
//                             <h3 class="card-title">Изображения</h3>
//                         </div>
//                         <div class="card-body">
//                             <button class="btn btn-success" type="button" id="add-gallery-img" onclick="tabsGalleryImage(this); return false;">Загрузить</button>
//                             <div id="gallery-img-output" class="upload-images gallery-image"></div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             <div class="deleteOverlay"></div>
//
//         </div>
//     `);
// }



// tabs block generate json
// function saveTabs() {
//     let cats = [];
//     if (document.querySelector('.elements_tabs')) {
//         document.querySelectorAll('.elements_tabs').forEach((el) => {
//             let content = [];
//             if (el.querySelector('[name="flight_title"]').value !== '') {
//                 let tabs = {};
//                 tabs['title'] = el.querySelector('[name="flight_title"]').value;
//             if (el.querySelector('.class-el')) {
//                 el.querySelectorAll('.class-el').forEach((conTabs) => {
//
//                     let contentEl = {};
//                     let images = [];
//
//                     if (conTabs.querySelector('[name="class_title"]').value !== '') {
//                         contentEl['title'] = conTabs.querySelector('[name="class_title"]').value;
//
//                         if (conTabs.querySelector('.product-img-upload')) {
//
//                             conTabs.querySelectorAll('.product-img-upload').forEach((productImg) => {
//
//                                 let image = {}
//                                 if (productImg.querySelector('#image_title').value !== '') {
//                                     image['title'] = productImg.querySelector('#image_title').value;
//                                     image['image'] = productImg.querySelector('#image').value;
//                                     images.push(image);
//                                 }
//                             });
//                             contentEl['images'] = images;
//                         }
//                         content.push(contentEl);
//                         tabs['content'] = content;
//                     }
//                 });
//             }
//             cats.push(tabs);
//             }
//         });
//     }
//
//     let connect = document.querySelector('[name="connect"]');
//     connect.value = JSON.stringify(cats);
// }



// // footer dynamic
// $(init);
// function init() {
//     $( ".droppable-category, .droppable-area-1, .droppable-area-2" ).sortable({
//         connectWith: ".connected-sortable",
//         stack: '.connected-sortable ul'
//     }).disableSelection();
// }

// Footer dynamic menu
// function saveFooterMenu() {
//     let cats = [];
//     let menuLeft = [];
//     let menuRight = [];
//
//     let menuItems1 = document.querySelector('.droppable-area-1');
//     let menuItems2 = document.querySelector('.droppable-area-2');
//
//
//     if (menuItems1.childNodes.length) {
//         menuItems1.childNodes.forEach((elem, index) => {
//             let items = {}
//
//             items['sectionId'] = elem.dataset.id;
//
//             menuLeft.push(items);
//         });
//
//         cats.push(menuLeft)
//     }
//
//     if (menuItems2.childNodes.length) {
//         menuItems2.childNodes.forEach((elem, index) => {
//             let items = {}
//
//             items['sectionId'] = elem.dataset.id;
//
//             menuRight.push(items);
//         });
//
//         cats.push(menuRight);
//     }
//
//     document.querySelector('[name="connect"]').value = JSON.stringify(cats);
// }


// Phone mask
let phone = document.getElementById("phone");
let phone_dop = document.getElementById("phone_dop");

if (phone || phone_dop) {
    Inputmask({"mask": "+999(99) 999-99-99"}).mask(phone);
    // Inputmask({"mask": "+999(99) 999-99-99"}).mask(phone_dop);
}

// Js custom select
$(document).ready(function() {
    $('.js-select').select2({
        minimumResultsForSearch: -1,
        placeholder: 'Выберете теги',
        // closeOnSelect: false,
        language: {
            noResults: function() {
                return 'Ничего не найдено';
            }
        }
    });
});



// alert success
function success(action = 'success') {
    let _container;

    function success(message, title, options) {
        return alert(action, message, title, action === 'success' ? "fa fa-check-circle" : "fa fa-exclamation-circle", options);
    }

    function alert(type, message, title, icon, options) {
        let alertElem, messageElem, titleElem, iconElem, innerElem;
        if (typeof options === "undefined") {
            options = {};
        }
        options = $.extend({}, success.defaults, options);
        if (!_container) {
            _container = $("#alerts");
            if (_container.length === 0) {
                _container = $("<ul>").attr("id", "alerts").appendTo($("body"));
            }
        }
        if (options.width) {
            _container.css({
                width: options.width
            });
        }
        alertElem = $("<li>")
            .addClass("alert")
            .addClass("alert-" + type);
        setTimeout(function () {
            alertElem.addClass("open");
        }, 1);
        if (icon) {
            iconElem = $("<i>").addClass(icon);
            alertElem.append(iconElem);
        }
        innerElem = $("<div>").addClass("alert-block");
        alertElem.append(innerElem);
        if (title) {
            titleElem = $("<div>").addClass("alert-title").append(title);
            innerElem.append(titleElem);
        }
        if (message) {
            messageElem = $("<div>").addClass("alert-message").append(message);
            innerElem.append(messageElem);
        }
        if (options.displayDuration > 0) {
            setTimeout(function () {
                leave();
            }, options.displayDuration);
        } else {
            innerElem.append("<em>Click to Dismiss</em>");
        }
        alertElem.on("click", function () {
            leave();
        });

        function leave() {
            alertElem.removeClass("open");
            alertElem.one(
                "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
                function () {
                    return alertElem.remove();
                }
            );
        }
        return _container.prepend(alertElem);
    }

    return {
        success: success,
        defaults: {
            width: "",
            icon: "",
            displayDuration: 3000,
            pos: ""
        }
    };
}

let _event = document.querySelector('#events');
if (_event) {
    success(_event.dataset?.action).success(_event.dataset.message, _event.dataset.action === 'success' ? 'Успешно' : 'Ошибка', { displayDuration: 3000, pos: 'top' });
}