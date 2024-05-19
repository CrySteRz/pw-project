<script>
    import { fetchWithAuth, jwtData } from "../../lib/utils";
    import AdminLayout from "./AdminLayout.svelte";

    let grades = [];
    const studentData = jwtData();
    fetchWithAuth(`/admin/grades?email=${studentData.user_email}`)
        .then(response => response.json())
        .then(data => grades = data.message);
</script>

<svelte:head>
    <title>Home</title>
    <meta name="description" content="Svelte demo app" />
</svelte:head>

<AdminLayout>
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
                </tr>
            {/each}
        </tbody>
    </table>
</section>
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