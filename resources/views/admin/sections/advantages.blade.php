<div class="card">

    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ru_tab" data-toggle="pill" href="#ru" role="tab" aria-controls="ru" aria-selected="true">RU</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uz_tab" data-toggle="pill" href="#uz" role="tab" aria-controls="uz" aria-selected="false">UZ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="en_tab" data-toggle="pill" href="#en" role="tab" aria-controls="en" aria-selected="false">EN</a>
            </li>
        </ul>
    </div>

    <input type="hidden" id="markupData" name="markupData">

    <div class="card-body">

        <div class="tab-content" id="custom-tabs-three-tabContent">
            @foreach (['ru', 'uz', 'en'] as $lang)
                <div class="tab-pane fade {{ $lang == 'ru' ? 'active show' : '' }}" id="{{ $lang }}" role="tabpanel" aria-labelledby="{{ $lang }}_tab">

                    <div class="form-group">
                        <label for="offer_{{ $lang }}" class="col-sm-12 col-form-label">Заголовок</label>
                        <div class="col-sm-12">
                            <input type="text" name="markup[{{ $lang }}][one]" class="form-control" id="offer_{{ $lang }}" value="{{ $section->markup->$lang->one ?? '' }}" placeholder="[ ] - красный цвет, \n - перевод строки">
                        </div>
                    </div>

                    <div id="advantages-container-{{ $lang }}" class="row">
                        @if (!empty($section->markup->$lang->cards))
                            @foreach ($section->markup->$lang->cards as $index => $advantage)
                                <div class="col-md-6 card-wrapper">
                                    <div class="card mb-3">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <input type="text" class="form-control" name="markup[{{ $lang }}][cards][{{ $index }}][title]" value="{{ $advantage->title }}">
                                            <select name="markup[{{ $lang }}][cards][{{ $index }}][icon]" class="form-control icon-select">
                                                <option value="adv" {{ !empty($advantage->icon) && $advantage->icon == 'adv' ? 'selected' : '' }}>adv</option>
                                                <option value="pen" {{ !empty($advantage->icon) && $advantage->icon == 'pen' ? 'selected' : '' }}>pen</option>
                                                <option value="people" {{ !empty($advantage->icon) && $advantage->icon == 'people' ? 'selected' : '' }}>people</option>
                                                <option value="settings" {{ !empty($advantage->icon) && $advantage->icon == 'settings' ? 'selected' : '' }}>settings</option>
                                                <option value="height" {{ !empty($advantage->icon) && $advantage->icon == 'height' ? 'selected' : '' }}>height</option>
                                                <option value="honesty" {{ !empty($advantage->icon) && $advantage->icon == 'honesty' ? 'selected' : '' }}>honesty</option>
                                                <option value="team" {{ !empty($advantage->icon) && $advantage->icon == 'team' ? 'selected' : '' }}>team</option>
                                            </select>
                                            <button type="button" class="btn btn-danger btn-sm remove-advantage" data-lang="{{ $lang }}" data-index="{{ $index }}">Удалить</button>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                        @if(!empty($advantage->list))
                                            @foreach ($advantage->list as $i => $item)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <input type="text" class="form-control" name="markup[{{ $lang }}][cards][{{ $index }}][list][{{ $i }}]" value="{{ $item }}">
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-item" data-lang="{{ $lang }}" data-index="{{ $index }}" data-item-index="{{ $i }}">×</button>
                                                </li>
                                            @endforeach
                                        @endif
                                        </ul>
                                        <div class="card-footer">
                                            <input type="text" class="form-control mb-2 input-item" placeholder="Добавить пункт">
                                            <button type="button" class="btn btn-sm btn-success add-item" data-lang="{{ $lang }}" data-index="{{ $index }}">Добавить пункт</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary mt-3 add-advantage-btn" data-lang="{{ $lang }}">Добавить блок</button>
                </div>
            @endforeach
    </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.addEventListener("click", (e) => {
                    if (e.target.classList.contains("remove-advantage")) {
                        e.target.closest(".card-wrapper").remove();
                    }
                });

                document.addEventListener("click", (e) => {
                    if (e.target.classList.contains("remove-item")) {
                        e.target.closest("li").remove();
                    }
                });

                document.addEventListener("click", (e) => {
                    if (e.target.classList.contains("add-item")) {
                        const card = e.target.closest(".card");
                        const listGroup = card.querySelector(".list-group");
                        const input = card.querySelector(".input-item");
                        const lang = e.target.dataset.lang;
                        const index = e.target.dataset.index;
                        const newItem = document.createElement("li");
                        newItem.className = "list-group-item d-flex justify-content-between";
                        newItem.innerHTML = `<input type="text" class="form-control" name="markup[${lang}][cards][${index}][list][]" value="${input.value.trim()}"> <button class="btn btn-sm btn-outline-danger remove-item">×</button>`;
                        listGroup.appendChild(newItem);
                        input.value = "";
                    }
                });

                document.querySelectorAll(".add-advantage-btn").forEach(button => {
                    button.addEventListener("click", () => {
                        const lang = button.dataset.lang;
                        const container = document.getElementById(`advantages-container-${lang}`);
                        const index = container.children.length;
                        const newBlock = document.createElement("div");
                        newBlock.className = "col-md-6 card-wrapper";
                        newBlock.innerHTML = `
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <input type="text" class="form-control" name="markup[${lang}][cards][${index}][title]" placeholder="Заголовок">
                                <select name="markup[${lang}][cards][${index}][icon]" class="form-control icon-select">
                                    <option value="adv">adv</option>
                                    <option value="pen">pen</option>
                                    <option value="people">people</option>
                                    <option value="settings">settings</option>
                                    <option value="height">height</option>
                                    <option value="honesty">honesty</option>
                                    <option value="team">team</option>
                                </select>
                                <button class="btn btn-danger btn-sm remove-advantage">Удалить</button>
                            </div>
                            <ul class="list-group list-group-flush"></ul>
                            <div class="card-footer">
                                <input type="text" class="form-control mb-2 input-item" placeholder="Добавить пункт">
                                <button class="btn btn-sm btn-success add-item" data-lang="${lang}" data-index="${index}">Добавить пункт</button>
                            </div>
                        </div>`;
                        container.appendChild(newBlock);
                    });
                });
            });
        </script>

    </div>
    </div>