@props(['user', 'roles'])

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            width: '100%',
            placeholder: "Select Role",
            allowClear: true,
        });
    });

    function hideRoleForm() {
        document.getElementById("roleForm").style.display = "none";
    }
</script>

@if (AuthHelper::canEditRole($user))
    <form action="{{ route('user.updateRole', $user) }}" method="post" class="p-4 border-2 mb-4 hidden border-gray-200"
        id="roleForm">
        @method('PATCH')
        @csrf
        <p class="text-lg font-semibold mb-4">Edit Role</p>
        <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>
        <div class="mb-4">
            <select class="js-example-basic-single" required="true" name="role">
                @foreach ($roles as $roles)
                    <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-row-reverse">
            <button type="submit"
                class="bg-indigo-500 text-white px-4 py-1 ml-2 rounded-xl text-center items-center transition duration-500 ease-in-out hover:bg-indigo-600">
                Save
            </button>
            <button type="button" onclick="hideRoleForm()"
                class="text-indigo-500 font-bold text-base  border border-indigo-700 rounded-xl px-4 py-1 text-center">
                Cancel
            </button>
        </div>
    </form>
@endif
