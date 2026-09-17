<div>

    @if(session()->has('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent='login'>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" wire:model='email' id="email" aria-describedby="email">
    @error('email') 
    <span class="text-danger small"> {{ $message }}</span>
    @enderror
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Senha</label>
    <input type="password" class="form-control" wire:model='password' id="password">
    @error('password')
    <span class="text-danger small"> {{ $message }}</span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Entrar</button>
</form>
</div>