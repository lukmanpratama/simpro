<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Beranda</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="py-2">
                                <button wire:click="create" class="btn btn-primary">Create Proyek</button>
                                @if ($isOpen)
                                    <div class="modal show" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-bg-dark">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        {{$proyekId ? 'Edit Proyek' : 'Create Proyek' }}
                                                    </h5>
                                                    <svg wire:click="closeModal" xmlns="http://www.w3.org/2000/svg" width="32"
                                                        height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                        <path
                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                    </svg>
                                                </div>
                                                <div class="modal-body">

                                                    <form wire:submit.prevent="{{ $proyekId ? 'update' : 'store' }}">
                                                        <div class="form-group">
                                                            <label for="title">Nama Proyek</label>
                                                            <input type="text" wire:model="nama_proyek" class="form-control" id="nama_proyek" placeholder="Enter post title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="body">Deskripsi</label>
                                                            <textarea wire:model="deskripsi_proyek" class="form-control" id="deskripsi_proyek" rows="4" placeholder="Enter post body"></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-4">
                                                            {{ $proyekId ? 'Update' : 'Create' }}
                                                        </button>
                                                        <button type="button" wire:click="closeModal"
                                                            class="btn btn-secondary mt-4">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show"></div>
                                @endif
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <input type="search" wire:model.live.debounce.50ms="search" class="form-control" placeholder="Search..." id="search">
                                </div>
                                <div class="col-md-3">
                                    <select wire:model.live="limit" class="form-select" aria-label="Default select example">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name proyek</th>
                                        <th scope="col">Owner</th>
                                        <th scope="col">Manager</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyeks as $proyek)
                                        <tr scope="row" wire:key="{{ $proyek->id }}">
                                            <td>{{ $loop->index + $proyeks->firstItem() }}</td>
                                            <td>{{ $proyek->project_name }}</td>
                                            <td>
                                                @foreach ($proyek->users->where('role', '=', 'owner') as $user)
                                                <button class="btn btn-sm btn-primary me-2">{{ $user->name }}</button>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($proyek->users->where('role', '=', 'manager') as $user)
                                                <button class="btn btn-sm btn-primary me-2">{{ $user->name }}</button>
                                                @endforeach
                                            </td>
                                            <td>{{ $proyek->created_at->format('d F, Y') }}</td>
                                            <td>
                                                <span wire:click="edit({{ $proyek->id }})" class="cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil cursor-pointer" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                  </svg>
                                                </span>
                                                <span onclick="return confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()" wire:click="delete({{ $proyek->id }})" class="cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                      </svg>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <!-- /.card-body -->
                        <x-pagination :items="$proyeks" />
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
