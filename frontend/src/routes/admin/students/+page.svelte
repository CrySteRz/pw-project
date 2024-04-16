<script>
	import { onMount } from 'svelte';

	let students = [];

    const inputDatas = [
        {
            "label": "Email",
            "DtoField": "email", 
            "type": "email",
            "value": "", 
            "placeholder": "user4@example.com"
        },
        {
            "label": "Name",
            "DtoField": "name", 
            "type": "text",
            "value": "", 
            "placeholder": "Jane"
        },
        {
            "label": "Surname",
            "DtoField": "surname", 
            "type": "text",
            "value": "", 
            "placeholder": "Smith"
        },
        {
            "label": "Birth Date",
            "DtoField": "birthDate", 
            "type": "date",
            "value": "2002-07-26", 
            "placeholder": ""
        },
        {
            "label": "Country",
            "DtoField": "country", 
            "type": "text",
            "value": "", 
            "placeholder": "UK"
        },
        {
            "label": "State",
            "DtoField": "state", 
            "type": "text",
            "value": "", 
            "placeholder": "England"
        },
        {
            "label": "City",
            "DtoField": "city", 
            "type": "text",
            "value": "", 
            "placeholder": "London"
        },
        {
            "label": "Address",
            "DtoField": "address", 
            "type": "text",
            "value": "", 
            "placeholder": "456 Oak St"
        },
        {
            "label": "Sex",
            "DtoField": "sex", 
            "type": "checkbox",
            "value": false, 
            "placeholder": ""
        },
        {
            "label": "CNP",
            "DtoField": "CNP", 
            "type": "text",
            "value": "", 
            "placeholder": "9876543210987"
        }
    ]

    let updateInputDatas = JSON.parse(JSON.stringify(inputDatas))
    
    onMount(async () => {
        const response = await fetch('http://localhost:8081/students/');
        const data = await response.json();
        students = data.message;
    });

    async function createStudent(studentDto) {
        const response = await fetch('http://localhost:8081/users/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(studentDto)
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    return data;
  }

  function getValue(htmlElt){
      if(htmlElt.type === 'checkbox')
          return htmlElt.checked;
      if(htmlElt.type === 'date')
          return new Date(htmlElt.value).toISOString();
      return htmlElt.value;
  }

    function GetStudentDto(event){
        const newInputsData = inputDatas.map((el) => {
        return {
            ...el,
            value: getValue(event.target[`input_${el.label}`])
        }
    })
        let createStudentObject = {};
        for(let i=0;i< newInputsData.length;i++)
                createStudentObject[newInputsData[i].DtoField] = newInputsData[i].value;
        createStudentObject.roleId = 3;
        return createStudentObject;
    }

    function handleSubmit(event) {
    event.preventDefault();
    let studentDto = GetStudentDto(event);
    createStudent(studentDto)
    .then(e => { 
        window.location.reload();
        console.log('Success:', e);
    })
    .catch(e => console.error('There was a problem with the request.', e));
    // close the dialog
    document.getElementById('my_modal_1').close();
  }
  
    function padDateWith0(strDate){
       return ('0' + strDate).slice(-2);
    }

    function getDateFormat(date){
        return `${date.getFullYear()}-${padDateWith0(date.getMonth())}-${padDateWith0(date.getDate())}`;
    }


    function openEditModal(student) {
        updateInputDatas.forEach((el) => {
            if(el.type === 'date'){
                console.log(new Date(student[el.DtoField]));
                el.value = getDateFormat(new Date(student[el.DtoField]));
            }
            else
            el.value = student[el.DtoField];
        })
        updateInputDatas = updateInputDatas;
        console.log(updateInputDatas)
        document.getElementById('update_modal').showModal();
    }

    async function handleUpdate(event){
        let studentDto = GetStudentDto(event);
        const response = await fetch(`http://localhost:8081/users?email=${studentDto.email}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(studentDto)
        });

        if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log(data);
        window.location.reload();
    }

    let deletingStudent = {'email' : ''};

    async function deleteStudent() {
    const response = await fetch(`http://localhost:8081/users?email=${deletingStudent.email}`, {
      method: 'DELETE',
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    return data;
  }
    
    function openRemoveModal(studentDto){
        deletingStudent = studentDto;
        document.getElementById('delete_modal').showModal();
    }

    function handleDelete(){
        deleteStudent()
        .then(e => console.log(e))
        .catch(e => console.error('There was a problem with the request.', e));

        window.location.reload();
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {#each students as student (student.email)}
                <tr>
                    <td>{student.email}</td>
                    <td>{student.name} {student.surname}</td>
                    <td>{student.address}, {student.city}, {student.state}, {student.country}</td>
                    <td>{student.birthDate}</td>
                    <td>
                        <button class="btn" on:click={() => openEditModal(student)}>Update</button>
                        <button class="btn" on:click={() => openRemoveModal(student)}>Delete</button>
                    </td>
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
                <input id={`input_${inputData.label}`} type={inputData.type} 
                value={inputData.value} class="grow"
                 placeholder={inputData.placeholder} />
            </label>
        {/each}
          <button type="button" class="btn btn-secondary" on:click={() => document.getElementById('my_modal_1').close()}>Close</button>
          <button class="btn btn-primary" type="submit">Create</button>
        </form>
    </div>
  </dialog>
  <dialog id="update_modal" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
      <h3 class="font-bold text-lg">Update student entry</h3>
        <form method="dialog" class="modal-backdrop w-full grid grid-cols-3 gap-2" on:submit={handleUpdate}>
            {#each updateInputDatas as updInpData (updInpData.label)}
            <label class="input input-bordered flex items-center gap-2 text-black">
                {updInpData.label}
                <input id={`input_${updInpData.label}`} type={updInpData.type} 
                 value={updInpData.value} class="grow"
                 placeholder={updInpData.placeholder} />
            </label>
        {/each}
          <button class="btn btn-secondary" on:click={() => document.getElementById('update_modal').close()}>Close</button>
          <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
  </dialog>
  <dialog id="delete_modal" class="modal">
    <div class="modal-box w-11/12 max-w-sm ">
      <h3 class="font-bold text-lg mb-2">Update student entry</h3>
        <form method="dialog" class="modal-backdrop w-full flex flex-col gap-2" on:submit={handleDelete}>
                <h3>Are you sure you want to delete {deletingStudent.email}?</h3>
            <div class="flex justify-end gap-2">
                <button class="btn btn-secondary" on:click={() => document.getElementById('delete_modal').close()}>Close</button>
                <button class="btn btn-primary" type="submit">Delete</button>
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

    h3{
        color: black;
    }

</style>