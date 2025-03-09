<div>
    @if ( session()->has('msg') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                {{ session('msg') }}
            </strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>

