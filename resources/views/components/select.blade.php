<div class="m-4">
    <select class="form-control w-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" name="{{ $name }}">
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>
</div>
