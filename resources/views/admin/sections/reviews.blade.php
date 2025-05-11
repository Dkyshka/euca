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


    <div class="card-body">

        <div class="tab-content" id="custom-tabs-three-tabContent">
            {{--ru--}}
            <div class="tab-pane fade active show" id="ru" role="tabpanel" aria-labelledby="ru_tab">

                <div class="form-group">
                    <label for="markup[ru][one]" class="col-sm-12 col-form-label">Отзывы заголовок</label>
                    <div class="col-sm-12">
                        <input type="text" name="markup[ru][one]" class="form-control" id="markup[ru][one]" value="{{ $section->markup->ru->one ?? '' }}" placeholder="[ ] - красный цвет, \n - перевод строки">
                    </div>
                </div>

                <div class="form-group">
                    <label for="markup[ru][two]" class="col-sm-12 col-form-label">О компании заголовок</label>
                    <div class="col-sm-12">
                        <input type="text" name="markup[ru][two]" class="form-control" id="markup[ru][two]" value="{{ $section->markup->ru->two ?? '' }}" placeholder="[ ] - красный цвет, \n - перевод строки">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="offer">О компании описание</label>
                    <textarea id="offer" class="form-control summernote" name="markup[ru][three]">{{ $section->markup->uz->three ?? '' }}</textarea>
                </div>

            </div>

            {{--uz--}}
            <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz_tab">

                <div class="form-group">
                    <label for="markup[uz][one]" class="col-sm-12 col-form-label">Отзывы заголовок</label>
                    <div class="col-sm-12">
                        <input type="text" name="markup[uz][one]" class="form-control" id="markup[uz][one]" value="{{ $section->markup->uz->one ?? '' }}" placeholder="[ ] - красный цвет, \n - перевод строки">
                    </div>
                </div>

                <div class="form-group">
                    <label for="markup[uz][two]" class="col-sm-12 col-form-label">О компании заголовок</label>
                    <div class="col-sm-12">
                        <input type="text" name="markup[uz][two]" class="form-control" id="markup[uz][two]" value="{{ $section->markup->uz->two ?? '' }}" placeholder="[ ] - красный цвет, \n - перевод строки">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="offer">О компании описание</label>
                    <textarea id="offer" class="form-control summernote" name="markup[uz][three]">{{ $section->markup->uz->three ?? '' }}</textarea>
                </div>

            </div>

            {{--en--}}
            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en_tab">

                <div class="form-group">
                    <label for="markup[en][one]" class="col-sm-12 col-form-label">Отзывы заголовок</label>
                    <div class="col-sm-12">
                        <input type="text" name="markup[en][two]" class="form-control" id="markup[en][one]" value="{{ $section->markup->en->one ?? '' }}" placeholder="[ ] - красный цвет, \n - перевод строки">
                    </div>
                </div>

                <div class="form-group">
                    <label for="markup[en][two]" class="col-sm-12 col-form-label">О компании заголовок</label>
                    <div class="col-sm-12">
                        <input type="text" name="markup[en][two]" class="form-control" id="markup[en][two]" value="{{ $section->markup->en->two ?? '' }}" placeholder="[ ] - красный цвет, \n - перевод строки">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="offer">О компании описание</label>
                    <textarea id="offer" class="form-control summernote" name="markup[en][three]">{{ $section->markup->en->three ?? '' }}</textarea>
                </div>

            </div>

        </div>

    </div>

</div>