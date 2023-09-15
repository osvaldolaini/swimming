<div class="w-100">
    <x-header>REVEZAMENTOS</x-header>
    {{-- @livewire('admin.filters.institution.institution-table') --}}
    <div class="bg-white shadow-md dark:bg-gray-800 pt-3 sm:rounded-lg">
        <livewire:search-bar.search-bar
        {{-- REQUIRED --}}  model="App\Models\Model\Relays" {{-- Model principal --}}
        {{-- REQUIRED --}}  modelId="id" {{-- Ex: 'table.id' or 'id' --}}
        {{-- REQUIRED --}}  showId="false" {{-- 'true' or 'false' --}}
        {{-- REQUIRED --}}  columnsInclude="name,type,min_age,max_age" {{-- Colunas incluidas --}}
        {{-- REQUIRED --}}  columnsNames="Equipe,Tipo,Ano,Ano limite" {{-- Cabeçalho da tabela --}}
        {{-- REQUIRED --}}  searchable="name,min_age,max_age" {{-- Colunas pesquisadas no banco de dados --}}
        {{-- OK --}} customSearch="type" {{-- Colunas personalizadas, customizar no model --}}
        {{-- OK --}} activeButton="restrictRelay" {{-- Toogle de ativar e desativar registro --}}
        {{-- OK --}} relationTables="" {{-- Relacionamentos ( table , key , foreingKey ) --}}
        {{-- OK --}} showButtons="" {{-- Botões --}}
        {{-- OK --}} sort="min_age , asc" {{-- Ordenação da tabela --}}
        {{-- OK --}} paginate="10" {{-- Qtd de registros por página --}}
        />
    </div>

</div>

