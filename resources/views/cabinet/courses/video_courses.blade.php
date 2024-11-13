@extends('layouts.front')
@section('content')

<main class="cabinet">
    <div class="content wrapper">
      <x-cabinet-navigation />

      <div class="cabinet-subtitle">{!! __('site.videocourse') !!}</div>
    </div>
    <section class="lessons-grid content wrapper">
      <div class="grid-container">
        @foreach ($lessons as $lesson)
        <a
          class="item aos-init aos-animate"
          data-aos="fade-up"
          data-aos-anchor-placement="top-bottom"
          data-aos-duration="800"
          href="{{ localize_url('/cabinet/lesson/'.$lesson->id) }}"
        >
          <img
            src="{{ $lesson->getFirstMediaUrl('thumbnail') }}"
            alt="lesson"
          />

          <div class="title-count-wrap">
            <div class="title">{{ $lesson->title }}</div>
            <div class="count">{{ (($lesson->order < 10) ? '0' : '') . $lesson->order }}</div>
          </div>
        </a>
        @endforeach
      </div>
    </section>
  </main>


@endsection
