@extends(theme('layouts.full_screen_master'))
@section('title')
    {{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{ $course->title}}
@endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/full_screen.css')}}{{assetVersion()}}" rel="stylesheet"/>
    <style>
        .default-font {
            font-family: "Jost", sans-serif;
            font-weight: normal;
            font-style: normal;
            font-weight: 400;
        }

        .primary_checkbox {
            z-index: 99;
        }

        @media (max-width: 767.98px) {
            .contact_btn {
                margin: 0 !important;
                justify-content: space-between;
            }

            #video-placeholder {
                height: 300px;
            }
        }

        .course__play_warp.courseListPlayer:before {
            background-color: transparent;
        }

        @media (max-width: 991.98px) {
            .mobile-min-height {
                height: 330px !important;
            }
        }

        #ExternalHeaderViewerChromeTopBars {
            display: none !important;
        }

        .quiz_questions_wrapper {
            height: 100%;
        }

        .question_number_lists {
            max-height: 320px;
            overflow: auto;
        }

        .logo_img {
            max-width: 150px;
            height: 50px;
            display: inline-block;
        }

        .logo_img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        @media (max-width: 991.98px) {
            .header_area .header__wrapper .header__left .logo_img img {
                padding: .5rem !important
            }
        }

        .inline-YTPlayer {
            height: auto !important;
        }

        .quiz_score_wrapper .quiz_test_body .score_view_wrapper {
            justify-content: space-around;
        }

        .course_fullview_wrapper {
            width: 100%;
            padding-left: 0;
            padding-right: 0;
        }
    </style>
@endsection

@section('mainContent')

    <header>
        <div id="sticky-header" class="header_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="header__wrapper flex-wrap">
                            <!-- header__left__start  -->
                            <div class="header__left d-flex align-items-center">
                                <div class="">
                                    <a class="logo_img" href="{{url('/')}}">
                                        <img class="p-2" src="{{getLogoImage(Settings('logo') )}}" width="150"
                                             alt="{{ Settings('site_name')  }}">
                                    </a>
                                </div>
                                <div class="category_search d-none d-lg-flex category_box_iner">
                                    <div class="input-group-prepend2 pl-3 ">
                                        <a class="headerTitle"
                                           href="{{ courseDetailsUrl($course->id, $course->type, $course->slug) }}">
                                            <h4 class="headerTitle">{{ $course->title }}</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="course_fullview_wrapper">


        @if ($class->host == 'Youtube')
            @php
                if (Str::contains($class->link, '&')) {
                    $video_id = explode('=', $class->link);
                    $youtube_url = youtubeVideo($video_id[1]);
                } else {
                    $youtube_url = getVideoId(showPicName(@$class->link));
                }

            @endphp
            @if (Settings('youtube_default_player'))
                <div style="" id="video-placeholder"></div>
                <input class="d-none" type="text" id="progress-bar">
                <input type="hidden" name="" id="youtube_video_id" value="{{ $youtube_url }}">

                @push('js')
                    <script src="https://www.youtube.com/iframe_api"></script>
                    <script>
                        var source_video_id = $('#youtube_video_id').val();
                        var player;

                        // val youtube_video_id=$('#youtube_video_id').val();
                        function onYouTubeIframeAPIReady() {
                            console.log('yt api');
                            player = new YT.Player('video-placeholder', {
                                videoId: source_video_id,
                                height: '100%',
                                width: '100%',
                                host: '{{ request()->secure() ? 'https' : 'http' }}://www.youtube-nocookie.com',
                                playerVars: {
                                    color: 'white',
                                    controls: {{ Settings('show_seek_bar') ? 1 : 0 }},
                                    showinfo: 0,
                                    // rel: 0,
                                    modestbranding: 1,
                                    enablejsapi: 1,
                                    iv_load_policy: 3,
                                    html5: 1,
                                    fs: 1,
                                    cc_load_policy: 1,
                                    start: 0,
                                    origin: window.location.host
                                },
                                events: {
                                    onReady: initialize

                                }
                            });

                        }

                        function initialize() {
                            updateTimerDisplay();
                            updateProgressBar();

                            player.playVideo();
                            console.log('play');
                            time_update_interval = setInterval(function () {
                                updateTimerDisplay();
                                updateProgressBar();
                            }, 1000)

                        }

                        // player.addEventListener("onStateChange", function(state){
                        //     if(state === 0){
                        //         console.log('video complete');
                        //         classAutoComplete(course_id,{{ showPicName(Request::url()) }});
                        //     }
                        // });
                        function updateProgressBar() {
                            $('#progress-bar').val((player.getCurrentTime() / player.getDuration()) * 100);
                        }

                        function updateTimerDisplay() {
                            $('#currentTime').text(formatTime(player.getCurrentTime()));
                            $('#totalTime').text(formatTime(player.getDuration()));
                            if (player.getCurrentTime() >= player.getDuration()) {
                                if (!completeRequest) {
                                    classAutoComplete(course_id, {{ showPicName(Request::url()) }});
                                    completeRequest = true;
                                }

                            }
                        }


                        function formatTime(time) {
                            time = Math.round(time);
                            var minutes = Math.floor(time / 60),
                                seconds = time - minutes * 60;
                            seconds = seconds < 10 ? '0' + seconds : seconds;
                            return minutes + ":" + seconds;
                        }

                        $('#progress-bar').on('mouseup touchend', function (e) {
                            var newTime = player.getDuration() * (e.target.value / 100);
                            player.seekTo(newTime);
                        });

                        function updateProgressBar() {
                            $('#progress-bar').val((player.getCurrentTime() / player.getDuration()) * 100);
                        }
                    </script>
                @endpush
            @else
                <link href="{{ asset('public/frontend/infixlmstheme/plugins/css/jquery.mb.YTPlayer.min.css') }}"
                      media="all" rel="stylesheet" type="text/css">

                <script src="{{ asset('public/frontend/infixlmstheme/plugins/jquery.mb.YTPlayer.js') }}"></script>

                <div class="video_iframe" id="video-id"
                     data-property="{videoURL:'http://youtu.be/{{ $youtube_url }}',containment:'self',   mute:false, startAt:0, loop:false, opacity:1,seekbar:{{ Settings('show_seek_bar') ? 'true' : 'false' }}}">
                    Loading...
                </div>
                <script>
                    jQuery(function () {
                        $("#video-id").YTPlayer();

                        $("#video-id").on("YTPEnd", function (e) {
                            if (!completeRequest) {
                                classAutoComplete(course_id, {{ showPicName(Request::url()) }});
                                completeRequest = true;
                            }
                        });
                    });
                </script>
            @endif
        @endif
        {{-- End Youtube --}}

        @if ($class->host == 'Vimeo')
            <div class="video_wrapper">
                <iframe class="video_iframe" id="video-id"
                        src="https://player.vimeo.com/video/{{ getVideoId(showPicName(@$class->link)) }}?autoplay=1&"
                        frameborder="0" controls="1" allowfullscreen></iframe>
            </div>
            <script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>

            @push('js')
                <script src='https://player.vimeo.com/api/player.js'></script>
                <script>
                    $(function () {
                        var iframe = $('#video-id')[0];
                        var player = new Vimeo.Player(iframe);
                        var status = $('.status');


                        player.on('pause', function () {
                            console.log('paused');
                        });

                        player.on('ended', function () {
                            console.log('ended');
                            console.log(completeRequest)
                            if (!completeRequest) {
                                classAutoComplete(course_id, {{ showPicName(Request::url()) }});
                                completeRequest = true;
                            }
                            status.text('End');


                        });

                        player.on('timeupdate', function (data) {
                            console.log(data.seconds + 's played');
                        });

                    });
                </script>
            @endpush
        @endif




        @if ($class->host == 'Self')
            <video class="" id="video-id" controls autoplay>
                <source src="{{ asset($class->link) }}" type="video/mp4"/>
                <source src="{{ asset($class->link) }}" type="video/ogg">
            </video>
        @endif



        @if ($class->host == 'URL')
            <video class="" id="video-id" controls autoplay
                   onended="classAutoComplete(course_id, {{ showPicName(Request::url()) }})">
                <source src="{{ $class->link }}" type="video/mp4">
                <source src="{{ $class->link }}" type="video/ogg">
                Your browser does not support the video.
            </video>
        @endif

    </div>

