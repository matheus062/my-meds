<div {{ $attributes->merge(['class' => 'flex items-center pb-3 mt-4 px-11 max-w-7xl mx-auto']) }}">
    <span class="mr-2">Ordenar por:</span>
    <a href="{{ route($link . '.index', array_merge(request()->query(), ['sort_by' => 'identifier', 'sort_order' => 'asc'])) }}" class="text-blue-500 hover:underline mx-1">Numero</a> |
    <a href="{{ route($link . '.index', array_merge(request()->query(), ['sort_by' => 'title', 'sort_order' => 'asc'])) }}" class="text-blue-500 hover:underline mx-1">Título</a> |
    <a href="{{ route($link . '.index', array_merge(request()->query(), ['sort_by' => 'priority_id', 'sort_order' => 'asc'])) }}" class="text-blue-500 hover:underline mx-1">Prioridade</a> |
    <a href="{{ route($link . '.index', array_merge(request()->query(), ['sort_by' => 'user_id', 'sort_order' => 'asc'])) }}" class="text-blue-500 hover:underline mx-1">Usuário</a>
</div>
