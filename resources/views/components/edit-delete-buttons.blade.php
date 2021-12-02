@props(['formId', 'deletePath', 'user'])

<script>
    function buttonClick(e) {
        e.stopPropagation();
    }

    function showForm(e, formId) {
        buttonClick(e);
        document.getElementById(formId).style.display = "block";
    }
</script>

@if (AuthHelper::canMakeEdits($user->id))
    <form action="{{ $deletePath }}" method="post">
        @csrf
        @method('DELETE')
        <div class="inline-flex flex-col" role="group">
            <button type="button" onclick="showForm(event, '{{ $formId }}')"
                class="rounded-lg border-2 mb-1 border-gray-200 bg-white text-sm font-medium px-4 py-2 text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                Edit
            </button>
            <button type="submit" onclick="buttonClick(event)"
                class="rounded-lg border-2 border-gray-200 bg-white text-sm font-medium px-4 py-2 text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                Delete
            </button>
        </div>
    </form>
@endif