@endsection
@push('js')

    <script>
        $(document).ready(function () {
            if ($('.active').length) {
                let active = $('.active');
                let parent = active.parents('.collapse').first();
                parent.addClass('show');
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {


            if (window.outerWidth < 425) {
                $('.courseListPlayer').toggleClass("active");
                $('.course_fullview_wrapper').toggleClass("active");
            }


        });
    </script>

    @if ($class->host == 'Self' || $class->host == 'AmazonS3' || $class->host == 'URL')
        <script>
            let myFP = fluidPlayer(
                'video-id', {
                    "layoutControls": {
                        "controlBar": {
                            "autoHideTimeout": 3,
                            "animated": true,
                            "autoHide": true
                        },
                        "htmlOnPauseBlock": {
                            "html": null,
                            "height": null,
                            "width": null
                        },
                        "autoPlay": true,
                        "mute": false,
                        "hideWithControls": false,
                        "allowTheatre": false,
                        "playPauseAnimation": true,
                        "playbackRateEnabled": false,
                        "allowDownload": false,
                        "playButtonShowing": true,
                        "fillToContainer": true,
                        "posterImage": ""
                    },
                    "vastOptions": {
                        "adList": [],
                        "adCTAText": false,
                        "adCTATextPosition": ""
                    }
                });
        </script>

        @if (!Settings('show_seek_bar'))
            <style>
                div#video-id_fluid_controls_progress_container {
                    display: none;
                }
            </style>
            <script>
                if ($('#video-id').length) {
                    var video = document.getElementById('video-id');
                    var supposedCurrentTime = 0;
                    video.addEventListener('timeupdate', function () {
                        if (!video.seeking) {
                            supposedCurrentTime = video.currentTime;
                        }
                    });
                    // prevent user from seeking
                    video.addEventListener('seeking', function () {
                        // guard agains infinite recursion:
                        // user seeks, seeking is fired, currentTime is modified, seeking is fired, current time is modified, ....
                        var delta = video.currentTime - supposedCurrentTime;
                        if (Math.abs(delta) > 0.01) {
                            console.log("Seeking is disabled");
                            video.currentTime = supposedCurrentTime;
                        }
                    });
                    // delete the following event handler if rewind is not required
                    video.addEventListener('ended', function () {
                        // reset state in order to allow for rewind

                    });
                }
            </script>
        @endif
    @endif

    <script src="{{ asset('public/frontend/infixlmstheme/js/class_details.js') }}"></script>
    <script src="{{ asset('public/frontend/infixlmstheme/js/full_screen_video.js') }}"></script>

@endpush
