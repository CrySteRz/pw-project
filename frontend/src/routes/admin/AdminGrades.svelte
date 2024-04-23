<script>
   import { onMount } from 'svelte';
   import AutoComplete from 'simply-svelte-autocomplete'
    import AdminLayout from './AdminLayout.svelte';
    let studentsEmails = [];
    let disciplineNames = [];
    let grades = [];
    let selectedUser = '';
    let selectedDiscipline = '';
    const handleAutocompleteUser = (e) => {selectedUser = e }
    const handleAutocompleteDiscipline = (e) => {selectedDiscipline = e }

	// all grades
	// http://localhost:8081/grades/
	onMount(() => {
      // Fetch all disciplines
      fetch('http://localhost:8081/grades/')
            .then(response => response.json())
            .then(data => {
                grades = data.message;
            })
            .catch(error => {
                console.error("Error:", error);
            });

        // Fetch all students
        fetch('http://localhost:8081/students/')
            .then(response => response.json())
            .then(data => {
                studentsEmails = data.message.map(user => user.email);
            })
            .catch(error => {
                console.error("Error:", error);
            });

        // Fetch all disciplines
        fetch('http://localhost:8081/disciplines/')
            .then(response => response.json())
            .then(data => {
                disciplineNames = data.message.map(discipline => discipline.name);
            })
            .catch(error => {
                console.error("Error:", error);
            });
  
    });

    async function createGrade(gradeDto) {
        const response = await fetch('http://localhost:8081/grades/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(gradeDto)
        });

        if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
        }
    }
    function handleSubmit(event) {
    event.preventDefault();
    
    let gradeDto = {};

    createGrade(gradeDto)
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
<AdminLayout>
<section class="flex flex-col gap-2">
	<div class="flex gap-2">
		<button class="btn btn-primary rounded" onclick="my_modal_1.showModal()">create</button>
	</div>
    <table>
        <thead>
            <tr>
                <th>Discipline Name</th>
                <th>Exam Date</th>
                <th>Grade Value</th>
                <th>Credits</th>
                <th>Total Credits</th>
            </tr>
        </thead>
        <tbody>
            {#each grades as grade (grade.email)}
                <tr>
                    <td>{grade.disciplineName}</td>
                    <td>{grade.examDate}</td>
                    <td>{grade.gradeValue}</td>
                    <td>{grade.credits}</td>
                    <td>{grade.credits * grade.gradeValue}</td>
                </tr>
            {/each}
        </tbody>
    </table>
</section>
<dialog id="my_modal_1" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="font-bold text-lg">Create student entry</h3>
        <form method="dialog" class="modal-backdrop w-full" on:submit={handleSubmit}>
            <div class="grid grid-cols-2 gap-2 mb-2 text-black">

            <label class="input input-bordered flex items-center gap-2 text-black">
                Grade
                <input id="input_grade" type="text" value="" 
                class="grow" placeholder="9" />
            </label>

              {#if studentsEmails.length > 0}
                <AutoComplete className="w-full svelte-autocomplete" options={studentsEmails} 
                onSubmit={handleAutocompleteUser} selectedValue={selectedUser}
                keepValueOnSubmit={true}
                />
            {/if}
            {#if disciplineNames.length > 0}
            <AutoComplete className="w-full svelte-autocomplete" options={disciplineNames} 
            onSubmit={handleAutocompleteDiscipline} selectedValue={selectedDiscipline}
            keepValueOnSubmit={true}
            />
                {/if}

              <select id="input_exam"  class="select select-bordered w-full">
                <option disabled selected>Exam date</option>
                <option value="1">2</option>
                <option value="2">1</option>
                <option value="3">3 </option>
              </select>
        </div>
        <div>
            <button class="btn btn-secondary">Close</button>
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
        </form>
    </div>
  </dialog>
</AdminLayout>
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