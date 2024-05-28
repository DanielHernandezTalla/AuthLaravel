<div class="bg-white d-flex px-4 py-3 rounded-3">
    <div class="d-flex justify-content-between align-items-center w-100">
        <div>
            <div id="links-header" class="">
                <a href="/" class="m-0 text-secondary"><i class="bi bi-house-fill"></i></a>
            </div>
            <h1 class="m-0 ">
                @yield('title')
            </h1>
        </div>

        @isset($button)
            <a class="btn btn-success" href="{{ route($button['url']) }}">{{ $button['name'] }}</a>
        @endisset
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        let links = document.getElementById('links-header');
        let urls = window.location.pathname.split('/');
        urls.shift();

        let text = '';
        let url = '';
        urls.forEach(element => {
            text = ' / ' + element;
            url += '/' + element;
            links.innerHTML +=
                `<a href="${url}" class="m-0 text-secondary text-decoration-none">${text}</a>`;
        });

    })
</script>
