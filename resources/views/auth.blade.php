@extends('layouts.app')

@section('title', 'Access Portal')

@section('content')
<!-- Login Form (unchanged) -->
<form method="POST" action="#" class="auth-form active" id="login-form">
    @csrf
    <div class="form-group">
        <label class="form-label">Email Address</label>
        <div class="input-container">
            <i class="input-icon fas fa-envelope"></i>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
        </div>
    </div>
    
    <div class="form-group">
        <label class="form-label">Password</label>
        <div class="input-container">
            <i class="input-icon fas fa-lock"></i>
            <input type="password" class="form-control" name="password" placeholder="••••••••" required id="loginPassword">
            <i class="password-toggle fas fa-eye" id="loginTogglePassword"></i>
        </div>
        <div style="text-align: right; margin-top: 8px;">
            <a href="#" class="text-link" style="font-size: 0.85rem;">Forgot password?</a>
        </div>
    </div>
    
    <div class="form-group" style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary">
            Sign In <i class="btn-icon fas fa-arrow-right"></i>
        </button>
    </div>
    
    <div class="form-footer">
        Don't have access? <a href="#" class="switch-tab" data-tab="register">Request credentials</a>
    </div>
</form>

<!-- Register Form with Service Type Selection -->
<form method="POST" action="#" class="auth-form" id="register-form">
    @csrf
    <div class="form-group">
        <label class="form-label">Full Name</label>
        <div class="input-container">
            <i class="input-icon fas fa-user"></i>
            <input type="text" class="form-control" name="name" placeholder="Your name" required>
        </div>
    </div>
    
    <div class="form-group">
        <label class="form-label">Email Address</label>
        <div class="input-container">
            <i class="input-icon fas fa-envelope"></i>
            <input type="email" class="form-control" name="email" placeholder="your@email.com" required>
        </div>
    </div>
    
    <div class="form-group">
    <label class="form-label">Account Type</label>
    <div class="account-type-selector">
        <div class="account-option">
            <input type="radio" id="admin" name="account_type" value="admin" class="account-radio">
            <label for="admin" class="account-card">
                <div class="particles" id="admin-particles"></div>
                <i class="fas fa-user-cog account-icon"></i>
                <div class="account-title">Admin</div>
                <div class="account-desc">System management</div>
            </label>
        </div>
        
        <div class="account-option">
            <input type="radio" id="client" name="account_type" value="client" class="account-radio" checked>
            <label for="client" class="account-card">
                <div class="particles" id="client-particles"></div>
                <i class="fas fa-user-tie account-icon"></i>
                <div class="account-title">Client</div>
                <div class="account-desc">Personal account</div>
            </label>
        </div>
        
        <div class="account-option">
            <input type="radio" id="business-order" name="account_type" value="business-order" class="account-radio">
            <label for="business-order" class="account-card">
                <div class="particles" id="business-particles"></div>
                <i class="fas fa-briefcase account-icon"></i>
                <div class="account-title">Business</div>
                <div class="account-desc">Company services</div>
            </label>
        </div>
    </div>
</div>
    
    <div class="form-group">
        <label class="form-label">Password</label>
        <div class="input-container">
            <i class="input-icon fas fa-lock"></i>
            <input type="password" class="form-control" name="password" placeholder="••••••••" required id="regPassword">
            <i class="password-toggle fas fa-eye" id="regTogglePassword"></i>
        </div>
    </div>
    
    <div class="form-group">
        <label class="form-label">Confirm Password</label>
        <div class="input-container">
            <i class="input-icon fas fa-lock"></i>
            <input type="password" class="form-control" name="password_confirmation" placeholder="••••••••" required>
        </div>
    </div>
    
    <div class="form-group" style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary">
            Create Account <i class="btn-icon fas fa-user-plus"></i>
        </button>
    </div>
    
    <div class="form-footer">
        Already registered? <a href="#" class="switch-tab" data-tab="login">Sign in</a>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Previous JavaScript remains the same
        // Tab switching with animated indicator
        const tabs = document.querySelectorAll('.auth-tab');
        const indicator = document.getElementById('tabIndicator');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                
                // Update active tab
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Move indicator
                indicator.style.transform = targetTab === 'login' 
                    ? 'translateX(0)' 
                    : 'translateX(100%)';
                
                // Show the correct form
                document.querySelectorAll('.auth-form').forEach(form => {
                    form.classList.remove('active');
                });
                document.getElementById(`${targetTab}-form`).classList.add('active');
            });
        });
        
        // Password toggle functionality
        function setupPasswordToggle(toggleId, inputId) {
            const toggle = document.getElementById(toggleId);
            const input = document.getElementById(inputId);
            
            toggle.addEventListener('click', function() {
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
        
        setupPasswordToggle('loginTogglePassword', 'loginPassword');
        setupPasswordToggle('regTogglePassword', 'regPassword');
        
        // Switch tab from links
        document.querySelectorAll('.switch-tab').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTab = this.getAttribute('data-tab');
                document.querySelector(`.auth-tab[data-tab="${targetTab}"]`).click();
            });
        });
        
        // Form submission demo
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Form submission would be handled by backend');
            });
        });
    });
    // Create holographic particles for each account card
function createParticles(containerId, count, color) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    for (let i = 0; i < count; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random properties
        const size = Math.random() * 3 + 1;
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        const opacity = Math.random() * 0.4 + 0.1;
        const duration = Math.random() * 10 + 5;
        const delay = Math.random() * 5;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${posX}%`;
        particle.style.top = `${posY}%`;
        particle.style.opacity = opacity;
        particle.style.background = color;
        particle.style.animation = `floatParticle ${duration}s ease-in-out ${delay}s infinite alternate`;
        
        container.appendChild(particle);
    }
}

// Add floating animation
const style = document.createElement('style');
style.textContent = `
    @keyframes floatParticle {
        0% { transform: translate(0, 0); }
        25% { transform: translate(${Math.random() * 40 - 20}px, ${Math.random() * 40 - 20}px); }
        50% { transform: translate(${Math.random() * 40 - 20}px, ${Math.random() * 40 - 20}px); }
        75% { transform: translate(${Math.random() * 40 - 20}px, ${Math.random() * 40 - 20}px); }
        100% { transform: translate(0, 0); }
    }
`;
document.head.appendChild(style);

// Initialize particles when DOM loads
document.addEventListener('DOMContentLoaded', function() {
    createParticles('admin-particles', 8, 'var(--admin-glow)');
    createParticles('client-particles', 8, 'var(--client-glow)');
    createParticles('business-particles', 8, 'var(--business-glow)');
    
    // Rest of your existing JavaScript...
});
</script>
@endsection