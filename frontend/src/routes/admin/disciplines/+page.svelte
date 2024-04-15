<script>
    import { onMount } from 'svelte';
    let disciplines = [];

	// all disciplines
	// http://localhost:8081/disciplines/
	onMount(() => {
      // Fetch all disciplines
      fetch('http://localhost:8081/disciplines/')
            .then(response => response.json())
            .then(data => {
                disciplines = data.message;
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


<section class="flex flex-col gap-2">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Discipline ID</th>
                    <th>Credits</th>
                </tr>
            </thead>
            <tbody>
                {#each disciplines as discipline (discipline.id)}
                    <tr>
                        <td>{discipline.id}</td>
                        <td>{discipline.name}</td>
                        <td>{discipline.idDiscipline}</td>
                        <td>{discipline.credits}</td>
                    </tr>
                {/each}
            </tbody>
        </table>
</section>

<style>
	table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
