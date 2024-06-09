<script>
    import { fetchWithAuth, jwtData } from "../../lib/utils";
    import AdminLayout from "./AdminLayout.svelte";

    let grades = [];
    const studentData = jwtData();
    fetchWithAuth(`/grades/`)
        .then(response => response.json())
        .then(data => grades = data.message);

        function exportToCSV() {
    let data = Array.from(document.querySelector('#gradesTableAdmin').rows).map(row => Array.from(row.cells).map(cell => cell.innerText));
    let csvContent = "data:text/csv;charset=utf-8," + data.map(e => e.join(",")).join("\n");
    let encodedUri = encodeURI(csvContent);
    let link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "grades.csv");
    document.body.appendChild(link); // Required for Firefox
    link.click();  // This will download the data file named "grades.csv".
    }
    
   
</script>

<svelte:head>
    <title>Home</title>
    <meta name="description" content="Svelte demo app" />
</svelte:head>

<AdminLayout>
<section>
    <button class="btn btn-primary mb-2" on:click={exportToCSV}>Export to CSV</button>
    <table id='gradesTableAdmin'>
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