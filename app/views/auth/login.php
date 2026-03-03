<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriTech - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            overflow-x: hidden;
        }

        .background-decoration {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .circle-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            bottom: -050px;
            left: -50px;
            animation: float 6s ease-in-out infinite reverse;
        }

        .circle-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(10deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.1;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.2);
                opacity: 0.2;
            }
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            z-index: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 0.6s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .logo-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        .logo-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-tabs {
            display: flex;
            position: relative;
            background: #f3f4f6;
            padding: 6px;
            margin: 1rem 1.5rem 0;
            border-radius: 12px;
        }

        .auth-tab {
            flex: 1;
            padding: 0.75rem;
            background: none;
            border: none;
            font-size: 0.875rem;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            position: relative;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .auth-tab.active {
            color: #22c55e;
        }

        .tab-indicator {
            position: absolute;
            top: 6px;
            left: 6px;
            width: calc(50% - 6px);
            height: calc(100% - 12px);
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .auth-form {
            display: none;
            padding: 1.5rem;
            animation: fadeIn 0.3s ease;
        }

        .auth-form.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .form-header p {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            width: 1.25rem;
            height: 1.25rem;
            color: #9ca3af;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.875rem 3rem 0.875rem 2.75rem;
            background: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #22c55e;
            background: white;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
        }

        .input-wrapper input::placeholder {
            color: #9ca3af;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover {
            color: #6b7280;
        }

        .toggle-password svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .toggle-password .hidden {
            display: none;
        }

        .password-strength {
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .strength-bar {
            flex: 1;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .strength-fill.weak {
            width: 33%;
            background: #ef4444;
        }

        .strength-fill.medium {
            width: 66%;
            background: #f59e0b;
        }

        .strength-fill.strong {
            width: 100%;
            background: #22c55e;
        }

        .strength-text {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .remember-me,
        .terms-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
            cursor: pointer;
        }

        .remember-me input,
        .terms-checkbox input {
            display: none;
        }

        .checkmark {
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            position: relative;
            transition: all 0.3s ease;
        }

        .remember-me input:checked+.checkmark,
        .terms-checkbox input:checked+.checkmark {
            background: #22c55e;
            border-color: #22c55e;
        }

        .checkmark::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 5px;
            width: 4px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .remember-me input:checked+.checkmark::after,
        .terms-checkbox input:checked+.checkmark::after {
            opacity: 1;
        }

        .forgot-password {
            color: #22c55e;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .terms-checkbox {
            margin-bottom: 1.5rem;
        }

        .terms-checkbox a {
            color: #22c55e;
            text-decoration: none;
        }

        .terms-checkbox a:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(34, 197, 94, 0.4);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.5);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-loader {
            display: flex;
        }

        .btn-loader.hidden {
            display: none;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 1rem;
            color: #9ca3af;
            font-size: 0.75rem;
        }

        .social-buttons {
            display: flex;
            gap: 1rem;
        }

        .social-btn {
            flex: 1;
            padding: 0.75rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            border-color: #22c55e;
            background: #f0fdf4;
        }

        .demo-credentials {
            margin-top: 1.5rem;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            text-align: center;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .demo-credentials p {
            color: white;
            font-size: 0.875rem;
            margin: 0;
        }

        .demo-credentials code {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.125rem 0.5rem;
            border-radius: 4px;
            font-family: monospace;
        }

        .toast {
            position: fixed;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 1000;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toast.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .toast-icon {
            font-size: 1.5rem;
        }

        .toast.success .toast-icon::before {
            content: '✅';
        }

        .toast.error .toast-icon::before {
            content: '❌';
        }

        .toast.warning .toast-icon::before {
            content: '⚠️';
        }

        .toast.info .toast-icon::before {
            content: 'ℹ️';
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            z-index: 100;
        }

        .modal-overlay.hidden {
            display: none;
        }

        .modal-content {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
            animation: modalIn 0.3s ease;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2rem;
            height: 2rem;
            background: #f3f4f6;
            border: none;
            border-radius: 50%;
            color: #6b7280;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .modal-content h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .modal-content>p {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        .modal-content .form-group {
            text-align: left;
        }

        .shake {
            animation: shake 0.5s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-10px);
            }

            40%,
            80% {
                transform: translateX(10px);
            }
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        @media (max-width: 480px) {
            .auth-card {
                border-radius: 20px;
            }

            .logo-title {
                font-size: 1.75rem;
            }

            .social-buttons {
                flex-direction: column;
            }
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22c55e',
                        secondary: '#16a34a',
                        accent: '#86efac'
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-primary to-secondary">
    <!-- Background Decoration -->
    <div class="background-decoration">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
    </div>

    <div class="auth-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo-icon">
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                </svg>
            </div>
            <h1 class="logo-title">NutriTech</h1>
            <p class="logo-subtitle">Seu assistente nutricional inteligente</p>
        </div>

        <!-- Auth Card -->
        <div class="auth-card">
            <!-- Tabs -->
            <div class="auth-tabs">
                <button class="auth-tab active" data-tab="login" onclick="switchTab('login')">
                    Entrar
                </button>
                <button class="auth-tab" data-tab="register" onclick="switchTab('register')">
                    Criar Conta
                </button>
                <div class="tab-indicator" id="tab-indicator"></div>
            </div>

            <!-- Login Form -->
            <form id="login-form" class="auth-form active" method="post" action="login">
                <div class="form-header">
                    <h2>Bem-vindo de volta! 👋</h2>
                    <p>Entre com suas credenciais para continuar</p>
                </div>

                <div class="form-group">
                    <label for="login-email">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input type="email" id="login-email" name="email" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login-password">Senha</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" id="login-password" name="password" placeholder="••••••••" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('login-password')">
                            <svg class="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg class="eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" id="remember-me">
                        <span class="checkmark"></span>
                        Lembrar de mim
                    </label>
                    <a href="#" class="forgot-password" onclick="showForgotPassword(event)">Esqueceu a senha?</a>
                </div>

                <button type="submit" class="submit-btn" id="login-btn">
                    <span class="btn-text">Entrar</span>
                    <span class="btn-loader hidden">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>

                <div class="divider">
                    <span>ou continue com</span>
                </div>

                <div class="social-buttons">
                    <button type="button" class="social-btn" onclick="socialLogin('google')">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                        </svg>
                        Google
                    </button>
                    <button type="button" class="social-btn" onclick="socialLogin('apple')">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                        </svg>
                        Apple
                    </button>
                </div>
            </form>

            <!-- Register Form -->
            <form id="register-form" class="auth-form" action="register" method="post">
                <div class="form-header">
                    <h2>Crie sua conta 🚀</h2>
                    <p>Comece sua jornada para uma vida mais saudável</p>
                </div>

                <div class="form-group">
                    <label for="register-name">Nome completo</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input type="text" id="register-name" name="name" placeholder="João Silva" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-email">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input type="email" id="register-email" name="email" placeholder="seu@email.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-password">Senha</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" id="register-password" name="password" placeholder="Mínimo 4 caracteres" required minlength="4">
                        <button type="button" class="toggle-password" onclick="togglePassword('register-password')">
                            <svg class="eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg class="eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <div class="password-strength" id="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strength-fill"></div>
                        </div>
                        <span class="strength-text" id="strength-text"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-confirm">Confirmar senha</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <input type="password" id="register-confirm" name="confirm" placeholder="Repita a senha" required>
                    </div>
                </div>

                <label class="terms-checkbox">
                    <input type="checkbox" id="terms" required>
                    <span class="checkmark"></span>
                    Concordo com os <a href="#">Termos de Uso</a> e <a href="#">Política de Privacidade</a>
                </label>

                <button type="submit" class="submit-btn" id="register-btn">
                    <span class="btn-text">Criar Conta</span>
                    <span class="btn-loader hidden">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>


    <!-- Forgot Password Modal -->
    <div id="forgot-modal" class="modal-overlay hidden">
        <div class="modal-content">
            <button class="modal-close" onclick="closeForgotPassword()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="modal-icon">📧</div>
            <h3>Esqueceu sua senha?</h3>
            <p>Digite seu email e enviaremos instruções para recuperar sua senha.</p>
            <form action="">
                <div class="form-group">
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input type="email" id="forgot-email" placeholder="seu@email.com" required>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Enviar Instruções</button>
            </form>
        </div>
    </div>
</body>

</html>
<script>
    // Logica de troca de abas, toggle de senha, força da senha e modal de esqueci minha senha
    function switchTab(tab) {
        const forms = document.querySelectorAll('.auth-form');
        const tabs = document.querySelectorAll('.auth-tab');
        const indicator = document.getElementById('tab-indicator');

        forms.forEach(form => form.classList.remove('active'));
        tabs.forEach(t => t.classList.remove('active'));

        document.getElementById(tab + '-form').classList.add('active');
        document.querySelector(`[data-tab="${tab}"]`).classList.add('active');

        const activeTab = document.querySelector(`[data-tab="${tab}"]`);
        if (tab === 'register') {
            indicator.style.transform = 'translateX(100%)';
        } else {
            indicator.style.transform = 'translateX(0)';
        }
    }

    // Logica para mostrar/ocultar senha
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const wrapper = input.parentElement;
        const eyeOpen = wrapper.querySelector('.eye-open');
        const eyeClosed = wrapper.querySelector('.eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }

    // Logica para mostrar o modal de esqueci minha senha
    function showForgotPassword(event) {
        event.preventDefault();
        document.getElementById('forgot-modal').classList.remove('hidden');
    }

    //
    function closeForgotPassword() {
        document.getElementById('forgot-modal').classList.add('hidden');
    }

    document.getElementById('register-password')?.addEventListener('input', (e) => {
        const password = e.target.value;
        const strengthFill = document.getElementById('strength-fill');
        const strengthText = document.getElementById('strength-text');

        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;

        strengthFill.className = 'strength-fill';
        if (strength <= 1) {
            strengthFill.classList.add('weak');
            strengthText.textContent = 'Fraca';
        } else if (strength <= 2) {
            strengthFill.classList.add('medium');
            strengthText.textContent = 'Média';
        } else {
            strengthFill.classList.add('strong');
            strengthText.textContent = 'Forte';
        }
    });

    window.addEventListener('load', () => {
        const indicator = document.getElementById('tab-indicator');
        indicator.style.transform = 'translateX(0)';
    });
</script>