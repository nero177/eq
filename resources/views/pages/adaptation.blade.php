@extends('layouts.front')
@section('content')
    <main class="adaptation">
        <section class="banner" style="background-image: url({{ asset('/assets/images/adaptation/adaptation-bg.jpg') }});">
            <div class="content wrapper">
                <div class="info">
                    <h4 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                        запис майстер-класу
                    </h4>
                    <h2 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                        {!! $adaptation->title !!}
                    </h2>
                    <p data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1500">
                        {!! $adaptation->desc !!}
                    </p>
                    @if (!has_lesson_access($adaptation->id, App\Enums\LessonType::ADAPTATION))
                        <div class="offer" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            <div class="price">
                                <span>
                                    <h3>{{ $adaptation->price_with_discount }}</h3>
                                    <p>₴</p>
                                </span>
                                @if ($adaptation->discount)
                                    <span class="old-price">{{ format_price($adaptation->price) }}
                                        <p>₴</p>
                                    </span>
                                @endif
                            </div>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $adaptation->id }}">
                                <input type="hidden" name="price" value="{{ $adaptation->price_with_discount }}">
                                <input type="hidden" name="title" value="{{ $adaptation->title }}">
                                <input type="hidden" name="type" value="{{ App\Enums\OrderableType::LESSON }}">
                                <button type="submit" class="buy-btn fbq-add-event"
                                fbq-id="{{ $adaptation->id }}"
                                fbq-type="{{ App\Enums\OrderableType::LESSON }}" fbq-name="{{ $adaptation->title }}"
                                fbq-category="Адаптація"
                                fbq-price="{{ $adaptation->price_with_discount }}"
                                >{{ __('site.buy_course') }}</button>
                            </form>
                        </div>
                    @else
                        <a style="margin-top: 20px" class="free-view-btn"
                            href="{{ localize_url('/cabinet/lesson/' . $adaptation->id) }}">{{ __('site.show') }}</a>
                    @endif

                    <div style="margin-top: 20px">
                        <x-favorite-button :id="$adaptation->id" :type="App\Enums\OrderableType::LESSON" />
                    </div>
                </div>
            </div>
        </section>

        <section class="adaptation-description">
            <div class="content wrapper">
                <div class="authors">
                    <div class="authors-wrap" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="900">
                        <div class="author-item">
                            <div class="author-thumb">
                                <img src="{{ asset('/assets/images/adaptation/author1.jpg') }}" alt="author" />
                            </div>
                            <div class="author-content">
                                <div class="prof">Викладач</div>
                                <div class="name">Андрій Крупчинський</div>
                            </div>
                        </div>
                        <div class="author-item">
                            <div class="author-thumb">
                                <img src="{{ asset('/assets/images/adaptation/author2.jpg') }}" alt="author" />
                            </div>
                            <div class="author-content">
                                <div class="prof">Викладач</div>
                                <div class="name">Дмитро Кузьмичов</div>
                            </div>
                        </div>
                    </div>
                    <div class="adaptation-info" data-aos="fade-left" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="900">
                        <div class="info-item">
                            <div class="value">{{ get_option('creators_count') }}</div>
                            <div class="feature">креатори</div>
                        </div>
                        <div class="info-item">
                            <div class="value">{{ get_option('hours_count') }}</div>
                            <div class="feature">годин</div>
                        </div>
                        <div class="info-item">
                            <div class="value">{{ get_option('month_access') }}</div>
                            <div class="feature">
                                місяців <br />
                                доступу
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <div class="col-1" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                        <div class="title">опис</div>
                        {!! get_option('desc') !!}
                        @if (has_lesson_access($adaptation->id, \App\Enums\LessonType::MASTER_CLASS))
                            <a class="free-view-btn"
                                href="{{ localize_url('/cabinet/lesson/' . $adaptation->id) }}">{{ __('site.show') }}</a>
                        @else
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $adaptation->id }}">
                                <input type="hidden" name="price" value="{{ $adaptation->price_with_discount }}">
                                <input type="hidden" name="title" value="{{ $adaptation->title }}">
                                <input type="hidden" name="type" value="{{ App\Enums\OrderableType::LESSON }}">
                                <button type="submit" class="buy-btn fbq-add-event"
                                fbq-id="{{ $adaptation->id }}"
                                fbq-type="{{ App\Enums\OrderableType::LESSON }}" fbq-name="{{ $subscription->title }}"
                                fbq-category="Адаптація"
                                fbq-price="{{ $adaptation->price_with_discount }}"
                                >{{ __('site.buy_course') }}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-2" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="1300">
                        <div class="title">чому навчаться</div>
                        <ul>
                            {!! $adaptation->you_will_learn !!}
                        </ul>
                    </div>
                </div>
                <div class="schedule-wrap">
                    <div class="schedule">
                        <div class="col-1" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            <div class="title">вступ</div>
                        </div>
                        <div class="col-2" data-aos="fade-left" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            <div class="schedule-item">
                                <div class="time">00:00:00</div>
                                <div class="text">Знайомство</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">00:01:35</div>
                                <div class="text">
                                    Історія створення та цінності бренду ERTEQOOB
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">00:10:00</div>
                                <div class="text">Натхнення та як його використовувати</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">00:54:46</div>
                                <div class="text">Від натхнення до створення</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">01:31:43</div>
                                <div class="text">Що таке Адаптація</div>
                            </div>
                        </div>
                    </div>
                    <div class="schedule">
                        <div class="col-1" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            <div class="title">основи і принципи антропометрії</div>
                        </div>
                        <div class="col-2" data-aos="fade-left" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            <div class="schedule-item">
                                <div class="time">01:39:12</div>
                                <div class="text">
                                    Комплекція та положення тіла. Форми облич
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">02:11:10</div>
                                <div class="text">
                                    Приклад проведення адаптації та підбору форми для клієнта
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">02:33:43</div>
                                <div class="text">Форми голови та профілі</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">02:39:33</div>
                                <div class="text">Просторова вісь</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">02:51:45</div>
                                <div class="text">Демо-робота</div>
                            </div>

                            <div class="schedule-item">
                                <div class="time">03:35:21</div>
                                <div class="text">Типи щільності волосся</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">04:04:53</div>
                                <div class="text">Точки та розподіл на зони</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">04:36:28</div>
                                <div class="text">Презентація демо-роботи</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">04:52:25</div>
                                <div class="text">
                                    Візуальні приклади форм облич та стрижок
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">05:08:03</div>
                                <div class="text">Паралелі та перпендикуляри. Пропорції</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">05:19:00</div>
                                <div class="text">Покрокове визначення форми для клієнта</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">05:37:35</div>
                                <div class="text">Форми носа. Форми вуха. Око</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">05:46:40</div>
                                <div class="text">
                                    Що на що впливає при побудові форми. Види структур
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">05:53:48</div>
                                <div class="text">Результати адаптації. Звички</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">06:19:16</div>
                                <div class="text">Адаптація для чоловіків</div>
                            </div>
                        </div>
                    </div>
                    <div class="schedule">
                        <div class="col-1" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            <div class="title">
                                технології. взаємодія з клієнтом. позиціонування
                            </div>
                        </div>
                        <div class="col-2" data-aos="fade-left" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            <div class="schedule-item">
                                <div class="time">06:38:43</div>
                                <div class="text">Знання та ідеї. Взаємодія з клієнтом</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">06:55:06</div>
                                <div class="text">Технології. Класика та інновація</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">07:06:55</div>
                                <div class="text">
                                    Малюнок. Презентація правильної адаптації
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">07:31:38</div>
                                <div class="text">Чого хоче клієнт</div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">07:58:50</div>
                                <div class="text">
                                    Характерність та гармонійність. Питання та відповіді
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">08:11:47</div>
                                <div class="text">
                                    Етапи рівномірного розподілу навантаження у роботі
                                </div>
                            </div>
                            <div class="schedule-item">
                                <div class="time">08:27:05</div>
                                <div class="text">Позиціювання. Коло «КузКруп»</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-subscriptions-section />
    </main>
@endsection
