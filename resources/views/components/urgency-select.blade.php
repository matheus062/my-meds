<select name="urgencia" id="urgencia" class="ml-2 border rounded py-1 px-2">
    <option value="">Selecione a Urgência</option>
    <option value="alta" {{ request()->input('prioridade') == 'alta' ? 'selected' : '' }}>Alta</option>
    <option value="media" {{ request()->input('prioridade') == 'media' ? 'selected' : '' }}>Média</option>
    <option value="baixa" {{ request()->input('prioridade') == 'baixa' ? 'selected' : '' }}>Baixa</option>
</select>
