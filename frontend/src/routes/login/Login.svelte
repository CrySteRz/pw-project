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

<div class="loginContainer">
  <div class="card container myGlassEffect py-12">
    <div class="flex items-center justify-center flex-col gap-2">
      <h1 class="text-2xl">Welcome to WebStudent</h1>
      <button class="btn"  on:click={signInWithGoogle}>
        Sign in with Google
      </button>
    </div>
  </div>
</div>


<style>
  .loginContainer {
    display: flex;
    justify-content: center;
    align-items: center;
		background-image: url('/cool-background2.png');
    background-size: cover;
    background-repeat: no-repeat;
    width: 100%;
    height: 100vh;
  }
</style>