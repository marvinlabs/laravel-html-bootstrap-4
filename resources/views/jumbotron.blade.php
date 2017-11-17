<div class="jumbotron @istrue($fullwidth, 'jumbotron-fluid') {{ $class or '' }}">
    @istrue($fullwidth)<div class="container">@endistrue
        @isset($heading)
            <h1 class="display-3">{{ $heading }}</h1>
        @endisset
        @isset($subheading)
            <p class="lead">{{ $subheading }}</p>
        @endisset

        {{ $slot }}

        @isset($actions)
            <p class="lead">{{ $actions }}</p>
        @endisset
    @istrue($fullwidth)</div>@endistrue
</div>