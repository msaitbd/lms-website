@if (isset($result))
    <div class="row">

        <div class="col-12">
            <div class="course-title d-flex flex-wrap align-items-center">
                <h5 class="mb-0">{{ __('frontend.Showing') }} {{ $result->firstItem() }}–{{ $result->lastItem() }} of
                    {{ $result->total() }} {{ __('product.Results') }}</h5>
                <ul class="d-flex align-items-center flex-wrap mb-2 mb-md-0 ml-auto view-option">

                    <li>
                        <select class="search-hide" id="custom_pagination">
                            <option
                                value="12" {{ request('custom_pagination') == '12' ? 'selected' : '' }}>{{__('common.Show')}}
                                12
                                {{__('common.Items')}}
                            </option>
                            <option
                                value="20" {{ request('custom_pagination') == '20' ? 'selected' : '' }}>{{__('common.Show')}}
                                20
                                {{__('common.Items')}}
                            </option>
                            <option
                                value="32" {{ request('custom_pagination') == '32' ? 'selected' : '' }}>{{__('common.Show')}}
                                32
                                {{__('common.Items')}}
                            </option>
                            <option
                                value="40" {{ request('custom_pagination') == '40' ? 'selected' : '' }}>{{__('common.Show')}}
                                40
                                {{__('common.Items')}}
                            </option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>

        @forelse ($result as $course)
            <div class="col-xl-4 col-sm-6 d-flex mb-4">
                <div class="shop-item bg-white w-100">
                    <div class="text-center position-relative">
                        <div class="shop-item-rating">

                            @php
                                $main_stars= $course->total_rating;
                                if ($main_stars>=4){
                                    $main_stars =5;
                                }
                                $stars=intval($main_stars);
                                $remain =ceil(5-$main_stars);
                                if($remain>4){
                                    $remain=5;
                                }

                            @endphp
                            @for ($i = 0; $i <  $stars; $i++)
                                <i class="fas fa-star text-primary"></i>
                            @endfor
                            @if ($main_stars>$stars)
                                <i class="fas fa-star-half text-primary"></i>
                            @endif
                            @if($main_stars==0)
                                @for ($i = 0; $i <  5; $i++)
                                    <i class="far fa-star text-primary"></i>
                                @endfor
                            @else
                                @for ($i = 0; $i <  $remain; $i++)
                                    <i class="far fa-star text-primary"></i>
                                @endfor
                            @endif
                        </div>
                        <a href="{{ courseDetailsUrl(@$course->id, @$course->type, @$course->slug) }}"
                           class="shop-item-img d-block">
                            <img class="img-fluid" src="{{ getCourseImage($course->product?->thumbnail) }}"
                                 alt="">
                        </a>
                    </div>
                    <div class="shop-item-content">
                        <span>{{ @$course->product_category->title }}</span>
                        <h4><a href="{{ courseDetailsUrl(@$course->id, @$course->type, @$course->slug) }}"
                               class="currentColor">{{ $course->title }}</a>
                        </h4>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                @if ($course->product?->discount > 0)
                                    <del class="d-block fw-500">

                                        {{ getPriceFormat(@$course->product->price) }}
                                    </del>

                                @endif
                                <strong class="fw-bold d-block">
                                    @php
                                        if (@$course->product->discount_type == 1) {
                                            $price = $course->product->price - $course->product?->discount;
                                        } elseif (@$course->product->discount_type == 2) {
                                            $price = $course->product->price - ($course->product->price * $course->product?->discount) / 100;
                                        } else {
                                            $price = $course->product?->price;
                                        }
                                    @endphp
                                    {{ getPriceFormat($price) }}
                                </strong>
                            </div>
                            <div>
                                <a href="{{route('buyNow',[@$course->id])}}"
                                   class="theme-btn buyNow"><i
                                        class="fa fa-shopping-cart"></i>{{ __('common.Buy Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-lg-12 mb-4 mt-5">
                <div class="Nocouse_wizged text-center d-flex align-items-center justify-content-center">
                    <div class="thumb">
                        <img style="width: 50px" src="{{ asset('public/frontend/infixlmstheme') }}/img/not-found.png"
                             alt="">
                    </div>
                    <h1>
                        {{ __('product.No Product Found') }}
                    </h1>
                </div>
            </div>
        @endforelse
        @if (isset($has_pagination))
            {{ $result->appends(Request::all())->links(theme('snippets.components._dynamic_pagination')) }}
        @endif
    </div>
    <input type="hidden" value="{{asset('/')}}" id="baseUrl">

    <script>
        $(document).ready(function () {
            // select js
            $(".search-hide").select2({
                minimumResultsForSearch: Infinity,
            });
        });

        if ($.isFunction($.fn.lazy)) {
            $('.lazy').lazy();
        }
    </script>
@endif
