<div style="min-height: 100vh; width: 100vw; display: flex; align-items: center; justify-content: center; background-color: #eef4fc; position: absolute; top: 0; left: 0; padding: 15px; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    
    <!-- CARD BRANCO CENTRALIZADO -->
    <div style="background-color: #ffffff; border-radius: 24px; max-width: 400px; width: 100%; padding: 40px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04); box-sizing: border-box;">
        
        <!-- Formulário do Livewire -->
        <form wire:submit.prevent="autenticar" style="margin: 0; padding: 0;">
            @csrf

            <!-- Alerta visual de erro caso erre a senha -->
            @if (session()->has('error'))
                <div style="background-color: #f8d7da; color: #842029; padding: 12px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 20px; border: 1px solid #f5c2c7;">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <!-- Campo 1: Nome de Usuário -->
            <div style="margin-bottom: 24px; text-align: left;">
                <label for="usernameInput" style="display: block; font-size: 1.15rem; font-weight: 500; color: #1a1a1a; margin-bottom: 8px;">
                    Nome de usuário
                </label>
                <input type="text" 
                       wire:model="username" 
                       id="usernameInput" 
                       style="width: 100%; padding: 12px 16px; border: 1px solid #dee2e6; border-radius: 8px; font-size: 1rem; color: #212529; background-color: #ffffff; box-sizing: border-box; outline: none;" 
                       required>
            </div>

            <!-- Campo 2: E-mail (Adicionado aqui antes da senha) -->
            <div style="margin-bottom: 24px; text-align: left;">
                <label for="emailInput" style="display: block; font-size: 1.15rem; font-weight: 500; color: #1a1a1a; margin-bottom: 8px;">
                    E-mail
                </label>
                <input type="email" 
                       wire:model="email" 
                       id="emailInput" 
                       style="width: 100%; padding: 12px 16px; border: 1px solid #dee2e6; border-radius: 8px; font-size: 1rem; color: #212529; background-color: #ffffff; box-sizing: border-box; outline: none;" 
                       required>
            </div>
            
            <!-- Campo 3: Senha -->
            <div style="margin-bottom: 15px; text-align: left;">
                <label for="passwordInput" style="display: block; font-size: 1.15rem; font-weight: 500; color: #1a1a1a; margin-bottom: 8px;">
                    Senha
                </label>
                <input type="password" 
                       wire:model="password" 
                       id="passwordInput" 
                       style="width: 100%; padding: 12px 16px; border: 1px solid #dee2e6; border-radius: 8px; font-size: 1rem; color: #212529; background-color: #ffffff; box-sizing: border-box; outline: none;" 
                       required>
            </div>

            <!-- Link: Esqueceu a senha? -->
            <div style="text-align: left; margin-bottom: 30px;">
                <a href="#" style="color: #0091ff; text-decoration: none; font-size: 0.95rem; font-weight: 500;">
                    Esqueceu a senha?
                </a>
            </div>

            <!-- Botão Azul de Entrar -->
            <button type="submit" 
                    style="width: 100%; background-color: #0091ff; color: #ffffff; border: none; border-radius: 12px; padding: 14px; font-size: 1.1rem; font-weight: 500; cursor: pointer; transition: background-color 0.2s; box-sizing: border-box; display: block; text-align: center;">
                Entrar
            </button>
            
            <!-- Link inferior: Cadastre-se -->
            <div style="text-align: center; margin-top: 25px;">
                <a href="#" style="color: #0091ff; text-decoration: none; font-size: 0.95rem; font-weight: 500;">
                    Cadastre-se
                </a>
            </div>

        </form>
    </div>
</div>
