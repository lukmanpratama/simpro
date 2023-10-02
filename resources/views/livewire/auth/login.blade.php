<div>
    <div class="card">
        <div class="card-body ">
            <h5 class="card-title">Login</h5>
            <form wire:submit="login">
                <div class="mb-4">
                    <label for="email" class="frm-label">Email</label>
                    <input class="form-control" wire:model="email" type="email" name="email" id="email">
                    @error('email')
                        <small class="d-block mt-1 danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="frm-label">Password</label>
                    <div class="input-group mb-3">
                        <input wire:model="password" type="password" name="password" id="password" class="form-control"
                            placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-eye-slash"
                                id="togglePassword"></i></span>
                    </div>
                    @error('password')
                        <small class="d-block mt-1 danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="col text-end">
                        <a href="/register" wire:navigate>Don't have acount?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
