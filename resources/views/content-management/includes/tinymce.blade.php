@push('scripts')
<script type="text/javascript">

    tinymce.init({
        selector: '#main-content',
        height: 500,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'template paste textcolor colorpicker textpattern imagetools toc help spellchecker'
        ],
        // menu: {
        //     file: {title: 'File', items: 'print'},
        //     edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
        //     insert: {title: 'Insert', items: 'link media | template hr'},
        //     view: {title: 'View', items: 'visualaid'},
        //     format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
        //     table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
        //     tools: {title: 'Tools', items: 'spellchecker code'}
        // },
        toolbar1: 'undo redo | insert | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print preview fullscreen | spellchecker help',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        // File upload portion
        automatic_uploads: true,
        file_picker_types: 'image', 
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            // Note: In modern browsers input[type="file"] is functional without 
            // even adding it to the DOM, but that might not be the case in some older
            // or quirky browsers like IE, so you might want to add it to the DOM
            // just in case, and visually hide it. And do not forget do remove it
            // once you do not need it anymore.

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    // Note: Now we need to register the blob in TinyMCEs image blob
                    // registry. In the next release this part hopefully won't be
                    // necessary, as we are looking to handle it internally.
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file, reader.result);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    // cb(blobInfo.blobUri(), { title: file.name });
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };

            input.click();
        },
        relative_urls : false,
        remove_script_host : false,
        convert_urls : false,
        images_upload_handler: function (blobInfo, success, failure) {

            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());
            formData.append('_token', '{{ csrf_token() }}');

            axios.post('{{ route('utilities.upload_image') }}', formData)
            .then(function (response) {
                console.log(response.data);
                success(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        spellchecker_callback: function(method, text, success, failure) {
            formData = new FormData();
            formData.append( 'words', text.match(this.getWordCharPattern()) );
            formData.append( '_token', '{{ csrf_token() }}' );

            axios.post('{{ route('utilities.spell_check') }}', formData)
            .then(function (response) {
                console.log(response.data);
                success(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });

            if (method == "spellcheck") {
                var suggestions = {};
                for (var i = 0; i < words.length; i++) {
                    suggestions[words[i]] = ["First", "Second"];
                }
                success(suggestions);
            }
        }
    });

</script>
@endpush