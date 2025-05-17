<section class="catalog main-head">
    <div class="form-head">
        <div class="navigations">
            <a href="{{ url(app()->getLocale()) }}">{{ __('lang.Главная') }}</a>
            /<a class="active" href="{{ $section->page->link }}">{{ $section->page->name }}</a>
        </div>

        <div class="catalog-tabs">
            <div class="button-decor"></div>
            <button type="button" class="navigations-button" data-tab="location">Расположение</button>
            <button type="button" class="navigations-button" data-tab="name-company">Название компании</button>
            <button type="button" class="navigations-button" data-tab="id-search">Поиск по ID</button>
        </div>

        <form class="search" method="GET">
            <div class="input-wrapper">
                <div class="input-row" data-input="location">
                    <label for="country">
                        <svg width="12" height="15"><use xlink:href="#location"></use></svg>
                        <input type="text" name="country" placeholder="Все страны" id="country" value="{{ request('country') }}">
                    </label>

                    <label for="city">
                        <svg width="12" height="15"><use xlink:href="#location"></use></svg>
                        <input type="text" name="city" placeholder="Все города" id="city" value="{{ request('city') }}">
                    </label>
                </div>

                <div class="input-row" data-input="name-company">
                    <label for="name-company">
                        <svg width="12" height="15"><use xlink:href="#location"></use></svg>
                        <input type="text" name="name" placeholder="Название компании" id="name-company" value="{{ request('name') }}">
                    </label>
                </div>

                <div class="input-row" data-input="id-search">
                    <label for="id-search">
                        <svg width="12" height="15">
                            <use xlink:href="#location"></use>
                        </svg>
                        <input type="text" name="companyId" placeholder="Поиск по ID" id="id-search" value="{{ request('companyId') }}">
                    </label>
                </div>

                <button class="search-btn" type="submit">
                    <svg width="24" height="24"><use xlink:href="#search"></use></svg>
                </button>
            </div>
        </form>

    </div>


    <style>
        .custom-checkbox {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            padding-left: 24px;
            font-size: 14px;
        }

        .custom-checkbox .checkbox-icon {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            border: 2px solid #999;
            border-radius: 3px;
            background-color: #fff;
            transition: background-color 0.2s;
        }

        .custom-checkbox input:checked + .checkbox-icon,
        .custom-checkbox .checkbox-icon.checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .custom-checkbox .checkbox-icon::after {
            content: "";
            position: absolute;
            display: none;
            left: 4px;
            top: 0px;
            width: 4px;
            height: 8px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .custom-checkbox input:checked + .checkbox-icon::after {
            display: block;
        }

    </style>

    <div class="catalog-form">

        <div class="filters">
            <div class="filters-title">фильтры</div>

            <div class="filters-wrapper">

                <form class="filters-directions" action="" method="post">
                    <fieldset>
                        <legend>По направлениям</legend>
                        @foreach($directions as $direction)
                            <input
                                    class="visually-hidden"
                                    type="checkbox"
                                    name="directions[]"
                                    value="{{ $direction->id }}"
                                    id="special-{{ $direction->id }}"
                                    {{ in_array($direction->id, request('directions', [])) ? 'checked' : '' }}>
                            <label for="special-{{ $direction->id }}">{{ Str::limit($direction->name, 20) }}</label>
                        @endforeach

                    </fieldset>
                </form>

                <script>
                    document.querySelectorAll('.custom-checkbox').forEach(label => {
                        label.addEventListener('click', () => {
                            const input = document.getElementById(label.getAttribute('for'));
                            input.checked = !input.checked;
                        });
                    });
                </script>

                <form class="filters-range" method="GET" onsubmit="event.preventDefault(); submitRangeFilter();">
                    <fieldset>
                        <legend>Срок на платформе</legend>
                        <div class="range-wrapper">
                            <div class="range-row">
                                <span class="min-hanler"></span>
                                <div class="range-line"></div>
                                <span class="max-handler"></span>
                            </div>
                            <div class="numbers-row">
                                <label for="minValue">
                                    <input type="number" id="minValue" name="minValue" min="0" max="15"
                                           value="{{ request('minValue', 0) }}" readonly>
                                </label>
                                <label for="maxValue">
                                    <input type="number" id="maxValue" name="maxValue" min="0" max="15"
                                           value="{{ request('maxValue', 15) }}" readonly>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <form class="filters-directions filters-status" method="GET" onsubmit="submitStatusFilter(event)">
                    <fieldset>
                        <legend>По статусу</legend>

                        @foreach(\App\Models\Status::all() as $status)
                            <input class="visually-hidden"
                                   type="checkbox"
                                   id="status_{{ $status->id }}"
                                   name="statuses[]"
                                   value="{{ $status->id }}"
                                    {{ in_array($status->id, request('statuses', [])) ? 'checked' : '' }}>
                            <label for="status_{{ $status->id }}">{{ $status->name }}</label>
                        @endforeach
                    </fieldset>


                    <button type="submit" style="display: none;"></button> {{-- скрытая кнопка для JS или Enter --}}
                </form>

            </div>
        </div>

        <div class="catalog-content">

            @foreach($companies as $company)
            <div class="catalog-content__card">
                @if($company->avatar)
                <picture>
                    <source srcset="{{ asset($company->avatar) }}">
                    <img src="{{ asset($company->avatar) }}" alt="участник" width="210" height="50">
                </picture>
                @else
                <picture>
                    <source srcset="{{ asset('assets/images/avatar.avif') }}">
                    <img src="{{ asset('assets/images/avatar.jpg') }}" width="90" height="90" alt="avatar">
                </picture>
                @endif

                <div class="catalog-card__info">
                    <div class="catalog-card__title">
                        <span>{{ ($companies->currentPage() - 1) * $companies->perPage() + $loop->iteration }}</span>
                        {{ Str::limit($company->name, 20) }}
                    </div>
                    <p>{{ Str::limit($company?->country, 20) }} - {{ Str::limit($company?->city, 20) }}</p>
                    <span>{{ $company?->status?->name }}</span>
                    <div class="catalog-card__tags">
                        @if($company->directions->isNotEmpty())
                        @foreach($company->directions()->limit(10)->get() as $direction)
                        <span>{{ $direction->name }}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
                <a class="catalog-card__link" href="{{ $section->page->link .'/company/'.$company->id }}">{{ __('Подробнее о компании') }}</a>
            </div>
            @endforeach
        </div>



        <div class="catalog-new-members">
            <div class="members-title">Новые участники</div>

            @foreach($newCompanies as $newCompany)
            <div class="members-cards">
                <a href="{{ $section->page->link .'/company/'.$newCompany->id }}" class="members-card">
                    @if($newCompany->avatar)
                        <picture>
                            <source srcset="{{ asset($newCompany->avatar) }}">
                            <img src="{{ asset($newCompany->avatar) }}" alt="участник" width="210" height="50">
                        </picture>
                    @else
                        <picture>
                            <source srcset="{{ asset('assets/images/avatar.avif') }}">
                            <img src="{{ asset('assets/images/avatar.jpg') }}" width="90" height="90" alt="avatar">
                        </picture>
                    @endif
                    <b>{{ Str::limit($newCompany->name, 20) }}</b>
                    <span>Free</span>

                    <div>
                        <svg width="12" height="15">
                            <use xlink:href="#location"></use>
                        </svg>
                        {{ Str::limit($newCompany?->country, 20) }} - {{ Str::limit($newCompany?->city, 20) }}
                    </div>
                </a>
            </div>
            @endforeach
        </div>


    </div>

    <script>
        function updateFormData() {
            const minValue = document.getElementById("minValue").value;
            const maxValue = document.getElementById("maxValue").value;

            const formData = new FormData();
            formData.append("minValue", minValue);
            formData.append("maxValue", maxValue);

            // fetch('/', {
            //     method: 'POST',
            //     body: formData,
            // })
            // .then(response => response.json())
            // .then(data => {
            //     console.log('Success:', data);
            // })
            // .catch(error => {
            //     console.error('Error:', error);
            // });

            console.log("Min Value:", minValue);
            console.log("Max Value:", maxValue);
        }


        document.addEventListener('DOMContentLoaded', function () {
            let statusFilterTimeout;

            document.querySelectorAll('input[name="statuses[]"]').forEach(input => {
                input.addEventListener('change', function () {
                    const form = this.closest('form');

                    // Очистить предыдущий таймер
                    clearTimeout(statusFilterTimeout);

                    // Запустить новый с задержкой 500 мс
                    statusFilterTimeout = setTimeout(() => {
                        if (form) {
                            submitStatusFilter({ preventDefault: () => {}, target: form });
                        }
                    }, 500); // можно увеличить/уменьшить
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            let filterDebounceTimer;

            const watchedInputs = document.querySelectorAll(
                'input[name="statuses[]"], input[name="directions[]"]'
            );

            watchedInputs.forEach(input => {
                input.addEventListener('change', () => {
                    clearTimeout(filterDebounceTimer);

                    filterDebounceTimer = setTimeout(() => {
                        applyFilters();
                    }, 500); // ⏱ задержка 500 мс
                });
            });

            function applyFilters() {
                const url = new URL(window.location.href);

                // Сброс старых параметров
                url.searchParams.delete('statuses');
                url.searchParams.delete('statuses[]');
                url.searchParams.delete('directions');
                url.searchParams.delete('directions[]');

                // Добавить выбранные статусы
                document.querySelectorAll('input[name="statuses[]"]:checked').forEach(el => {
                    url.searchParams.append('statuses[]', el.value);
                });

                // Добавить выбранные направления
                document.querySelectorAll('input[name="directions[]"]:checked').forEach(el => {
                    url.searchParams.append('directions[]', el.value);
                });

                // Сбросить пагинацию
                url.searchParams.delete('page');

                // Перенаправление
                window.location.href = url.toString();
            }
        });


        function submitRangeFilter() {
            const minValue = document.getElementById("minValue").value;
            const maxValue = document.getElementById("maxValue").value;

            const url = new URL(window.location.href);

            // Обновляем/добавляем параметры в адрес
            url.searchParams.set('minValue', minValue);
            url.searchParams.set('maxValue', maxValue);

            // Сбросить номер страницы при фильтрации
            url.searchParams.delete('page');

            // Перенаправляем
            window.location.href = url.toString();
        }

        document.addEventListener("DOMContentLoaded", watchRangeInputs);

        function watchRangeInputs() {
            let prevMin = document.getElementById("minValue").value;
            let prevMax = document.getElementById("maxValue").value;

            setInterval(() => {
                const min = document.getElementById("minValue").value;
                const max = document.getElementById("maxValue").value;

                if (min !== prevMin || max !== prevMax) {
                    prevMin = min;
                    prevMax = max;

                    submitRangeFilter(); // фильтруем только при реальном изменении
                }
            }, 3000); // раз в секунду — или оптимизируй с debounce
        }

        function submitStatusFilter(event) {
            event.preventDefault();

            const form = event.target;
            const url = new URL(window.location.href);

            // Удаляем старые параметры статуса
            url.searchParams.delete('statuses[]');
            url.searchParams.delete('statuses');

            // Добавляем все выбранные значения
            const statuses = form.querySelectorAll('input[name="statuses[]"]:checked');
            statuses.forEach(status => {
                url.searchParams.append('statuses[]', status.value);
            });

            url.searchParams.delete('page'); // сбрасываем пагинацию
            window.location.href = url.toString();
        }

    </script>


    @if ($companies->hasPages())
        <div class="pagination">

            {{-- Назад --}}
            <button type="button" @if (!$companies->onFirstPage()) onclick="window.location='{{ $companies->previousPageUrl() }}'" @else disabled @endif>
                <svg width="14" height="7">
                    <use xlink:href="#pag-left"></use>
                </svg>
            </button>

            {{-- Номера страниц --}}
            @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                @if ($page == $companies->currentPage())
                    <a class="pagination-link current" href="#" aria-label="Текущая страница">{{ $page }}</a>
                @elseif ($page <= 3 || $page > $companies->lastPage() - 2 || abs($page - $companies->currentPage()) <= 1)
                    <a class="pagination-link" href="{{ $url }}" aria-label="страница {{ $page }}">{{ $page }}</a>
                @elseif ($page == 4 || $page == $companies->lastPage() - 3)
                    <span class="pagination-link">...</span>
                @endif
            @endforeach

            {{-- Вперёд --}}
            <button type="button" @if ($companies->hasMorePages()) onclick="window.location='{{ $companies->nextPageUrl() }}'" @else disabled @endif>
                <svg width="14" height="7">
                    <use xlink:href="#pag-right"></use>
                </svg>
            </button>

        </div>
    @endif

</section>