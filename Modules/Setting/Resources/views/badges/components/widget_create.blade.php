<div class="modal fade admin-query" id="CreateModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('setting.Add New Badge')}}</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
            </div>
            <form method="POST" action="{{route('gamification.badges.store')}}" enctype="multipart/form-data">

                @csrf
                <div class="modal-body">

                    <div class="row">

                        <input type="hidden" name="type" id="type"
                               value="{{Session::has('type') ? Session::get('type') : $typeTab}}">


                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label"
                                       for="nameInput">{{ __('common.Title') }}
                                    <strong
                                        class="text-danger">*</strong></label>
                                <input name="title"
                                       id="nameInput"
                                       required
                                       class="primary_input_field name  "
                                       placeholder="{{ __('common.Title') }}"
                                       type="text"
                                       value="{{old('title')}}">
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label"
                                       for="nameInput">{{ __('common.Condition') }}
                                    <strong
                                        class="text-danger">*</strong></label>
                                <input name="point"
                                       id="nameInput"
                                       required
                                       class="primary_input_field name  "
                                       placeholder="{{ __('common.Condition') }}"
                                       type="number"
                                       value="{{old('point')}}">
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="  mb-15">
                                <x-upload-file
                                    name="image"
                                    type="image"
                                    {{--                                    media_id="{{isset($edit)?$edit->image_media?->media_id:''}}"--}}
                                    label="{{ __('common.Image') }}"
                                    note="{{__('student.Recommended size')}} (200x200)"
                                />

                            </div>
                        </div>


                        <div class="col-lg-12 mt-30">
                            <div class=" d-flex justify-content-center">
                                <button type="button" class="primary-btn tr-bg mr-10"
                                        data-dismiss="modal">{{__('common.Cancel')}}</button>
                                <button type="submit" class="primary-btn fix-gr-bg tooltip-wrapper "
                                        data-original-title="" title="">
                                    <i class="ti-check"></i>
                                    {{__('common.Save')}} </button>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
