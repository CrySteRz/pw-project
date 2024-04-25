<script>
    import { onMount } from 'svelte';
  
    onMount(() => {
      const urlParams = new URLSearchParams(window.location.search);
      const code = urlParams.get('code');
      console.log('code:', code);
      if (code) {
        exchangeCodeForToken(code);
      }
    });
  
    async function exchangeCodeForToken(code) {
      const response = await fetch('http://localhost:8081/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ code })
      });
  
      if (response.ok) {
        const data = await response.json();
        console.log('data:', data);
        //document.cookie = `jwt=${data.token}; path=/; max-age=3600; Secure`;
      } else {
        console.error('Error during login:', await response.text());
      }
    }
  </script>