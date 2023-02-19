@extends('layouts.app')

@section('title', 'Article')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Discover</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active all"
                                            href="#">All <span class="badge count badge-white">1</span></a>
                                    </li>
                                    @foreach ($categories as $key => $value)
                                    <li class="nav-item ml-2">
                                        <a class="nav-link {{ $key }}"
                                            href="#">{{ ucwords($key) }} <span class="badge count badge-primary">{{ $categories["$key"][2] }}</span></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($categories as $key => $value)
                    @foreach ($categories["$key"][1] as $channel)
                    <div class="col-12 col-md-6 col-lg-4 {{ $key }}-channel">
                        <article class="article article-style-c">
                            <div class="article-header">
                                @if($channel->profile)

                                @else
                                <div class="article-image"
                                    data-background="{{ asset('img/news/img01.jpg') }}">
                                </div>
                                @endif
                            </div>
                            <div class="article-details">
                                <div class="article-category font-weight-bold"><a>{{ $key }}</a>
                                    <div class="bullet"></div> <a>Member {{ $channel->totalMember() }}</a>
                                </div>
                                <div class="article-title">
                                    <h2><a href="#">{{ $channel->name }}</a></h2>
                                </div>
                                <p>{{ $channel->description }}</p>
                                <div class="article-cta">
                                    <a href="#"
                                        class="btn btn-primary">Join Channel</a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    function resetFilter() {
        @php
            $channels = "channel";
            $keys = "";
            foreach ($categories as $except => $value) {
                $channels .= ", .$except-channel";
                $keys .= ", .$except";
            }
        @endphp
        $(".all{{ $keys }}").removeClass('active').find('.count').removeClass('badge-white')
        $('{{ $channels }}').removeClass('d-none')
    }

    $('.all').click(function (e) {
        resetFilter()
        $(this).addClass('active').find('.count').addClass('badge-white')
    });

    @foreach ($categories as $key => $value)
    $(".{{ $key }}").click(function (e) {
    @php
        $channels = ".channel";
        foreach ($categories as $except => $value) {
            if ($key != $except) {
                $channels .= ", .$except-channel";
            }
        }
    @endphp
        resetFilter()
        $("{{ $channels }}").addClass('d-none');
        $(this).addClass('active').find('.count').addClass('badge-white')
    });
    @endforeach
});
</script>
@endpush
