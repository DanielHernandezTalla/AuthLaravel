<style>
    #alert-content {
        transform: translateX(0%);
        animation-duration: 1s;
        animation-name: slidein;
    }

    @keyframes slidein {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0%);
        }
    }
</style>

@if (Session::has('success'))
    <div id="alert-content" class="position-fixed p-4 end-0 z-2">
        <div class="p-3 rounded-2" style="background: #dbeafe; color: #1e40af">
            <span class="fw-bold"><i class="h5 m-0 bi bi-check2-circle"></i></span>
            {{ Session::get('success') }}
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div id="alert-content" class="position-fixed p-4 end-0 z-2">
        <div class="p-3 rounded-2" style="background: #fee2e2; color: #991b1b">
            <span class="fw-bold"><i class="h-5 m-0 bi bi-x-circle"></i></span>
            {{ Session::get('error') }}
        </div>
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', e => {
        let alert = document.getElementById('alert-content');
        if (alert) {
            setTimeout(() => {
                alert.classList.add('d-none');
            }, 3000);
        }
    })
</script>
