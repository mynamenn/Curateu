@props(['tags', 'collection', 'collectionTags'])

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            width: '100%',
            placeholder: "Select Tags",
            allowClear: true,
        });

        var tags = {!! json_encode($collectionTags) !!};
        
        ids = [];
        for ( const tag of tags ) {
            ids.push(tag.id);
        }

        $('.js-example-basic-multiple').val(ids).trigger("change");
    });

    function closeTagForm() {
        document.getElementById("tagForm").style.display = "none";
    }
</script>

<form action="{{ route('collections.updateTags', $collection) }}" method="post" id="tagForm"
    class="p-4 border-2 mb-4 hidden border-gray-200">
    @csrf
    @method('POST')
    <p class="text-lg font-semibold mb-4">Edit Tags</p>
    <div class="mb-4">
        <select class="js-example-basic-multiple" name="selectedTags[]" multiple="multiple">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex flex-row-reverse">
        <button type="submit"
            class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
            Save
        </button>
        <button type="button" onclick="closeTagForm()"
            class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
            Cancel
        </button>
    </div>
</form>