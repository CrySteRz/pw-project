<script>
	import { onMount } from 'svelte';
  
	let teachers = [];
  
	onMount(async () => {
	  const response = await fetch('http://localhost:8081/teachers/');
	  const data = await response.json();
	  teachers = data.message;
	});
  </script>
  
  <svelte:head>
	<title>Teachers</title>
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
			  {#each teachers as teacher (teacher.email)}
				  <tr>
					  <td>{teacher.email}</td>
					  <td>{teacher.name} {teacher.surname}</td>
					  <td>{teacher.address}, {teacher.city}, {teacher.state}, {teacher.country}</td>
					  <td>{teacher.birthDate}</td>
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