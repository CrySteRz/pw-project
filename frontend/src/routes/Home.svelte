<script>
	import { onMount } from 'svelte';
    import { jwtData, redirectToLogin } from '../lib/utils';
	onMount(() => {
		const userData = jwtData();
		const userEmail = userData ? userData.user_email : null;
		if(!userEmail) 
			redirectToLogin();
		if(userData.role === 1)
			window.location.href = '/admin';
		else if(userData.role === 2)
			window.location.href = '/teacher';
		else if(userData.role === 3)
			window.location.href = '/student';

	});
</script>
<svelte:head>
	<title>Home</title>
	<meta name="description" content="Svelte demo app" />
</svelte:head>


<h1> hello</h1>