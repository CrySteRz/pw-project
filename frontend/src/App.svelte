<script>
  import './app.css'
  import './styles.css'
  import { Router, Link, Route } from "svelte-routing";
  import {
    Login, Callback, Home,  AdminDisciplines, AdminGrades, AdminStudents, AdminTeachers, StudentData,
    StudentDisciplines, StudentGrades, HomeAdmin

  } from './routes';
    import HomeStudent from './routes/student/HomeStudent.svelte';
    import Logout from './routes/login/Logout.svelte';
    import HomeTeacher from './routes/teacher/HomeTeacher.svelte';
    import TeacherDiscipline from './routes/teacher/TeacherDiscipline.svelte';
    import TeacherGrades from './routes/teacher/TeacherGrades.svelte';
    
  export let url = "";


  function getCookie(name) {
    let cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}
</script>

<Router {url}>

  <Route path="/admin/disciplines" component={AdminDisciplines} />
  <Route path="/admin/grades" component={AdminGrades} />
  <Route path="/admin/students" component={AdminStudents} />
  <Route path="/admin/teachers" component={AdminTeachers} />
  <Route path="/admin" component={HomeAdmin} />
    <Route path="/student/studentData" component={StudentData} />
    <Route path="/student/disciplines" component={StudentDisciplines} />
    <Route path="/student/grades" component={StudentGrades} />
    <Route path="/student" component={HomeStudent} />
    <Route path="/teacher" component={HomeTeacher} />
    <Route path="/teacher/disciplines" component={TeacherDiscipline} />
    <Route path="/teacher/grades" component={TeacherGrades} />
    <Route path="/login" component={Login} />
    <Route path="/logout" component={Logout} />
    <Route path="/login/callback" component={Callback} />
    <Route path="/"><Home /></Route>

</Router>