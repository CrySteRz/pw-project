<script>
  import './app.css'
  import './styles.css'
  import { Router, Link, Route } from "svelte-routing";
  import {
    Home, AdminDisciplines, AdminGrades, AdminStudents, AdminTeachers, StudentData,
    StudentDisciplines, StudentGrades
  } from './routes';
  export let url = "";
</script>

<Router {url}>

    <Route path="/admin/disciplines" component={AdminDisciplines} />
    <Route path="/admin/grades" component={AdminGrades} />
    <Route path="/admin/students" component={AdminStudents} />
    <Route path="/admin/teachers" component={AdminTeachers} />
    <Route path="/student/studentData" component={StudentData} />
    <Route path="/student/disciplines" component={StudentDisciplines} />
    <Route path="/student/grades" component={StudentGrades} />
    <Route path="/"><Home /></Route>
</Router>