@extends(theme('layouts.dashboard_master'))
@section('title')
    {{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('blog.Add Post')}}
@endsection
@section('css')
    <link href="{{asset('backend/css/summernote-bs4.min.css/')}}{{assetVersion()}}" rel="stylesheet">
    <link rel="stylesheet"
          href="{{asset('Modules/Blog/Resources/views/assets/taginput/tagsinput.css')}}{{assetVersion()}}"/>
    <link rel="stylesheet" href="{{asset('Modules/Blog/Resources/views/assets/frontend.css')}}{{assetVersion()}}"/>
    <style>

        input[type="date"]::-webkit-calendar-picker-indicator, input[type="time"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }
    </style>
@endsection
@section('js')
    <script src="{{asset('backend/js/summernote-bs4.min.js')}}{{assetVersion()}}"></script>
    <script src="{{asset('Modules/Blog/Resources/views/assets/taginput/tagsinput.js')}}{{assetVersion()}}"></script>
    <script src="{{asset('Modules/Blog/Resources/views/assets/frontend.js')}}"></script>
@endsection

@section('mainContent')
    <div class="main_content_iner main_content_padding">
        <div class="dashboard_lg_card">
            <div class="container-fluid no-gutters">
                <div class="my_courses_wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="section__title3 margin-50">
                                <h5>
                                    {{ __("blog.Edit Post") }}
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-12">
                            <form enctype="multipart/form-data" action="{{ route('users.blogs.update',$blog->id) }}"
                                  method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{ __("blog.Title") }} *</label>
                                            <input value="{{ $blog->title }}" type="text" class="primary_input4"
                                                   name='title[en]' id="blog_title" placeholder="Enter Blog Title">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{ __("blog.Description") }} </label>
                                            <textarea class="lms_summernote"
                                                      name="description[en]">{{ $blog->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{ __("blog.Slug") }} *</label>
                                            <input type="text" value="{{ $blog->slug }}" class="primary_input4"
                                                   name='slug' id="slug">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{ __("blog.Category") }} *</label>
                                            <select name="category" class="theme_select my-course-select w-100">
                                                <option value="" data-display="{{ __('blog.Category') }}">
                                                    {{ __('blog.Category') }}</option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        {{ $category->id == $blog->category_id ? "selected":'' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{ __("blog.Tags") }}</label>
                                            <input type="text" value="{{ $blog->tags }}" data-role="tagsinput"
                                                   name="tags" class="primary_input4">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{__('blog.Thumbnail')}}</label>
                                            <input type="file" name="image">
                                            <input type="hidden" name="old_image" value="{{ $blog->image }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div id="imagePreviewContainer">
                                            <img id="imagePreview" src="{{ getBlogImage($blog->image) }}"
                                                 alt=""
                                                 class="img-thumbnail" style="max-width: 200px">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{__("blog.Publish Date")}}</label>
                                            <input type="date"
                                                   value="{{ \Carbon\Carbon::parse($blog->authored_date)->format('Y-m-d') }}"
                                                   id="publish_date"
                                                   name="publish_date" class="primary_input4 date">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class='primary_label2'>{{__("blog.Publish Time")}}</label>
                                            <input type="time" value="{{ $blog->authored_time }}" id="start_time"
                                                   name="publish_time" class="primary_input4 time"/>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <button class="theme_btn mt-3 text-center">{{__('common.Update')}}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
