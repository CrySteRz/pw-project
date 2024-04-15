<script>
	import { onMount } from 'svelte';

	let students = [];

	onMount(async () => {
		const response = await fetch('http://localhost:8081/students/');
		const data = await response.json();
		students = data.message;
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
                <th>Email</th>
                <th>Name</th>
                <th>Address</th>
                <th>Birth Date</th>
            </tr>
        </thead>
        <tbody>
            {#each students as student (student.email)}
                <tr>
                    <td>{student.email}</td>
                    <td>{student.name} {student.surname}</td>
                    <td>{student.address}, {student.city}, {student.state}, {student.country}</td>
                    <td>{student.birthDate}</td>
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