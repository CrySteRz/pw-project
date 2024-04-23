<script>
    let email = '';
    let password = '';

    function handleLogin() {
        // Add your login logic here
        console.log('Logging in...');
        console.log('Email:', email);
        console.log('Password:', password);
    }
</script>

<main>
    <h1>Login</h1>

    <form on:submit|preventDefault={handleLogin}>
        <label>
            Email:
            <input type="email" bind:value={email} required />
        </label>

        <label>
            Password:
            <input type="password" bind:value={password} required />
        </label>

        <button type="submit">Login</button>
    </form>
</main>

<style>
    main {
        max-width: 400px;
        margin: 0 auto;
        padding: 2rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    h1 {
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    label {
        display: flex;
        flex-direction: column;
    }

    input {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        padding: 0.5rem 1rem;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
</style>