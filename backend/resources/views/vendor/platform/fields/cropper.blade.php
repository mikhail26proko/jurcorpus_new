@component($typeForm, get_defined_vars())
    <div
        class='d-flex justify-content-center'
        data-controller="cropper"
         data-cropper-value="{{ $attributes['value'] }}"
         data-cropper-storage="{{ $storage ?? config('platform.attachment.disk', 'public') }}"
         data-cropper-width="{{ $width }}"
         data-cropper-height="{{ $height }}"
         data-cropper-min-width="{{ $minWidth }}"
         data-cropper-min-height="{{ $minHeight }}"
         data-cropper-max-width="{{ $maxWidth }}"
         data-cropper-max-height="{{ $maxHeight }}"
         data-cropper-target="{{ $target }}"
         data-cropper-url="{{ $url }}"
         data-cropper-accepted-files="{{ $acceptedFiles }}"
         data-cropper-max-file-size="{{ $maxFileSize }}"
         data-cropper-groups="{{ $attributes['groups'] }}"
         data-cropper-path="{{ $attributes['path'] ?? '' }}"
         data-cropper-keep-original-type-value="{{ false }}"
         data-cropper-max-size-message-value="{{ __('platform.messages.TooMuchMemory') }}"
    >
        <div class="border-dashed text-end cropper-actions" style="width:180px;height:240px;">

            <div class="fields-cropper-container position-relative overflow-hidden">
                <div
                    width="180px"
                    height="240px"
                    style="width:180px; height:240px; background:url('/storage/employees/JurCorpusDefault.png') 50% 50%; background-size:contain;"
                >
                    <img
                        src="#"
                        alt=""
                        class="cropper-preview img-fluid img-full border"
                        style="--cropper-width: {{ $width }}; --cropper-height: {{ $height }};"
                    >
                </div>

                <div class="btn-group position-absolute bottom-0 start-50 translate-middle bg-white opacity-50">
                    <label class="btn btn-outline m-0 opacity-100">
                        <x-orchid-icon path="bs.cloud-arrow-up" class="me-2 opacity-100"/>
                        <input type="file"
                               accept="image/*"
                               data-cropper-target="upload"
                               data-action="change->cropper#upload click->cropper#openModal"
                               class="d-none">
                    </label>

                    <button type="button" class="btn btn-outline cropper-remove opacity-100"
                        data-action="cropper#clear">
                            <x-orchid-icon path="bs.trash" class="me-2 opacity-100"/>
                    </button>
                </div>

            </div>

            <input type="file"
                   accept="{{ $acceptedFiles }}"
                   class="d-none">
        </div>

        <input class="cropper-path d-none"
               type="text"
               data-cropper-target="source"
            {{ $attributes }}
        >

        <div class="modal" role="dialog" {{$staticBackdrop ? "data-bs-backdrop=static" : ''}}>
            <div class="modal-dialog modal-fullscreen-md-down modal-lg">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="position-relative">
                            <img class="upload-panel">
                        </div>

                        <div class="modal-footer">

                            <button type="button"
                                    class="btn btn-link"
                                    data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>

                            <button type="button"
                                    class="btn btn-default"
                                    data-action="cropper#crop">
                                {{ __('Crop') }}
                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endcomponent
