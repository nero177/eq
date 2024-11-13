<div class="creators-slider owl-carousel" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
    @foreach ($authors as $author)
        <div class="teach">
            <img src="{{ $author->getFirstMediaUrl('photo') }}" alt="{{ $author->name }}" />
            <div class="name">
                <h3>{{ $author->details['author_name_' . get_current_locale()] ?? '' }}</h3>
                <h3>{{ $author->details['author_surname_' . get_current_locale()] ?? '' }}</h3>
            </div>
            <div class="position">
                <p>{{ $author->details['author_role_' . get_current_locale()] ?? '' }}</p>
            </div>
            <div class="list">
                @if ($author->achievements)
                    <ul>
                        @foreach ($author->achievements as $achievement)
                            @if (isset($achievement['col1_' . get_current_locale()]))
                                <li data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1100"
                                    data-aos-delay="200">
                                    {{ $achievement['col1_' . get_current_locale()] }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <ul>
                        @foreach ($author->achievements as $achievement)
                            @if (isset($achievement['col2_' . get_current_locale()]))
                                <li data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1100"
                                    data-aos-delay="200">
                                    {{ $achievement['col2_' . get_current_locale()] }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
