<script>
  const CLIENT_ID = '506306359493-qe7mv4sirt3koqraaolphpiasbn12q66.apps.googleusercontent.com';
  const REDIRECT_URI = 'http://localhost:5173/login/callback';
  const RESPONSE_TYPE = 'code';
  const SCOPE = 'email profile openid';

  function signInWithGoogle() {
    const authUrl = `https://accounts.google.com/o/oauth2/v2/auth?client_id=${encodeURIComponent(CLIENT_ID)}&redirect_uri=${encodeURIComponent(REDIRECT_URI)}&response_type=${RESPONSE_TYPE}&scope=${encodeURIComponent(SCOPE)}`;
    window.location.href = authUrl;
  }
</script>

<button on:click={signInWithGoogle}>
  Sign in with Google
</button>
