<a href="/">
    <div align="center" class="logo-container">
        <img src="logo.png" alt="Calela" width="20%" height="20%" class="logo">
    </div>
</a>

<style>
    .logo-container {
        animation: bounceInDown;
        animation-duration: 1s;
        animation-delay: 0.5s;
        animation-timing-function: ease;
        animation-fill-mode: both; /* Mantiene los estilos finales de la animación */
    }

    @keyframes bounceInDown {
        0%, 60%, 75%, 90%, 100% {
            transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        
        0% {
            opacity: 0;
            transform: translateY(-3000px);
        }
        
        60% {
            opacity: 1;
            transform: translateY(25px);
        }
        
        75% {opacity: 1;
            transform: translateY(-10px);
        }
        
        90% {opacity: 1;
            transform: translateY(5px);
        }
        
        100% {opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoContainer = document.querySelector('.logo-container');

        // Ocultar el logo inicialmente
        logoContainer.style.opacity = 0;

        // Agregar clase 'show' después de que finalice la animación
        logoContainer.addEventListener('animationend', function() {
            logoContainer.classList.add('show');
        });
    });
</script>
