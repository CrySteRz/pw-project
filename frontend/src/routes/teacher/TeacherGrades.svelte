<script>
    import { onMount } from "svelte";
    import { fetchWithAuth, jwtData } from "../../lib/utils";
    import TeacherLayout from "./TeacherLayout.svelte";

    let grades = [];
    let grade_id = -1;
    const studentData = jwtData();
    onMount(() => {
            fetchWithAuth(`/grades/?teacher_email=${studentData.user_email}`)
                .then(response => response.json())
                .then(data => grades = data.message);
    })


    function handleSubmit(event) {
        event.preventDefault();

        const new_grade = document.getElementById('input_new_grade').value;
        const dto = {};
        dto.new_grade = new_grade;
        dto.grade_id = grade_id;
        fetchWithAuth('/grades/', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dto)
        })
            .then(response => response.json())
            .then(data => {
                window.location.reload();
            });
    }

    const openModal = (grade) => {
        grade_id = grade.id;
        document.getElementById('modal_update_grade').showModal();
    }

    function exportToCSV() {
    let data = Array.from(document.querySelector('#gradesTableTeacher').rows).map(row => Array.from(row.cells).slice(0, -1).map(cell => cell.innerText));
    let csvContent = "data:text/csv;charset=utf-8," + data.map(e => e.join(",")).join("\n");
    let encodedUri = encodeURI(csvContent);
    let link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "grades.csv");
    document.body.appendChild(link); // Required for Firefox
    link.click();  // This will download the data file named "grades.csv".
    }

    async function importCSV() {
        const csvFile = document.getElementById('csvFile').files[0];
        const formData = new FormData();
        formData.append('file', csvFile);

        const response = await fetchWithAuth('/grades/csv', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
           console.log('Error importing CSV file')
           console.log(response)
        }

        window.location.reload();
    }
    
</script>

<svelte:head>
    <title>Home</title>
    <meta name="description" content="Svelte demo app" />
</svelte:head>

<TeacherLayout>
<section>
    <div class="mb-2 flex gap-2">
        <button class="btn btn-primary" on:click={exportToCSV}>Export to CSV</button>
        <button class="btn btn-primary" on:click={() => document.getElementById('importModal').showModal()}>Import from CSV</button>

        </div>

    <table id="gradesTableTeacher">
        <thead>
            <tr>
                <th>Student email</th>
                <th>Discipline Name</th>
                <th>Exam Date</th>
                <th>Grade Value</th>
                <th>Credits</th>
                <th>Total Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {#each grades as grade, index (index)}
                <tr>
                    <td>{grade.email}</td>
                    <td>{grade.disciplineName}</td>
                    <td>{grade.examDate}</td>
                    <td>{grade.gradeValue}</td>
                    <td>{grade.credits}</td>
                    <td>{grade.credits * grade.gradeValue}</td>
                    <td>
                        <button class="btn btn-outline" on:click={() => openModal(grade)}>update grade</button>
                    </td>
                </tr>
            {/each}
        </tbody>
    </table>
</section>
</TeacherLayout>

<dialog id="modal_update_grade" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="font-bold text-lg">Create student entry</h3>
        <form method="dialog" class="modal-backdrop w-full flex flex-col gap-2" on:submit={handleSubmit}>
            <div>
                <input id="input_new_grade" style="color:black; border: 1px solid black" type="number" min="0" max="10" class="input" placeholder="New Grade" />
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" class="btn btn-secondary" on:click={() => document.getElementById('modal_update_grade').close()}>Close</button>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
  </dialog>
  <dialog id="importModal" class="modal">
    <div class="modal-box w-11/12 max-w-md">
        <form on:submit|preventDefault={importCSV}>
    <div class="flex flex-col gap-2">
        <label for="csvFile">Choose a CSV file to import</label>
    <input type="file" id="csvFile" accept=".csv"/>
</div>
<div class="flex justify-end gap-2">
    <button type="button" class="btn btn-secondary" on:click={() => document.getElementById('importModal').close()}>Close</button>
    <button class="btn btn-primary">Update</button>
</div>  
</form>
</div>
</dialog>
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