<script>
	import { onMount } from 'svelte';
    import StudentLayout from './StudentLayout.svelte';
	import { fetchWithAuth, jwtData } from '../../lib/utils.js';

	let studentData = "Loading...";

	onMount(() => {
		const userData = jwtData();
		fetchWithAuth(`/students/data?email=${userData.user_email}`)
        .then(response => response.json())
        .then(data => {
            studentData = data.message;
			studentData.birthDate = new Date (studentData.birthDate).toLocaleDateString();
        })
        .catch(error => {
            console.error("Error:", error);
        });
	});
</script>

<svelte:head>
	<title>Home</title>
	<meta name="description" content="Svelte demo app" />
</svelte:head>

<StudentLayout>

	<section>
		{#if typeof studentData === 'object'}
        <div class="gridNoQueries">
			{#each Object.entries(studentData) as [propertyName, propertyValue]}
			<div class="flex gap-2">
				<h1 class="font-bold">{propertyName}:</h1>
				<h1>{propertyValue}</h1>
			</div>
			{/each}
		</div>
		{:else}
        {studentData}
		{/if}
	</section>
</StudentLayout>

<style>

	.gridNoQueries{
	display: grid;
	align-items: center;
	grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
	gap:0.25rem 0rem;
	}
</style>
