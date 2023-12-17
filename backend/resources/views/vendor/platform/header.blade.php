@push('head')
    <meta name="robots" content="noindex"/>
    <meta name="google" content="notranslate">
    <link
          href="{{ asset('/favicon.ico') }}"
          id="favicon"
          rel="icon"
    >

    <!-- For Safari on iOS -->
    <meta name="theme-color" content="#21252a">
@endpush

<div class="h2 d-flex h2 d-flex justify-content-center text-center">
    @guest
        <div class="m-auto text-center">
            <img
                class='m-auto'
                src={{asset('images/logo.png')}}
                width='20%'
            />
        </div>
    @else
        <div class="m-t-md v-center">
            <img
                class='m-auto'
                src={{asset('images/logo-white.svg')}}
            />
        </div>
    @endguest
</div>
