<script>
  import { Router, Link, Route } from "svelte-routing";
  import { Login, HomeStudent } from './routes/index';
  import './app.css';
  import TailwindCss from './lib/TailwindCSS.svelte';
  export let url = "";
</script>
<TailwindCss/>
<Router {url}>
  <div>
    <!-- <Route path="/blog/:id" component={BlogPost} /> -->
    <Route path="/login" component={Login} />
    <Route path="/"><HomeStudent /></Route>
  </div>
</Router>