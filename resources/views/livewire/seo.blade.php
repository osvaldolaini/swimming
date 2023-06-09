<div>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- @if (isset($tags))
        <meta name="keywords" content="{{$tags}}">
    @else
        <meta name="keywords" content="{{$config->meta_tags}}">
    @endif --}}
    <meta name="keywords" content="natação, atletas, equipes, gestão, montagem de equipe, medley">
    <!--SMO FACEBOOK-->
        <!--IDIOMA-->
        <meta property="og:locale" content="pt_BR">
        <!--URL DO SITE-->
        <meta property="og:url" content="{{url('')}}">
        <!--TITULO-->
        <meta property="og:title" content="{{$config->title}}">
        <meta property="og:site_name" content="{{$config->title}}">
        <!--DESCRIÇÃO NÃO MAIOR QUE 200-->
        <meta property="og:description" content="{{$config->meta_description}}">
        <!--TAG NÃO MAIOR QUE 80-->
        @if (isset($tags))
            <meta property="og:keywords" content="{{$tags}}">
        @else
            <meta property="og:keywords" content="{{$config->meta_tags}}">
        @endif

        <!--IMAGEM-->
        <meta property="og:image" content="{{url('logos/swimming.png')}}">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="800"> <!-- PIXELS -->
        <meta property="og:image:height" content="600"> <!-- PIXELS -->
        <!--TIPO DO SITE OU DA PÁGINA-->
        @if(isset($dataPage))
            <!-- CASO SEJA UM ARTIGO -->
            <meta property="og:type" content="{{$dataPage->title}}">
            <meta property="article:author" content="{{$dataPage->autor}}">
            <meta property="article:section" content="{{$dataPage->category}}">
            <meta property="article:tag" content="{{$dataPage->tags}}">
            <meta property="article:published_time" content="{{$dataPage->published_at}}">
            <meta name="description" content="{{$dataPage->meta_description}}">
        @else
            <!-- CASO SEJA UM SITE NORMAL -->
            <meta property="og:type" content="website">
            <meta name="description" content="{{$config->meta_description}}">
        @endif
    <!--SMO TWITTER-->
        <!--TIPO DO SITE OU DA PÁGINA
        photo (para imagens), player (para vídeos) e Summary (para todo o resto).-->
        <meta name="twitter:card " content="summary">
        <!--URLs DA PAGINA-->
        <meta name="twitter:domain" content="{{url('')}}">

        @if(isset($dataPage))
            <!--TITULO-->
            <meta name="twitter:title" content="{{$dataPage->title}}">
            <!--DESCRIÇÃO NÃO MAIOR QUE 200-->
            <meta name="twitter:description" content="{{$dataPage->title}}">
            <!--IMAGEM menores que 1 MB de tamanho de arquivo, > 60px por 60px e < 120px por 120px serão automaticamente redimensionadas.-->
            <meta name="twitter:image" content="{{url('storage/images/courses/'.$dataPage->id.'/list.jpg')}}">
            <meta name="twitter:url" content="{{url($urlPage)}}">
        @else
            <!--TITULO-->
            <meta name="twitter:title" content="{{$config->title}}" >
            <!--DESCRIÇÃO NÃO MAIOR QUE 200-->
            <meta name="twitter:description" content="{{$config->meta_description}}">
            <!--IMAGEM menores que 1 MB de tamanho de arquivo, > 60px por 60px e < 120px por 120px serão automaticamente redimensionadas.-->
            <meta name="twitter:image" content="{{url('logos/swimming.png')}}">

            <meta name="twitter:url" content="{{url('')}}">
        @endif
</div>
