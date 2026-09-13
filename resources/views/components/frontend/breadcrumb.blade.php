<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            @foreach ($items as $item)
                {{-- Vérification de dernier élément du bouclé
                si cet élément n'existe donc nous définissons
                un lien. --}}
                @if (!$loop->last)
                    <a href="{{ $item['url'] }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>{{ $item['label'] }}</a>
                @else
                    <span></span> {{ $item['label'] }}
                @endif
            @endforeach
        </div>
    </div>
</div>
