<div class="row">
    <div class="col-md-6">
        <div class="text-secondary">
            Showing <b class="text-body">{{ $items->firstItem() }}</b> to <b
                class="text-body">{{ $items->lastItem() }}</b> out of <b
                class="text-body">{{ $items->total() }}</b> items
        </div>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        {{ $items->links() }}
    </div>
</div>
