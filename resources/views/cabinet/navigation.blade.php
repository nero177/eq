<div class="cabinet-title-wrap">
    <div class="cabinet-title">{{ __('site.cabinet') }}</div>
    <nav class="menu-cabinet-nav">
        <label for="drop" class="toggle">
            {{ __('site.cabinet_menu') }}
            <svg class="icon">
                <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-down' }}"></use>
            </svg>
        </label>
        <input type="checkbox" id="drop" />
        <ul class="menu-cabinet">
            <li><a href="{{ localize_url('/cabinet') }}">{{ __('site.main_page') }}</a></li>
            <li>
                <!-- First Tier Drop Down -->
                <label for="drop-1" class="toggle">{{ __('site.profile') }}
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-down' }}"></use>
                    </svg>
                </label>
                <a href="{{ localize_url('/cabinet') }}">
                    {{ __('site.profile') }}
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-down' }}"></use>
                    </svg>
                </a>
                <input type="checkbox" id="drop-1" />
                <ul>
                    <li><a href="{{ localize_url('/cabinet/orders') }}">{{ __('site.last_orders') }}</a></li>
                    <li><a href="{{ localize_url('/cabinet/edit') }}">{{ __('site.edit_data') }}</a></li>
                </ul>
            </li>
            <li>
                <!-- First Tier Drop Down -->
                <label for="drop-2" class="toggle">{{ __('site.my_courses') }}
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-down' }}"></use>
                    </svg>
                </label>
                <a href="#">{{ __('site.my_courses') }}
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-down' }}"></use>
                    </svg>
                </a>
                <input type="checkbox" id="drop-2" />
                <ul>
                    <li><a href="{{ localize_url('/cabinet/master-classes') }}">{{ __('site.master_classes') }}</a>
                    </li>
                    <li>
                        <label for="drop-3" class="toggle">{{ __('site.collections') }}
                            <svg class="icon">
                                <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-down' }}"></use>
                            </svg>
                        </label>
                        <a href="#">{{ __('site.collections') }}
                            <svg class="icon">
                                <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-down' }}"></use>
                            </svg>
                        </a>
                        <input type="checkbox" id="drop-3" />
                        <ul>
                            @foreach ($collectionMenuItems as $slug => $title)
                                <li><a
                                        href="{{ localize_url('/cabinet/collection/' . $slug) }}">{{ strip_tags(str_replace('<br>', ' ', $title)) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ localize_url('/cabinet/videocourses') }}">{{ __('site.videocourse') }}</a>
                    </li>
                    <li>
                        <a
                            href="{{ localize_url('/cabinet/fundamental-theory') }}">{{ __('site.fundamental_theory') }}</a>
                    </li>
                    <li>
                        <a href="{{ localize_url('/cabinet/adaptation') }}">{{ __('site.adaptation') }}</a>
                    </li>
                    <li>
                        <a href="{{ localize_url('/cabinet/film') }}">{{ __('site.film') }}</a>
                    </li>
                </ul>
            </li>
            @auth
                <li>
                    <a href="{{ localize_url('/cabinet/favorites') }}">{{ __('site.choosed') }}
                        <span>({{ auth()->user()->favorites()->count() }})</span></a>
                </li>
            @endauth
            <li><a href="{{ localize_url('/cabinet/new-forms') }}">{{ __('site.new_forms') }}</a></li>
        </ul>
    </nav>

    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="quit">
                <svg class="icon">
                    <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#quit' }}"></use>
                </svg>
                {{ __('site.logout') }}
            </button>
        </form>
    @endauth
</div>
