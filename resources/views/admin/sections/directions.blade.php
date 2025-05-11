<div class="card">

    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="main_tab" data-toggle="pill" href="#main" role="tab" aria-controls="ru" aria-selected="true">Основное</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ru_tab" data-toggle="pill" href="#ru" role="tab" aria-controls="ru" aria-selected="true">RU</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uz_tab" data-toggle="pill" href="#uz" role="tab" aria-controls="uz" aria-selected="false">UZ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="en_tab" data-toggle="pill" href="#en" role="tab" aria-controls="en" aria-selected="false">EN</a>
            </li>
        </ul>
    </div>


    <div class="card-body">

        <div class="tab-content" id="custom-tabs-three-tabContent">

            <div class="tab-pane fade active show" id="main" role="tabpanel" aria-labelledby="main_tab">

                {{-- Управление странами --}}
                <div class="form-group col-md-12">
                    <label>Страны</label>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Активна</th>
                            <th>Количество</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($section->markup->countries as $code => $country)
                            <tr>
                                <td>
                                    {{ $country->name }}
                                    <input type="hidden" name="markup[countries][{{ $code }}][name]" value="{{ $country->name }}">
                                </td>
                                <td>
                                    <input type="hidden" name="markup[countries][{{ $code }}][is_active]" value="0">
                                    <input type="checkbox" name="markup[countries][{{ $code }}][is_active]" value="1"
                                            {{ $country->is_active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="number" name="markup[countries][{{ $code }}][count]" class="form-control"
                                           value="{{ $country->count }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            {{--ru--}}
            <div class="tab-pane fade" id="ru" role="tabpanel" aria-labelledby="ru_tab">

                <div class="form-group col-md-12">
                    <label for="offer">Первый текст</label>
                    <textarea id="offer" class="form-control summernote" name="markup[ru][one]">{{ $section->markup->ru->one ?? '' }}</textarea>
                </div>

            </div>

            {{--uz--}}
            <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz_tab">

                <div class="form-group col-md-12">
                    <label for="offer">Первый текст</label>
                    <textarea id="offer" class="form-control summernote" name="markup[uz][one]">{{ $section->markup->uz->one ?? '' }}</textarea>
                </div>

            </div>

            {{--en--}}
            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en_tab">

                <div class="form-group col-md-12">
                    <label for="offer">Первый текст</label>
                    <textarea id="offer" class="form-control summernote" name="markup[en][one]">{{ $section->markup->en->one ?? '' }}</textarea>
                </div>

            </div>

        </div>

    </div>

</div>