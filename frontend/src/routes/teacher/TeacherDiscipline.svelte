<script>
    import { onMount } from 'svelte';
    import { fetchWithAuth, jwtData } from '../../lib/utils';
    import TeacherLayout from './TeacherLayout.svelte';

	let activeButton = 'mine';
    let disciplines = [];
    let myDisciplines = [];


	function switchButton(button) {
		activeButton = button;
	}



	// all disciplines
	// /disciplines/
	onMount(() => {
      // Fetch all disciplines
      const studentData = jwtData();
      fetchWithAuth('/disciplines/')
            .then(response => response.json())
            .then(data => {
                disciplines = data.message;
            })
            .catch(error => {
                console.error("Error:", error);
            });

    // Fetch my disciplines
    fetchWithAuth(`/disciplines/?teacher_email=${studentData.user_email}`)
        .then(response => response.json())
        .then(data => {
            myDisciplines = data.message;
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

<TeacherLayout>

    <section class="flex flex-col gap-2">
        <div class="button-group">
            <button class="{activeButton === 'mine' ? 'active' : ''}" on:click={() => switchButton('mine')}>Mine</button>
            <button class="{activeButton === 'all' ? 'active' : ''}" on:click={() => switchButton('all')}>All</button>
        </div>
        
        {#if activeButton === 'all'}
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
        {:else if activeButton === 'mine'}
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
                {#each myDisciplines as discipline (discipline.id)}
                <tr>
                    <td>{discipline.id}</td>
                    <td>{discipline.name}</td>
                    <td>{discipline.idDiscipline}</td>
                    <td>{discipline.credits}</td>
                </tr>
                {/each}
            </tbody>
        </table>
        {/if}
        
    </section>
</TeacherLayout>
    
    <style>
        .button-group {
            display: flex;
            gap: 10px;
        }
        .button-group button {
            padding: 10px;
            border: none;
        background-color: white;
        cursor: pointer;
    }
    .button-group button.active {
        background-color: rgb(21 128 61);
		color:white;
    }

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
