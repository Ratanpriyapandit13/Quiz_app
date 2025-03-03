
{{-- Success is as dangerous as failure. --}}
<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5  ">
        <div class="card border border-light-subtle rounded-4 d-flex justify-content-center mt-5">
            <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-12">
                        @if(Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif

                        @if(Session::has('error'))
                            <div class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        <div class="mb-5">
                            <h4 class="text-center">Login Form</h4>
                        </div>
                    </div>
                </div>
                <form wire:submit="login">

                    <div class="row gy-3 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text"wire:model="email" class="form-control  @error('email') is-invalid @enderror " name="email" id="email" placeholder="name@example.com" required>
                                <label for="email" class="form-label">Email</label>
                                @error('email')
                                    <p class="invaild-feekback">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password" required>
                                <label for="password" class="form-label">Password</label>
                                @error('password')
                                    <p class="invaild-feekback">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

