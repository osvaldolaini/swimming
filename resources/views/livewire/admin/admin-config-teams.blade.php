<div class="w-100">

    <div class="bg-white dark:bg-gray-800 pt-3 sm:rounded-lg">
        <livewire:search-bar.search-bar
            {{-- REQUIRED --}}  model="App\Models\TeamsConfig" {{-- Model principal --}}
            {{-- REQUIRED --}}  modelId="id" {{-- Ex: 'table.id' or 'id' --}}
            {{-- REQUIRED --}}  showId="true" {{-- 'true' or 'false' --}}
            {{-- REQUIRED --}}  columnsInclude="name,nick" {{-- Colunas incluidas --}}
            {{-- REQUIRED --}}  columnsNames="Clube,Sigla" {{-- Cabeçalho da tabela --}}
            {{-- REQUIRED --}}  searchable="type_time" {{-- Colunas pesquisadas no banco de dados --}}
            {{-- OK --}} customSearch="" {{-- Colunas personalizadas, customizar no model --}}
            {{-- OK --}} activeButton="" {{-- Toogle de ativar e desativear registro --}}
            {{-- OK --}} relationTables="" {{-- Relacionamentos ( table , key , foreingKey ) --}}
            {{-- OK --}} showButtons="" {{-- Botões --}}
            {{-- OK --}} sort="name , desc " {{-- Ordenação da tabela --}}
            {{-- OK --}} paginate="15" {{-- Qtd de registros por página --}}
        />
    </div>

</div>
