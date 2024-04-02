<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{__('setting.Edit Badge')}}</h4>
            <button type="button" class="close" data-dismiss="modal"><i class="ti-close "></i></button>
        </div>
        <form method="POST" action="{{route('gamification.badges.update')}}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="id" id="widgetEditId" value="{{$badge->id}}">

            <div class="modal-body">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"
                                   for="editTitle">{{ __('common.Title') }}
                                <strong
                                    class="text-danger">*</strong></label>
                            <input name="title"

                                   required
                                   class="primary_input_field name  "
                                   placeholder="{{ __('common.Title') }}"
                                   type="text"
                                   value="{{old('title',$badge->title)}}">
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"
                                   for="editPoint">{{ __('common.Condition') }}
                                <strong
                                    class="text-danger">*</strong></label>
                            <input name="point"
                                   id="editPoint"
                                   required
                                   class="primary_input_field name  "
                                   placeholder="{{ __('common.Condition') }}"
                                   type="number"
                                   value="{{old('point',$badge->point)}}">
                        </div>
                    </div>


                    <div class="col-lg-12">

                        <div class="  mb-15">
                            <x-upload-file
                                name="image"
                                type="image"
                                media_id="{{isset($badge)?$badge->image_media?->media_id:''}}"
                                label="{{ __('common.Image') }}"
                                note="{{__('student.Recommended size')}} (200x200)"
                            />

                        </div>
                    </div>

                </div>

                <div class="row">


                    <div class="col-lg-12 mt-30">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="primary-btn tr-bg mr-10"
                                    data-dismiss="modal">{{__('common.Cancel')}}</button>
                            <button type="submit" class="primary-btn fix-gr-bg tooltip-wrapper "
                                    data-original-title="" title="">
                                <i class="ti-check"></i>
                                {{__('common.Update')}} </button>

                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        Amaz.uploader.clearUploaderSelected();
        Amaz.uploader.initForInput();
        Amaz.uploader.removeAttachment();
        Amaz.uploader.sortImage();
        Amaz.uploader.previewGenerate();
    })
</script>
