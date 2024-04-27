<script>
 import { onMount } from 'svelte';
 import { jwtDecode } from "jwt-decode";

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
    const decodedToken = verifyToken(data.token);
    if (decodedToken) {
      document.cookie = `jwt=${data.token}; path=/; max-age=3600; Secure`;
      window.location.href = '/';
    } else {
      console.error('Invalid token signature');
    }
  } else {
    console.error('Error during login:', await response.text());
  }
}

function verifyToken(token) {
    try {
        const decoded = jwtDecode(token);
        return decoded;
    } catch (error) {
        console.error('Error decoding JWT:', error);
        return null;
    }
}
  </script>