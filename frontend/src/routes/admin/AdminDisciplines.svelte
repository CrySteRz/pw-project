<script>
    import { onMount } from 'svelte';
    import AdminLayout from './AdminLayout.svelte';
    import { getCookie, fetchWithAuth } from '../../lib/utils.js';
    import { DateInput } from 'date-picker-svelte'
    import AutoComplete from "simple-svelte-autocomplete"
	let examDate = new Date();

    let disciplines = [];
    let disciplineTypes = [];
    let deletingDiscipline = {'name': ''};
    let updatingDiscipline = {'name': ''};
    let token = getCookie('jwt');
    let teacherEmails = [];
let selectedTeacherEmail = '';
    
	onMount(() => {
    fetchWithAuth('/disciplines/')
        .then(response => response.json())
        .then(data => {
            disciplines = data.message;
        })
        .catch(error => {
            console.error("Error:", error);
        });


    fetchWithAuth('/disciplines/get-types')
        .then(response => response.json())
        .then(data => {
            disciplineTypes = data.message;
        })
        .catch(error => {
            console.error("Error:", error);
        });

    fetchWithAuth('/teachers/')
        .then(response => response.json())
        .then(data => {
            teacherEmails = data.message.map(teacher => teacher.email);
        })
        .catch(error => {
            console.error("Error:", error);
        });
});

async function createDiscipline(disciplineDto) {
    const response = await fetchWithAuth('/disciplines/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(disciplineDto)
    });
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
}

    function GetDisciplineDto(event){
        let disciplineDto = {};
        disciplineDto.name = event.target['input_name'].value;
        disciplineDto.credits = Number.parseInt(
            event.target['input_credits'].value);
        disciplineDto.idDiscipline = Number.parseInt(
            event.target['input_disciplineType'].value);
        if(event.target['date_input_exam']){
            console.log(event.target['date_input_exam']);
            disciplineDto.examDate = event.target['date_input_exam'].value;
            disciplineDto.examDate = new Date(disciplineDto.examDate).toISOString();
        }

        disciplineDto.teacher_email = selectedTeacherEmail;
        return disciplineDto;
    }

    function handleCreate(event) {
    event.preventDefault();
    
    let disciplineDto = GetDisciplineDto(event);
    createDiscipline(disciplineDto)
    .then(e => { 
        window.location.reload();
        console.log('Success:', e);
    })
    .catch(e => console.error('There was a problem with the request.', e));
    // close the dialog
    document.getElementById('my_modal_1').close();
  }

  function openEditModal(discipline) {
        const editModal = document.getElementById('update_modal');
        updatingDiscipline = discipline;
        editModal.querySelector('#input_name').value = discipline.name;
        editModal.querySelector('#input_credits').value = discipline.credits;
        editModal.querySelector('#input_disciplineType').value = discipline.idDiscipline;
        editModal.showModal();
    }

    async function handleUpdate(event){
    let disciplineDto = GetDisciplineDto(event);
    const response = await fetchWithAuth(`/disciplines/${updatingDiscipline.id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(disciplineDto)
    });

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    // console.log(data);
    window.location.reload();
}



async function deleteDiscipline() {
    const response = await fetchWithAuth(`/disciplines/${deletingDiscipline.id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        }
    });

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
}

  function openRemoveModal(disciplineDto){
        deletingDiscipline = disciplineDto;
        document.getElementById('delete_modal').showModal();
    }

    function handleDelete(){
        deleteDiscipline()
        .then(e => window.location.reload())
        .catch(e => console.error('There was a problem with the request.', e));

        
    }

</script>

<svelte:head>
	<title>Home</title>
	<meta name="description" content="Svelte demo app" />
</svelte:head>

<AdminLayout>

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {#each disciplines as discipline (discipline.id)}
                    <tr>
                        <td>{discipline.id}</td>
                        <td>{discipline.name}</td>
                        <td>{discipline.idDiscipline}</td>
                        <td>{discipline.credits}</td>
                        <td>
                            <button class="btn" on:click={() => openEditModal(discipline)}>Update</button>
                            <button class="btn" on:click={() => openRemoveModal(discipline)}>Delete</button>
                        </td>
                    </tr>
                {/each}
            </tbody>
        </table>    
</section>
<dialog id="my_modal_1" class="modal" >
    <div class="modal-box w-11/12 max-w-5xl " style="height:50vh"> 
      <h3 class="font-bold text-lg">Create student entry</h3>
        <form method="dialog" class="modal-backdrop w-full" on:submit={handleCreate}>
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

              <select id="input_disciplineType"  class="select select-bordered w-full">
                <option disabled selected>Discipline type</option>
                {#each disciplineTypes as disciplineType (disciplineType.id)}
                    <option value={disciplineType.id}>{disciplineType.type}</option>
                {/each}
              </select>
              <DateInput id="date_input_exam" bind:value={examDate} />
              <AutoComplete items="{teacherEmails}" bind:selectedItem="{selectedTeacherEmail}" />
            </div>
        <div class="h-full text-black bg-yellow-200 p-8 mb-2">
            BUDGET PLACEHOLDER:
            There is a problem with the date picker and new dialog component. z-index does not work as expected.
            The dialog is implemented as always being on top layer.
        </div>
        <div class="flex justify-end gap-2 mt-2">
            <button class="btn btn-secondary">Close</button>
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
        </form>
    </div>
  </dialog>
  <dialog id="update_modal" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="font-bold text-lg">Update student entry</h3>
        <form method="dialog" class="modal-backdrop w-full" on:submit={handleUpdate}>
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
    
                <select id="input_disciplineType"  class="select select-bordered w-full">
                    <option disabled selected>Discipline type</option>
                    {#each disciplineTypes as disciplineType (disciplineType.id)}
                        <option value={disciplineType.id}>{disciplineType.type}</option>
                    {/each}
                  </select>
            </div>
            <div>
                <button class="btn btn-secondary">Close</button>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
  </dialog>
  <dialog id="delete_modal" class="modal">
    <div class="modal-box w-11/12 max-w-sm ">
      <h3 class="font-bold text-lg mb-2">Update student entry</h3>
      <form method="dialog" class="modal-backdrop w-full" on:submit={handleDelete}>
        <div class="gap-2 mb-2 text-black">

           Are you sure you want to delete "{deletingDiscipline.name}"?
        </div>
    <div>
        <button class="btn btn-secondary">Close</button>
        <button class="btn btn-primary" type="submit">Delete</button>
    </div>
    </form>
    </div>
  </dialog>
</AdminLayout>


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
