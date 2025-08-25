<script>
    // Función para refrescar el captcha
    function refreshCaptcha() {
        fetch('/refresh-captcha')
            .then(response => response.json())
            .then(data => {
                document.querySelector('p[class*="text-sm text-gray-600 mb-2"]').textContent = data.question;
                document.querySelector('input[name="captcha_question"]').value = data.question;
                document.querySelector('input[name="captcha_answer"]').value = '';
            })
            .catch(error => {
                console.error('Error refreshing captcha:', error);
            });
    }
</script>




