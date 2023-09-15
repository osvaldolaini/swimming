<div class="w-100">
    <x-header>EQUIPES</x-header>
    {{-- @livewire('admin.filters.institution.institution-table') --}}
    <div class="bg-white shadow-md dark:bg-gray-800 pt-3 sm:rounded-lg">
        <livewire:search-bar.search-bar
            {{-- REQUIRED --}} model="App\Models\Model\Teams" {{-- Model principal --}}
            {{-- REQUIRED --}} modelId="id"  {{-- Ex: 'table.id' or 'id' --}}
            {{-- REQUIRED --}} showId="false" {{-- 'true' or 'false' --}}
            {{-- REQUIRED --}} columnsInclude="name,min_age,max_age" {{-- Colunas incluidas --}}
            {{-- REQUIRED --}} columnsNames="Equipe,Idade mínima,Idade Limite" {{-- Cabeçalho da tabela --}}
            {{-- REQUIRED --}} searchable="name,min_age,max_age" {{-- Colunas pesquisadas no banco de dados --}}
            {{-- OK --}} customSearch="" {{-- Colunas personalizadas, customizar no model --}}
            {{-- OK --}} activeButton="restrictTeam" {{-- Toogle de ativar e desativar registro --}}
            {{-- OK --}} relationTables="" {{-- Relacionamentos ( table , key , foreingKey ) --}}
            {{-- OK --}} showButtons="{{ (Auth::user()->group->type == 1 ? 'Ações' : '') }}" {{-- Botões --}}
            {{-- OK --}} sort="min_age , asc" {{-- Ordenação da tabela --}}
            {{-- OK --}} paginate="10" {{-- Qtd de registros por página --}} />
    </div>

</div>
