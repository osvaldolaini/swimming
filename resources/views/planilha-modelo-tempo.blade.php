<table>
    <thead>
        <tr>
            <th colspan="{{ ($modality == 'medley'?9:6) }}" style="text-align: center;">{{ $title }}</th>
        </tr>
    <tr>
        <th>ID atleta</th>
        <th>Atleta</th>
        <th>Apelido</th>
        <th>Categoria</th>
        <th>Dia (dd/mm/aaaa)</th>
        @if ($modality == 'medley')
            <th>Craw (00:00,00)</th>
            <th>Borbo (00:00,00)</th>
            <th>Costa (00:00,00)</th>
            <th>Peito (00:00,00)</th>
        @else
            <th>Nado (00:00,00)</th>
        @endif
    </tr>
    </thead>
    <tbody>
        @foreach($athletes as $athlete)
            <tr>
                <td>{{ $athlete->id }}</td>
                <td>{{ mb_strtoupper($athlete->name) }}</td>
                <td>{{ mb_strtoupper($athlete->nick) }}</td>
                <td>{{ mb_strtoupper(getCategory($athlete->birth)->name) }}</td>
                <td></td>
                <td></td>
                @if ($modality == 'medley')
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
