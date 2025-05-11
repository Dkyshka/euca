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

                <div class="form-group col-md-12">
                    <label for="offer">Описание</label>
                    <textarea id="offer" class="form-control summernote" name="markup[ru][one]">{{ $section->markup->ru->one ?? '' }}</textarea>
                </div>

            </div>

            {{--uz--}}
            <div class="tab-pane fade" id="uz" role="tabpanel" aria-labelledby="uz_tab">

                <div class="form-group col-md-12">
                    <label for="offer">Описание</label>
                    <textarea id="offer" class="form-control summernote" name="markup[uz][one]">{{ $section->markup->uz->one ?? '' }}</textarea>
                </div>

            </div>

            {{--en--}}
            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en_tab">

                <div class="form-group col-md-12">
                    <label for="offer">Описание</label>
                    <textarea id="offer" class="form-control summernote" name="markup[en][one]">{{ $section->markup->en->one ?? '' }}</textarea>
                </div>

            </div>

        </div>

    </div>

</div>