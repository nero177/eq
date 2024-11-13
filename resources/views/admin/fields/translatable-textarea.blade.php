@foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalesOrder() as $lang => $langData)
    <div class="form-group">
        <label for="desc_ru" class="col-sm-2  control-label">{{ $label }} {{$langData['native']}}</label>
        <div class="col-sm-8">
            <textarea name="{{ $name }}[{{$lang}}]" class="form-control" rows="5">{{ $values[$lang] ?? '' }}</textarea>
        </div>
    </div>
@endforeach
