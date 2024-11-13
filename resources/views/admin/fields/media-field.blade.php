<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">
        @include('admin::form.error')

        <img src="{{ $media ? $media->getUrl() : '' }}" alt="" class="mb-3" @if ($media) style="display: block; max-width: 100%" @else style="display: none;" @endif>
        @if ($media)
            <p><a href="{{ $deleteUrl }}" class="delete-media-btn">Видалити зображення</a></p>
        @endif
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="{{$id}}" name="{{$name}}" accept="image/*" x-on:change.prevent="preloadMedia" {!! $attributes !!}>
        </div>
    </div>
</div>

