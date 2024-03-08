<div class="bg-white d-flex px-4 py-3 rounded-3">
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="m-0 ">
            @yield('title')
        </h1>

        @isset($button)
            <a class="btn btn-success" href="{{ route($button['url']) }}">{{ $button['name'] }}</a>
        @endisset
    </div>
</div>
