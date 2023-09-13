<table>
    <thead>
        {{-- <tr>
            <th colspan="{{ ($modality == 'medley'?9:6) }}" style="text-align: center;">{{ $title }}</th>
        </tr> --}}
    <tr>
        <th>ID atleta</th>
        <th>Atleta</th>
        <th>Apelido</th>
        {{-- <th>Categoria</th> --}}
        <th>Dia (dd/mm/aaaa)</th>
        @if ($modality == 'medley')
            <th>Crawl (00:00,00)</th>
            <th>Borbo (00:00,00)</th>
            <th>Costa (00:00,00)</th>
            <th>Peito (00:00,00)</th>
        @else
            <th>{{ $title }} (00:00,00)</th>
        @endif
    </tr>
    </thead>
    <tbody>
        @foreach($athletes as $athlete)
            <tr>
                <td>{{ $athlete->id }}</td>
                <td>{{ mb_strtoupper($athlete->name) }}</td>
                <td>{{ mb_strtoupper($athlete->nick) }}</td>
                {{-- <td>{{ mb_strtoupper(getCategory($athlete->birth)->name) }}</td> --}}
                <td>{{ date('d/m/Y') }}</td>
                @if ($modality == 'medley')
                    <td>00:00,00</td>
                    <td>00:00,00</td>
                    <td>00:00,00</td>
                    <td>00:00,00</td>
                @else
                    <td>00:00,00</td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td>*</td>
            @if ($modality == 'medley')
            <td colspan="8">Não inclua NENHUM atleta diretamente na planilha.</td>
            @else
            <td colspan="5">Não inclua NENHUM atleta diretamente na planilha.</td>
            @endif
        </tr>
        <tr>
            <td>**</td>
            @if ($modality == 'medley')
            <td colspan="8">Não inclua NENHUMA coluna a mais na planilha.</td>
            @else
            <td colspan="5">Não inclua NENHUMA coluna a mais na planilha.</td>
            @endif
        </tr>
        <tr>
            <td>***</td>
            @if ($modality == 'medley')
            <td colspan="8">O tempo deve ser lançado no formato 00:00,00 conforme indicado.</td>
            @else
            <td colspan="5">O tempo deve ser lançado no formato 00:00,00 conforme indicado.</td>
            @endif
        </tr>
        <tr>
            <td>****</td>
            @if ($modality == 'medley')
            <td colspan="8">A data pode ser alterada, mas deve ser lançado no formato dd/mm/aaaa conforme indicado.</td>
            @else
            <td colspan="5">A data pode ser alterada, mas deve ser lançado no formato dd/mm/aaaa conforme indicado.</td>
            @endif
        </tr>
    </tbody>
</table>
