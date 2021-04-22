<div>
    <x-select multiple="true" :option="Spatie\Permission\Models\Role::all()->pluck('name','name')" :value="$role" name="role" />
</div>
