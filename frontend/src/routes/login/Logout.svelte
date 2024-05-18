<script>
	import { onMount } from 'svelte';
    import { logout } from '../../lib/utils';
	onMount(() => {
        logout();
	});
</script>
<svelte:head>
	<title>Logout page</title>
	<meta name="description" content="Svelte demo app" />
</svelte:head>


<h1> logging out</h1>