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

<div class="form-group">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Изображения</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-success mb-2" id="lfm" data-input="thumbnail" data-preview="gallery-img-output">Загрузить</button>
                @php
                    if(isset($section->pictures)):
                        $filepath = [];
                        foreach($section->pictures as $file):
                            $filepath[] = $file->orig;
                        endforeach;
                        $filepath = implode(',', $filepath);
                    endif;
                @endphp

                <input id="thumbnail" class="form-control" type="hidden" name="filepath" value="{{ $filepath ?? '' }}">
                <div id="gallery-img-output" class="upload-images gallery-image">
                    @if(isset($section->pictures))
                        @foreach($section->pictures as $key => $picture)
                            <div class="product-img-upload col-md-3" data-id="{{ $key }}" data-orig="{{ $picture->orig }}" data-delete="{{ route('pictures_delete', $picture->id ?? 0) }}">
                                <img src="{{ asset($picture->orig) }}">
                                <button type="button" class="del-img btn btn-app bg-danger" onclick="removeGallery(this)"><i class="far fa-trash-alt"></i></button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>