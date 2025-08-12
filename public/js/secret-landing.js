// Secret landing functionality
let accessGranted = false;

function initiateAccess() {
    if (accessGranted) return;

    const button = document.querySelector('.access-button');
    const originalText = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> PROCESSING...';
    button.style.background = '#ffd43b';
    button.disabled = true;

    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i> ACCESS GRANTED';
        button.style.background = 'linear-gradient(135deg, #51cf66 0%, #40c057 100%)';
        
        setTimeout(() => {
            showMainWebsite();
        }, 1000);
    }, 2000);

    accessGranted = true;
}

function showMainWebsite() {
    const secretLanding = document.getElementById('secretLanding');
    const mainWebsite = document.getElementById('mainWebsite');
    
    secretLanding.classList.add('hide');
    
    setTimeout(() => {
        secretLanding.style.display = 'none';
        mainWebsite.classList.add('show');
        window.scrollTo(0, 0);
        initMainWebsite();
    }, 1000);
}

function initMainWebsite() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const navMenu = document.getElementById('nav-menu');
    
    if (mobileMenuToggle && navMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
        
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }
    
    // FAQ functionality
    document.querySelectorAll('.faq-question').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const item = btn.closest('.faq-item');
            item.classList.toggle('open');
            
            const plus = btn.querySelector('.icon-plus');
            const close = btn.querySelector('.icon-close');
            if(item.classList.contains('open')) {
                plus.style.display = 'none';
                close.style.display = 'inline';
            } else {
                plus.style.display = 'inline';
                close.style.display = 'none';
            }
        });
    });
    
    // Set initial icon state
    document.querySelectorAll('.faq-question').forEach(function(btn) {
        btn.querySelector('.icon-plus').style.display = 'inline';
        btn.querySelector('.icon-close').style.display = 'none';
    });
    
    // Header transparency on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        if (window.scrollY > 100) {
            header.classList.remove('transparent');
        } else {
            header.classList.add('transparent');
        }
    });
}

// Add interactive effects to code digits
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.code-digit').forEach((digit, index) => {
        digit.addEventListener('click', function() {
            this.style.animation = 'none';
            this.offsetHeight;
            this.style.animation = 'scan 0.5s ease-in-out';
            
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 100);
            }, 100);
        });

        digit.addEventListener('mouseenter', function() {
            this.style.textShadow = '0 0 15px rgba(0, 255, 65, 0.8)';
        });

        digit.addEventListener('mouseleave', function() {
            this.style.textShadow = '0 0 5px rgba(0, 255, 65, 0.5)';
        });
    });

    // Matrix rain effect and other effects...
    if (document.getElementById('secretLanding')) {
        setTimeout(createMatrixRain, 2000);
    }
});

// Matrix rain effect
function createMatrixRain() {
    const canvas = document.createElement('canvas');
    canvas.style.position = 'fixed';
    canvas.style.top = '0';
    canvas.style.left = '0';
    canvas.style.width = '100%';
    canvas.style.height = '100%';
    canvas.style.pointerEvents = 'none';
    canvas.style.zIndex = '1';
    canvas.style.opacity = '0.1';
    
    document.getElementById('secretLanding').appendChild(canvas);
    
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    const matrix = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789@#$%^&*()*&^%+-/~{[|`]}";
    const chars = matrix.split("");
    
    const font_size = 10;
    const columns = canvas.width / font_size;
    const drops = [];
    
    for (let x = 0; x < columns; x++) {
        drops[x] = 1;
    }
    
    function draw() {
        ctx.fillStyle = 'rgba(0, 0, 0, 0.04)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        ctx.fillStyle = '#00ff41';
        ctx.font = font_size + 'px arial';
        
        for (let i = 0; i < drops.length; i++) {
            const text = chars[Math.floor(Math.random() * chars.length)];
            ctx.fillText(text, i * font_size, drops[i] * font_size);
            
            if (drops[i] * font_size > canvas.height && Math.random() > 0.975) {
                drops[i] = 0;
            }
            drops[i]++;
        }
    }
    
    const matrixInterval = setInterval(draw, 35);
    
    setTimeout(() => {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.target.style.display === 'none') {
                    clearInterval(matrixInterval);
                    canvas.remove();
                    observer.disconnect();
                }
            });
        });
        
        observer.observe(document.getElementById('secretLanding'), {
            attributes: true,
            attributeFilter: ['style']
        });
    }, 1000);
}