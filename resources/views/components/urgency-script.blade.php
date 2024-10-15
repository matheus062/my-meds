<script>
    document.getElementById('urgencia').addEventListener('change', function() {
        const selectedUrgencia = this.value;
        const url = `/ticket/${selectedUrgencia}`;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                window.location.href = url;
            })
            .catch(error => console.error('Erro:', error));
    });
</script>
