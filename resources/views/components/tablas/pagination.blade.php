@if ($data->withQueryString()->lastPage() != 1)
    <div class="section-min">
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
@endif
