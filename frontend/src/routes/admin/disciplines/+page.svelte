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

    async function createDiscipline(disciplineDto) {
        const response = await fetch('http://localhost:8081/disciplines/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(disciplineDto)
        });

        if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
        }
    }
    function handleSubmit(event) {
    event.preventDefault();
    
    let disciplineDto = {};
    disciplineDto.name = document.getElementById('input_name').value;
    disciplineDto.credits = Number.parseInt(
            document.getElementById('input_credits').value);
    disciplineDto.idDiscipline = Number.parseInt(
        document.getElementById('input_disciplineType').value);

    createDiscipline(disciplineDto)
    .then(e => { 
        window.location.reload();
        console.log('Success:', e);
    })
    .catch(e => console.error('There was a problem with the request.', e));
    // close the dialog
    document.getElementById('my_modal_1').close();
    
  }

</script>

<svelte:head>
	<title>Home</title>
	<meta name="description" content="Svelte demo app" />
</svelte:head>

<section class="flex flex-col gap-2">
	<div class="flex gap-2">
		<button class="btn btn-primary rounded" onclick="my_modal_1.showModal()">create</button>
	</div>
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
<dialog id="my_modal_1" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="font-bold text-lg">Create student entry</h3>
        <form method="dialog" class="modal-backdrop w-full" on:submit={handleSubmit}>
            <div class="grid grid-cols-2 gap-2 mb-2 ">

            <label class="input input-bordered flex items-center gap-2 text-black">
                Discipline Name
                <input id="input_name" type="text" value="" 
                class="grow" placeholder="Programare Web" />
            </label>

            <label class="input input-bordered flex items-center gap-2 text-black">
               Credits
                <input id="input_credits" type="text" value="" 
                class="grow" placeholder="5" />
            </label>

            <!-- <label class="input input-bordered flex items-center gap-2 text-black">
                Discipline Type
                <input id="input_disciplineType" 
                type="text" value="" class="grow"
                 placeholder="Optional" />
            </label> -->

            <select id="input_disciplineType"  class="select select-bordered w-full">
                <option disabled selected>Discipline type</option>
                <option value="1">Optionala</option>
                <option value="2">Facultativa</option>
                <option value="3">Obligatorie </option>
              </select>
        </div>
        <div>
            <button class="btn btn-secondary">Close</button>
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
        </form>
    </div>
  </dialog>

<style>
    select{
        color: black;
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
