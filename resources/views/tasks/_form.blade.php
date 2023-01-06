<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlSelect1">@lang('Admin name')</label>
        <select name="assigned_by_id" class="form-control" id="exampleFormControlSelect1">
            @foreach ($admins as $admin)
                <option @selected(auth()->id() == $admin->id) value="{{ $admin->id }}">{{ $admin->name }}</option>
            @endforeach
        </select>

        @error('assigned_by_id')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput1">@lang('Title')</label>
        <input type="text" class="form-control" name="title" placeholder="Title">
        @error('title')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">@lang('Description')</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        @error('description')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect2">@lang('Assigned To name')</label>
        <select name="assigned_to_id" class="form-control" id="exampleFormControlSelect1">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('assigned_to_id')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group my-2">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
