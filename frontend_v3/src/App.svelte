<script>
  import './app.css'
  import { Router, Link, Route } from "svelte-routing";
  import Home from "./routes/Home.svelte";
    import AdminDisciplines from "./routes/admin/AdminDisciplines.svelte";
    import AdminGrades from "./routes/admin/AdminGrades.svelte";
    import AdminStudents from "./routes/admin/AdminStudents.svelte";
    import AdminTeachers from "./routes/admin/AdminTeachers.svelte";
  export let url = "";
</script>

<Router {url}>
  <nav>
    <Link to="/admin/disciplines">Admin disciplines</Link>
    <Link to="/about">About</Link>
    <Link to="/blog">Blog</Link>
  </nav>
  <div>
    <Route path="/admin/disciplines" component={AdminDisciplines} />
    <Route path="/admin/grades" component={AdminGrades} />
    <Route path="/admin/students" component={AdminStudents} />
    <Route path="/admin/teachers" component={AdminTeachers} />
    <Route path="/"><Home /></Route>
  </div>
</Router>