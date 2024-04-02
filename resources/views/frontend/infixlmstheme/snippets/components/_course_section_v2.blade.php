<div data-type="component-text"
     data-preview="{{!function_exists('themeAsset')?'':themeAsset('img/snippets/preview/course/2.jpg')}}"
     data-aoraeditor-title="Course Section V2" data-aoraeditor-categories="Courses;Home Page">

    <style>
        .course {
            margin-top: var(--section-sepreate-lg)
        }

        .course-item {
            background-color: #fff;
            overflow: hidden;
            border-radius: 8px;
            margin-top: 24px;
            position: relative;
            top: 0;
            padding: 23px;
            transition: all .4s ease-in-out
        }

        @media only screen and (min-width: 1280px) and (max-width: 1439px) {
            .course-item {
                margin-top: 35px
            }
        }

        @media only screen and (min-width: 992px) and (max-width: 1279px) {
            .course-item {
                padding: 1rem;
                margin-top: 35px
            }
        }

        @media only screen and (max-width: 991px) {
            .course-item {
                margin-top: 30px
            }
        }

        .course-item:hover {
            top: -5px
        }

        .course-item-img {
            display: block;
            width: 100%;
            position: relative;
            overflow: hidden;
            padding-bottom: 55%;
            z-index: 1;
            border-radius: 6px
        }

        .course-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            transform: scale(1);
            transition: all .4s ease-in-out
        }

        .course-item-rating {
            background-color: #fff;
            position: relative;
            z-index: 1;
            --rating-user: 40px;
            margin-bottom: 18px
        }

        .course-item-rating i {
            font-size: 12px
        }

        @media only screen and (min-width: 1280px) and (max-width: 1439px) {
            .course-item-rating i {
                font-size: 11px
            }
        }

        .course-item-rating .user {
            width: var(--rating-user);
            height: var(--rating-user);
            border-radius: 100%;
            overflow: hidden;
            flex: 0 0 auto;
            border: 1px solid #98A6B4
        }

        .course-item-rating .user img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .course-item-rating .content {
            width: calc(100% - var(--rating-user));
            flex: 0 0 auto;
            padding-left: 8px
        }

        html[dir=rtl] .course-item-rating .content {
            padding-left: 0;
            padding-right: 8px;
        }

        .course-item-rating a {
            color: var(--system_primery_color)
        }

        .course-item-rating a:hover {
            color: var(--system_secendory_color)
        }

        .course-item-rating span {
            color: currentColor;
            font-size: 20px;
            line-height: 1.5;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            margin-bottom: 4px
        }

        @media only screen and (min-width: 992px) and (max-width: 1279px) {
            .course-item-rating span {
                font-size: 18px
            }
        }

        @media only screen and (max-width: 991px) {
            .course-item-rating span {
                font-size: 18px
            }
        }

        .course-item-content {
            padding: 0 12px;
            padding-top: 24px;
            padding-bottom: 15px
        }

        @media only screen and (max-width: 767px) {
            .course-item-content {
                padding: 0 6px
            }
        }

        .course-item-content .theme-btn {
            --btn-padding-y: 11px;
            --btn-padding-x: 26px;
            font-size: 12px;
            line-height: 1.5
        }

        .course-item-content-meta {
            font-size: 10px;
            line-height: 3;
            color: rgba(89, 102, 136, 0.8);
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .course-item-content-meta {
                font-size: 12px
            }
        }

        @media only screen and (max-width: 767px) {
            .course-item-content-meta {
                font-size: 12px;
                line-height: 1.5;
                margin-bottom: 12px !important
            }
        }

        .course-item-content-meta span {
            color: #596688
        }

        .course-item-title {
            margin-bottom: 26px;
            color: #596688;
            font-weight: 500;
            font-size: 24px;
            line-height: 1.25;
            min-height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        @media only screen and (min-width: 992px) and (max-width: 1279px) {
            .course-item-title {
                font-size: 22px
            }
        }

        @media only screen and (max-width: 991px) {
            .course-item-title {
                font-size: 20px
            }
        }

        @media only screen and (min-width: 992px) and (max-width: 1279px) {
            .course-item-title {
                margin-bottom: 18px
            }
        }

        .course-item-title:hover {
            color: var(--system_primery_color)
        }

        .course-item-price > span {
            display: flex;
            align-items: center
        }

        .course-item-price del {
            font-size: 20px;
            line-height: 1.5;
            font-weight: 500
        }

        @media only screen and (min-width: 992px) and (max-width: 1279px) {
            .course-item-price del {
                font-size: 18px
            }
        }

        @media only screen and (max-width: 991px) {
            .course-item-price del {
                font-size: 18px
            }
        }

        .course-item-price strong {
            font-size: 32px;
            line-height: 1.25;
            font-family: var(--fontFamily2);
            color: #596688
        }

        @media only screen and (min-width: 992px) and (max-width: 1279px) {
            .course-item-price strong {
                font-size: 28px
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .course-item-price strong {
                font-size: 26px
            }
        }

        @media only screen and (max-width: 767px) {
            .course-item-price strong {
                font-size: 24px
            }
        }

    </style>
    <div class="course">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-subtitle">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h3 class="mb-0 text-white">
                                    {{@$homeContent->course_title}}
                                </h3>
                            </div>
                            <div class="section-subtitle-action">
                                <a href="{{route('courses')}}" class="theme-btn bg-white ms-2">All Course</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-type="component-nonExisting"
                 data-preview=""
                 data-table=""
                 data-select="id,type,slug,title,thumbnail,price,discount_price,mode_of_delivery,duration,total_enrolled,user_id,category_id,level,total_rating"
                 data-order="id"
                 data-limit="6"
                 data-where-status="1"
                 data-where-type="1"
                 data-view="_single_course_v2"
                 data-model="Modules\CourseSetting\Entities\Course"
                 data-with="courseLevel,user,category"
            >
                <div class="dynamicData"
                     data-dynamic-href="{{routeIsExist('getDynamicData')?route('getDynamicData'):''}}"></div>
            </div>
        </div>
    </div>

</div>
