@if(\App\Services\FavoritesService::userFavorite($id))
<form action="{{ route('favorites.remove') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <button type="submit" class="like-btn liked">
        <svg class="icon">
            <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#like' }}"></use>
        </svg>
    </button>
</form>
@else
<form action="{{ route('favorites.add') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <button type="submit" class="like-btn">
        <svg class="icon">
            <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#like' }}"></use>
        </svg>
    </button>
</form>
@endif