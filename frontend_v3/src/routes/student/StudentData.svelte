<script>
	import { onMount } from 'svelte';
    import StudentLayout from './StudentLayout.svelte';

	let studentData = "Loading...";

	onMount(() => {
		fetch('http://localhost:8081/students/data?email=user1@example.com')
			.then(response => response.json())
			.then(data => {
				studentData = data.message;
				// @ts-ignore
				studentData.birthDate = new Date(studentData.birthDate).toLocaleDateString();
			})
			.catch(error => {
				studentData = "Error: " + error;
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
