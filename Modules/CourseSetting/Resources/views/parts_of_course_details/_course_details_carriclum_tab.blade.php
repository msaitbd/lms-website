<div role="tabpanel"
     class="tab-pane fade  @if ($type == 'courses') show active @endif "
     id="group_email_sms">

    <div class="QA_section QA_section_heading_custom check_box_table   ">
        <div class="QA_table ">
            <!-- table-responsive -->


            @if (count($chapters) == 0)
                <div class="text-center">
                    {{ __('courses.No Data Found') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="">

                        {{-- Start Udemy Design --}}
                        <style>
                            .add-item-forms--inline-menu--1OTdc {
                                margin-bottom: -25px;
                                padding: 10px;
                                border: 1px solid #9b34ef;
                                background: #fff;
                                height: 55px;
                                display: flex;
                                border-radius: 50px;
                            }

                            .section_content {
                                margin-bottom: 0px;
                                padding: 10px;
                                border: 1px solid #9b34ef;
                                background: #fff;
                                border-radius: 50px;
                            }

                            .col-lg-10.section_content {
                                margin-top: 50px;
                            }

                            .lms_option_box {
                                box-sizing: border-box;
                            }

                            .lms_option_list {
                                width: 650px;
                            }

                            .lms_option_list_inside {
                                width: 650px;
                            }

                            .btn-block + .btn-block {
                                margin-top: 0;
                            }

                            .section-white-box {
                                background: #ffffff;
                                padding: 40px 30px;
                                border-radius: 50px;
                                box-shadow: 0px 10px 15px rgb(236 208 244 / 30%);
                                border-radius: 50px;
                            }
                        </style>
                        <hr>
                        <div class="row d-flex">
                            <div class="col-lg-2">
                                <button
                                    class="primary-btn icon-only mr-10 fix-gr-bg p-0  align-items-center justify-content-center"
                                    id="add_option_box" style="display: flex"><i
                                        class="ti-plus m-0"></i></button>
                                <button
                                    class="primary-btn icon-only mr-10 fix-gr-bg"
                                    id="minus_option_box" style="display: none">X
                                </button>
                            </div>
                            <div class="col-lg-10">
                                <div class="lms_option_box d-flex">
                                    <div class="pt-20 pb-30 lms_option_list"
                                         style="display: none">
                                        <div
                                            class="add-item-forms--inline-menu--1OTdc">
                                            <button data-purpose="add-chapter-btn"
                                                    aria-label="Add Chapter"
                                                    type="button"
                                                    id="show_chapter_section"
                                                    class="ellipsis btn btn-tertiary btn-block">
                                                <i class="ti-plus"></i>
                                                {{ __('courses.Chapter') }}
                                            </button>
                                            <button data-purpose="add-lesson-btn"
                                                    aria-label="Add Lesson"
                                                    type="button"
                                                    id="show_lesson_section"
                                                    class="ellipsis btn btn-tertiary btn-block">
                                                <i class="ti-plus"></i>
                                                {{ __('courses.Lesson') }}
                                            </button>
                                            <button data-purpose="add-quiz-btn"
                                                    aria-label="Add Quiz"
                                                    type="button"
                                                    id="show_quiz_section"
                                                    class="ellipsis btn btn-tertiary btn-block">
                                                <i class="ti-plus"></i>
                                                {{ __('quiz.Quiz') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row" id="chapter_section" style="display: none">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10 section_content">
                                @include('coursesetting::parts_of_course_details.chapter_section_add')
                            </div>
                            <div class="col-lg-1"></div>

                        </div>
                        <div class="row" id="lesson_section" style="display: none">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10 section_content">
                                @include('coursesetting::parts_of_course_details.lesson_section')
                            </div>
                            <div class="col-lg-1"></div>

                        </div>
                        <div class="row" id="quiz_section" style="display: none">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10 section_content">
                                @include('coursesetting::parts_of_course_details.quiz_section')
                            </div>
                            <div class="col-lg-1"></div>

                        </div>
                        <div class="row" style="display: none">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10 section_content">

                            </div>
                            <div class="col-lg-1"></div>

                        </div>

                        {{-- START CHAPTER --}}

                        @include('coursesetting::parts_of_course_details.chapter_list')

                        {{-- END CHAPTER --}}
                        {{-- End Udemy Design --}}
                    </div>

                </div>
            </div>

            @push('js')
                <script>
                    var lms_option_list = $('.lms_option_list');
                    var minus_option_box = $('#minus_option_box');
                    var add_option_box = $('#add_option_box');
                    var chapter_section = $('#chapter_section');
                    var lesson_section = $('#lesson_section');
                    var quiz_section = $('#quiz_section');
                    $(document).ready(function () {
                        let lms_option_list = $('#lms_option_list').hide();
                    })
                    $('#add_option_box').click(function () {
                        lms_option_list.show();
                        minus_option_box.show();
                        add_option_box.hide();
                    })
                    $('#minus_option_box').click(function () {
                        lms_option_list.hide();
                        minus_option_box.hide();
                        lesson_section.hide();
                        quiz_section.hide();
                        chapter_section.hide();
                        add_option_box.show();
                    })
                    $('#show_chapter_section').click(function () {
                        lms_option_list.hide();
                        lesson_section.hide();
                        quiz_section.hide();
                        chapter_section.show();
                    })
                    $('#show_lesson_section').click(function () {
                        lms_option_list.hide();
                        lesson_section.show();
                        quiz_section.hide();
                        chapter_section.hide();
                    })
                    $('#show_quiz_section').click(function () {
                        lms_option_list.hide();
                        lesson_section.hide();
                        quiz_section.show();
                        chapter_section.hide();
                    })
                </script>
            @endpush

        </div>

    </div>

</div>
