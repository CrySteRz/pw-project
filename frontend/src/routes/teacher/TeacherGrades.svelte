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
</script>

<svelte:head>
    <title>Home</title>
    <meta name="description" content="Svelte demo app" />
</svelte:head>

<TeacherLayout>
<section>
    <table>
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