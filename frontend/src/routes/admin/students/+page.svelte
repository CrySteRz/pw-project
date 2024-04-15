<script>
	import { onMount } from 'svelte';

	let students = [];
    const newStudentData = {
        "email": "",
        "name": "",
        "surname": "",
        "birthDate": "",
        "country": "",
        "state": "",
        "city": "",
        "address": "",
        "sex": undefined,
        "CNP": "",
        "roleId": 2
    }
    
    const inputDatas = [
        {
            "label": "Email",
            "type": "email",
            "value": newStudentData.email, 
            "placeholder": "user4@example.com"
        },
        {
            "label": "Name",
            "type": "text",
            "value": newStudentData.name, 
            "placeholder": "Jane"
        },
        {
            "label": "Surname",
            "type": "text",
            "value": newStudentData.surname, 
            "placeholder": "Smith"
        },
        {
            "label": "Birth Date",
            "type": "date",
            "value": newStudentData.birthDate, 
            "placeholder": ""
        },
        {
            "label": "Country",
            "type": "text",
            "value": newStudentData.country, 
            "placeholder": "UK"
        },
        {
            "label": "State",
            "type": "text",
            "value": newStudentData.state, 
            "placeholder": "England"
        },
        {
            "label": "City",
            "type": "text",
            "value": newStudentData.city, 
            "placeholder": "London"
        },
        {
            "label": "Address",
            "type": "text",
            "value": newStudentData.address, 
            "placeholder": "456 Oak St"
        },
        {
            "label": "Sex",
            "type": "checkbox",
            "value": newStudentData.sex, 
            "placeholder": ""
        },
        {
            "label": "CNP",
            "type": "text",
            "value": newStudentData.CNP, 
            "placeholder": "9876543210987"
        }
    ]



	onMount(async () => {
		const response = await fetch('http://localhost:8081/students/');
		const data = await response.json();
		students = data.message;
	});


    function handleSubmit(event) {
    event.preventDefault();
    for(let i=0; i<inputDatas.length;i++)
        inputDatas[i].value = event.target[`input_${inputDatas[i].label}`].value;
    console.log(inputDatas);

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
<dialog id="my_modal_1" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="font-bold text-lg">Create student entry</h3>
        <form method="dialog" class="modal-backdrop w-full grid grid-cols-3 gap-2" on:submit={handleSubmit}>
            {#each inputDatas as inputData (inputData.label)}
            <label class="input input-bordered flex items-center gap-2 text-black">
                {inputData.label}
                <input id={`input_${inputData.label}`} type={inputData.type} class="grow" placeholder={inputData.placeholder} />
            </label>
        {/each}
          <button class="btn btn-secondary">Close</button>
          <button class="btn btn-primary" type="submit">Create</button>
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