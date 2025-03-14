@if(Session::has('success'))
<div id="success-message" class="bg-green-200 border-green-600 p-4 mb-3 rounded-sm shadow-sm">
    {{ Session::get('success') }}
</div>
@endif

@if(Session::has('error'))
<div id="error-message" class="bg-red-200 border-red-600 p-4 mb-3 rounded-sm shadow-sm">
    {{ Session::get('error') }}
</div>
@endif

<script>
    // Espera 300ms y luego oculta los mensajes
    setTimeout(function() {
        let successMessage = document.getElementById('success-message');
        let errorMessage = document.getElementById('error-message');
        
        if (successMessage) {
            successMessage.style.transition = "opacity 0.5s";
            successMessage.style.opacity = "0";
            setTimeout(() => successMessage.style.display = "none", 500);
        }
        
        if (errorMessage) {
            errorMessage.style.transition = "opacity 0.5s";
            errorMessage.style.opacity = "0";
            setTimeout(() => errorMessage.style.display = "none", 500);
        }
    }, 2500);
</script>
