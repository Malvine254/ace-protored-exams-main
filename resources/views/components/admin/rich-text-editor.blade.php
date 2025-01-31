<div class="w-full h-[300px]" wire:ignore>
    <div x-data x-ref="quillEditor" x-init="quill = new Quill($refs.quillEditor, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    'header': [1, 2, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['clean']
            ]
        }
    });
    quill.on('text-change', function() {
        $dispatch('quill-input', quill.root.innerHTML);
    });"
        x-on:quill-input.debounce.500ms="$wire.set('form.description', $event.detail)">
        {!! $form->description !!}
    </div>
</div>
