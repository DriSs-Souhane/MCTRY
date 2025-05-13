<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusAuth | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #00f0ff;
            --primary-dark: #0066ff;
            --secondary: #ff00e4;
            --dark: #0a0a14;
            --light: rgba(255, 255, 255, 0.9);
            --glass: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-highlight: rgba(255, 255, 255, 0.15);
        }
        
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(-45deg, #0a0a14, #1a1a2e, #16213e, #0f3460);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: var(--light);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        
        .auth-container {
            width: 100%;
            max-width: 600px; /*440*/
            padding: 2rem;
        }
        
        .auth-card {
            background: var(--glass);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            position: relative;
        }
        
        .auth-header {
            padding: 2.5rem 2rem 1.5rem;
            text-align: center;
            position: relative;
        }
        
        .auth-logo {
            font-size: 2.2rem;
            font-weight: 700;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
        }
        
        .auth-subtitle {
            opacity: 0.8;
            font-weight: 300;
            font-size: 0.95rem;
        }
        
        .auth-body {
            padding: 0 2rem 2.5rem;
        }
        
        .auth-tabs {
            display: flex;
            background: var(--glass-highlight);
            border-radius: 12px;
            padding: 6px;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 12px;
            font-weight: 500;
            cursor: pointer;
            z-index: 1;
            transition: color 0.3s ease;
            position: relative;
        }
        
        .auth-tab.active {
            color: var(--dark);
        }
        
        .tab-indicator {
            position: absolute;
            top: 6px;
            left: 6px;
            height: calc(100% - 12px);
            width: calc(50% - 12px);
            background: var(--light);
            border-radius: 8px;
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .auth-form {
            display: none;
        }
        
        .auth-form.active {
            display: block;
            animation: fadeIn 0.4s ease forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 500;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 18px 14px 48px;
            background: var(--glass-highlight);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            color: var(--light);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .form-control.with-icon-right {
            padding: 14px 48px 14px 18px;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(0, 240, 255, 0.2);
        }
        
        .form-control:focus + .input-icon {
            color: var(--primary);
            transform: scale(1.1);
        }
        
        .password-toggle {
            position: absolute;
            right: 16px;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .password-toggle:hover {
            color: var(--primary);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--primary-dark));
            color: var(--dark);
            box-shadow: 0 4px 15px rgba(0, 240, 255, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 240, 255, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-icon {
            margin-left: 8px;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .form-footer a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            position: relative;
        }
        
        .form-footer a:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--primary);
            transition: width 0.3s ease;
        }
        
        .form-footer a:hover:after {
            width: 100%;
        }
        .service-type-selector {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 12px;
    margin-top: 8px;
}

.service-option {
    position: relative;
}

.service-radio {
    position: absolute;
    opacity: 0;
}

.service-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 16px 12px;
    background: var(--glass-highlight);
    border: 1px solid var(--glass-border);
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    height: 100%;
}

.service-label:hover {
    border-color: var(--primary);
}

.service-radio:checked + .service-label {
    background: rgba(0, 240, 255, 0.1);
    border-color: var(--primary);
    box-shadow: 0 0 0 1px var(--primary);
}

.service-icon {
    font-size: 1.5rem;
    margin-bottom: 8px;
    color: var(--primary);
}

.service-label span {
    font-weight: 600;
    margin-bottom: 4px;
}

.service-label small {
    font-size: 0.75rem;
    opacity: 0.8;
}
/* Add to your existing :root */
:root {
    --admin-glow: rgba(0, 240, 255, 0.7);
    --client-glow: rgba(0, 255, 170, 0.7);
    --business-glow: rgba(255, 0, 230, 0.7);
}

.account-type-selector {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 20px;
    margin: 1.5rem 0;
}

.account-option {
    position: relative;
    perspective: 1000px;
}

.account-radio {
    position: absolute;
    opacity: 0;
}

.account-card {
    position: relative;
    padding: 1.5rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transform-style: preserve-3d;
    overflow: hidden;
    text-align: center;
    min-height: 140px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.account-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.account-card::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: inherit;
    padding: 1px;
    background: linear-gradient(135deg, rgba(255,255,255,0.3), transparent);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.account-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.account-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 2;
}

.account-desc {
    font-size: 0.8rem;
    opacity: 0.8;
    position: relative;
    z-index: 2;
}

/* Admin specific styling */
.account-option:nth-child(1) .account-card {
    box-shadow: 0 0 15px rgba(0, 240, 255, 0.1);
}

.account-option:nth-child(1) .account-icon {
    color: var(--admin-glow);
    text-shadow: 0 0 10px var(--admin-glow);
}

/* Client specific styling */
.account-option:nth-child(2) .account-card {
    box-shadow: 0 0 15px rgba(0, 255, 170, 0.1);
}

.account-option:nth-child(2) .account-icon {
    color: var(--client-glow);
    text-shadow: 0 0 10px var(--client-glow);
}

/* Business specific styling */
.account-option:nth-child(3) .account-card {
    box-shadow: 0 0 15px rgba(255, 0, 230, 0.1);
}

.account-option:nth-child(3) .account-icon {
    color: var(--business-glow);
    text-shadow: 0 0 10px var(--business-glow);
}

/* Hover effects */
.account-card:hover {
    transform: translateY(-5px) scale(1.03);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.account-card:hover::before {
    opacity: 1;
}

/* Selected state */
.account-radio:checked + .account-card {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.account-radio:checked + .account-card::after {
    opacity: 1;
}

.account-radio:checked + .account-card::before {
    opacity: 1;
}

/* Glow effect for selected card */
.account-radio:checked + .account-card .account-icon {
    animation: pulseGlow 2s infinite alternate;
}

@keyframes pulseGlow {
    0% { filter: drop-shadow(0 0 5px currentColor); }
    100% { filter: drop-shadow(0 0 15px currentColor); }
}

/* Holographic particles effect */
.account-card .particles {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 1;
    overflow: hidden;
    border-radius: inherit;
}

.account-card .particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.account-card:hover .particle,
.account-radio:checked + .account-card .particle {
    opacity: 0.3;
}
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">DRISS </div>
                <div class="auth-subtitle">The future of booking systems</div>
            </div>
            
            <div class="auth-body">
                <div class="auth-tabs">
                    <div class="auth-tab active" data-tab="login">Sign In</div>
                    <div class="auth-tab" data-tab="register">Register</div>
                    <div class="tab-indicator" id="tabIndicator"></div>
                </div>
                
                @yield('content')
            </div>
        </div>
    </div>
    
    @yield('scripts')
</body>
</html>