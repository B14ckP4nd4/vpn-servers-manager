<x-guest-layout>
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="."><img src="{{asset('images/logo.svg')}}" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="{{ route('2fa') }}" method="POST" autocomplete="off">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">One Time Password</h2>
                @if ($errors->any())
                    <div>
                        <div class="font-medium text-red">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li class="invalid-feedback">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-2">
                    <label class="form-label" for="one_time_password">
                        One Time Password
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="one_time_password" name="one_time_password" id="one_time_password" class="form-control"  placeholder="Password"  autocomplete="off">
                        <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
