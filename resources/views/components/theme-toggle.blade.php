<div>
    <button id="theme-toggle" class="px-4 py-2 bg-gray-800 text-white rounded">Toggle Dark Mode</button>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        toggleButton.addEventListener('click', () => {
          if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
          } else {
            htmlElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
          }
        });

        // Verifica a preferência do usuário ao carregar a página
        if (localStorage.getItem('theme') === 'dark') {
          htmlElement.classList.add('dark');
        } else {
          htmlElement.classList.remove('dark');
        }
      });
    </script>
  </div>
